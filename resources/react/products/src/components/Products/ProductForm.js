import { Editor } from "@tinymce/tinymce-react"
import Select2 from 'react-select2-wrapper'
import React from "react"
import { Card, Col, Container, Row, Form } from "react-bootstrap"
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css'
import ProductsStore from "../../stores/ProductsStore"

class ProductForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: { name: '', description: '', category_id: null, vendor_id: null },
            categories: [],
            vendors: [],
        }

        this.store = new ProductsStore()

        this.handleChange = (e) => {
            let item = this.state.item
            item[e.target.name] = e.target.value
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
    }

    render() {
        const { item, categories, vendors } = this.state

        return <Tabs>
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
                                        <Form.Control type="text" name="name" value={item.name} onChange={this.handleChange}></Form.Control>
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
                                        <Select2 style={{ width: '100%' }} data={categories} options={{ placeholder: 'Select parent category' }} value={item.category_id} onChange={this.handleSelectChange} />
                                    </Form.Group>
                                    <Form.Group>
                                        <Form.Label>Vendor</Form.Label>
                                        <Select2 style={{ width: '100%' }} data={vendors} options={{ placeholder: 'Select vendor' }} value={item.vendor_id} onChange={this.handleSelectChange} />
                                    </Form.Group>
                                </Card.Body>
                            </Card>
                            <Card>
                                <Card.Body>
                                    <Form.Group>
                                        <Form.Label>Price</Form.Label>
                                        <Form.Control type="number"></Form.Control>
                                    </Form.Group>
                                    <Form.Group>
                                        <Form.Label>Vendor</Form.Label>
                                        <Select2 style={{ width: '100%' }} data={vendors} options={{ placeholder: 'Select vendor' }} value={item.vendor_id} onChange={this.handleSelectChange} />
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
    }
} export default ProductForm
