import { Editor } from "@tinymce/tinymce-react"
import Select2 from 'react-select2-wrapper'
import React from "react"
import { Card, Col, Container, Row, Form } from "react-bootstrap"
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css'
import ProductsStore from "../../stores/ProductsStore"
import BtnSave from "../BtnSave"

class ProductForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.match.params.id ? this.props.match.params.id : 0,
            item: { name: '', description: '', category_id: null, vendor_id: null, price: 0, price_min: 0 },
            categories: [],
            vendors: [],
        }

        this.store = new ProductsStore()

        if(!this.props.match.params.id)this.store.loadResources()

        this.handleChange = (e) => {
            let item = this.state.item
            item[e.target.name] = e.target.value

            if (item.price_min > item.price && item.price) item.price_min = item.price

            this.setState({ item: item })
        }

        this.handleEditorChange = (content, editor) => {
            let item = this.state.item
            item.description = content
            this.setState({ item: item })
        }

        this.handleSelectChange = (currentNode, selectedNodes) => {
            let item = this.state.item
            item[currentNode.target.name] = currentNode.target.value
            this.setState({ item: item })
        }

        this.save = () => {

        }

        this.cancel = () => {
            location.href = "#/products"
        }
    }

    render() {
        const {id, item, categories, vendors } = this.state

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
                            <Col xs="12" lg="6" md="6">
                                <Card>
                                    <Card.Body>
                                        <Form.Group>
                                            <Form.Label>Product name</Form.Label>
                                            <Form.Control required type="text" name="name" value={item.name} onChange={this.handleChange}></Form.Control>
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Product description</Form.Label>
                                            <Editor
                                                initialValue={item.description}
                                                value={item.description}
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
                            <Col xs="12" lg="6" md="6">
                                <Card>
                                    <Card.Body>
                                        <Form.Group>
                                            <Form.Label>Category</Form.Label>
                                            <Select2 required style={{ width: '100%' }} data={categories} options={{ placeholder: 'Select parent category' }} value={item.category_id} onChange={this.handleSelectChange} />
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Vendor</Form.Label>
                                            <Select2 required style={{ width: '100%' }} data={vendors} options={{ placeholder: 'Select vendor' }} value={item.vendor_id} onChange={this.handleSelectChange} />
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
                    <h2>Any content 2</h2>
                </TabPanel>
                <TabPanel>

                </TabPanel>
            </Tabs>
            <BtnSave onClick={this.save} onCancel={this.cancel}></BtnSave>
        </Form>
    }
} export default ProductForm
