import React from "react"
import { toast } from "react-toastify"
import { Editor } from "@tinymce/tinymce-react"
import Select2 from 'react-select2-wrapper'
import { Card, Col, Container, Row, Form, Image } from "react-bootstrap"
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css'
import ProductsStore from "../../stores/ProductsStore"
import BtnSave from "../BtnSave"
import { objectToArrList, objectTreeToArrList } from "../../helpers"
import ProductCharacteristicGroup from "./ProductCharacteristicGroup"
import { v4 as uuidv4 } from 'uuid'
import SingleImageUpload from "../SingleImageUpload"

class ProductForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.match.params.id ? this.props.match.params.id : 0,
            item: { name: '', description: '', category_id: null, vendor_id: null, price: 0, price_min: 0, images: [{ file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, { file: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }] },
            categories: [],
            vendors: [],
            characteristics: [],
            images: []
        }

        this.store = new ProductsStore()

        if (!this.props.match.params.id) {
            toast.info('Loading resources, wait...', { position: toast.POSITION.BOTTOM_RIGHT, autoClose: false })
            this.store.loadResources()
        }

        this.handleChange = (e) => {
            let { item, images } = this.state

            if ('file' == e.target.type)
                for (let f of e.target.files) {
                    item.images.push({ file: URL.createObjectURL(f) })
                    images.push(f)
                }
            else
                item[e.target.name] = e.target.value

            if (item.price_min > item.price && item.price) item.price_min = item.price

            this.setState({ item: item, images: images })
        }

        this.handleEditorChange = (content, editor) => {
            let item = this.state.item
            console.log(editor.targetElm.name)
            item[editor.targetElm.name] = content
            this.setState({ item: item })
        }

        this.handleSelectChange = (currentNode, selectedNodes) => {
            let item = this.state.item
            item[currentNode.target.name] = currentNode.target.value

            if ('category_id' == currentNode.target.name) this.store.loadCharacteristics(currentNode.target.value)

            this.setState({ item: item })
        }

        this.save = () => {
            toast.info('Saving...', { position: toast.POSITION.BOTTOM_RIGHT })
            this.store.saveItem(this.state.item, this.state.images)
        }

        this.cancel = () => {
            location.href = "#/products"
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_PRODUCT_RESOURcES_SUCCESS', () => {
            let categories = []

            try {
                categories = objectTreeToArrList(this.store.resources.categoriesTree, 'childs', 'name', ['id', 'name'], ['id', 'text'])
            } catch (error) {
                console.log(error)
                categories = []
            }

            this.setState({
                categories: categories,
                vendors: objectToArrList(this.store.resources.vendors, ['id', 'name'], ['id', 'text'])
            })

            toast.dismiss()
        })

        this.store.emitter.addListener('GET_PRODUCT_RESOURCES_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot retrieve item: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('GET_PRODUCT_CHARACTERISTICS_SUCCESS', () => {
            toast.dismiss()
            this.setState({
                characteristics: this.store.characteristics
            })
        })

        this.store.emitter.addListener('GET_PRODUCT_CHARACTERISTICS_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot save item: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('GET_PRODUCT_RESOURCES_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot save item: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('SAVE_PRODUCT_SUCCESS', () => {
            toast.dismiss()
            toast.success('Item saved', { position: toast.POSITION.BOTTOM_RIGHT, pauseOnFocusLoss: false })
            this.setState({ item: this.store.item })
        })
    }

    render() {
        const { id, item, categories, vendors, characteristics, images } = this.state

        return <Form id={`prod-${id}`}>
            <Tabs>
                <TabList>
                    <Tab>General info</Tab>
                    <Tab>Characteristics</Tab>
                    <Tab>Images</Tab>
                </TabList>

                <TabPanel>
                    <div className="container-fluid">
                        <Row>
                            <Col xs="12" lg="6" md="6" key={uuidv4()}>
                                <Card>
                                    <Card.Body>
                                        <Form.Group>
                                            <Form.Label>Product name</Form.Label>
                                            <Form.Control name="name" required type="text" value={item.name} onChange={this.handleChange} key={uuidv4()}></Form.Control>
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Product description</Form.Label>
                                            <Editor
                                                textareaName="description"
                                                initialValue={item.description}
                                                init={{
                                                    height: 300,
                                                    menubar: false,
                                                    plugins: [
                                                        'advlist autolink lists link image charmap print preview anchor',
                                                        'searchreplace visualblocks code fullscreen',
                                                        'insertdatetime media table paste code help wordcount'
                                                    ],
                                                    toolbar:
                                                        'undo redo | formatselect | bold italic backcolor | \
             alignleft aligncenter alignright alignjustify | \
             bullist numlist outdent indent | removeformat | help'
                                                }}
                                                onEditorChange={this.handleEditorChange}
                                            />
                                        </Form.Group>
                                    </Card.Body>
                                </Card>
                            </Col>
                            <Col xs="12" lg="6" md="6" key={uuidv4()}>
                                <Card>
                                    <Card.Body>
                                        <Form.Group>
                                            <Form.Label>Category</Form.Label>
                                            <Select2 name="category_id" required style={{ width: '100%' }} data={categories} options={{ placeholder: 'Select parent category' }} value={item.category_id} onChange={this.handleSelectChange} />
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Vendor</Form.Label>
                                            <Select2 name="vendor_id" required style={{ width: '100%' }} data={vendors} options={{ placeholder: 'Select vendor' }} value={item.vendor_id} onChange={this.handleSelectChange} />
                                        </Form.Group>
                                    </Card.Body>
                                </Card>
                                <Card>
                                    <Card.Body>
                                        <Form.Group>
                                            <Form.Label>Price</Form.Label>
                                            <div className="input-group">
                                                <Form.Control required type="number" name="price" min="0" max="999999" value={item.price} onChange={this.handleChange}></Form.Control>
                                                <div className="input-group-append"><span className="input-group-text">LEI</span></div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Min price</Form.Label>
                                            <div className="input-group">
                                                <Form.Control type="number" name="price_min" min="0" max="999999" value={item.price_min} onChange={this.handleChange}></Form.Control>
                                                <div className="input-group-append"><span className="input-group-text">LEI</span></div>
                                            </div>
                                            <p className="help-block">The minimum price below which the virtual agent should not go. Leave 0 or empty for no minimum price.</p>
                                        </Form.Group>
                                    </Card.Body>
                                </Card>
                            </Col>
                        </Row>
                    </div>
                </TabPanel>
                <TabPanel>
                    <div className="container-fluid">
                        <Row>
                            {Object.keys(characteristics).map((key) => <ProductCharacteristicGroup key={uuidv4()} name={key} items={characteristics[key]}></ProductCharacteristicGroup>)}
                        </Row>
                    </div>
                </TabPanel>
                <TabPanel>
                    <div className="container-fluid gallery">
                        <Row>
                            <Col xl="2" lg="4" md="4" sm="6" xs="12" key={uuidv4()}><Form.Control type="file" multiple accept="image/*" onChange={this.handleChange}></Form.Control></Col>
                            {item.images.map(image => <Col xl="1" lg="2" md="4" sm="6" xs="12" key={uuidv4()}><Image src={image.file} thumbnail></Image></Col>)}
                        </Row>
                    </div>
                </TabPanel>
            </Tabs>
            <BtnSave onClick={this.save} onCancel={this.cancel}></BtnSave>
        </Form>
    }
} export default ProductForm
