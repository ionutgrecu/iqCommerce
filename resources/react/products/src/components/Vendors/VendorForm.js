import React from 'react'
import VendorsStore from '../../stores/VendorsStore'
import { withRouter } from 'react-router-dom'
import { Container, Row, Col, Form, Card, Button } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'
import Select2 from 'react-select2-wrapper'
import SingleImageUpload from '../SingleImageUpload'
import BtnSave from '../BtnSave'
import { toast } from 'react-toastify'
import { objectTreeToArrList } from '../../helpers'

toast.configure()

class VendorForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.match.params.id ? this.props.match.params.id : 0,
            item: { name: '', image: '', },
        }

        this.store = new VendorsStore()

        if (this.props.match.params.id) {
            toast.info('Item is loading, wait...', { position: toast.POSITION.BOTTOM_RIGHT, autoClose: false })

            this.store.getItem(this.props.match.params.id)
        }

        this.handleChange = (e) => {
            let item = this.state.item

            if ('object' == typeof (e.target.files) && e.target.files && 'object' == typeof (e.target.files[0]))
                item[e.target.name] = e.target.files[0]
            else item[e.target.name] = e.target.value

            this.setState({ item: item })
        }

        this.save = () => {
            toast.info('Saving...', { position: toast.POSITION.BOTTOM_RIGHT })
            this.store.saveItem(this.state.item)
        }

        this.cancel = () => {
            location.href = "#/vendors"
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_VENDOR_SUCCESS', () => {
            this.setState({ item: this.store.item })

            toast.dismiss()
        })

        this.store.emitter.addListener('GET_VENDOR_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot load item: ' + errors.message + ', ' + errors.errors.join(', '), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('SAVE_VENDOR_SUCCESS', () => {
            toast.dismiss()
            toast.success('Item saved', { position: toast.POSITION.BOTTOM_RIGHT, pauseOnFocusLoss: false })
            this.setState({ item: this.store.item })
        })

        this.store.emitter.addListener('SAVE_VENDOR_ERROR', (message, errors) => {
            toast.dismiss()
            toast.error('Cannot save item: ' + message + ", " + errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
            console.log('Error on category save: ' + errors.join("\n"))
        })
    }

    render() {
        const { id, item } = this.state

        return <Container>
            <Row className="justify-content-md-center">
                <Col xs lg="6" md="10">
                    <Card>
                        <Card.Header>{id == 0 ? "Add" : `Edit vendor ${item.name}`}</Card.Header>
                        <Card.Body>
                            <Form id={`cat-${id}`}>
                                <Form.Group>
                                    <Form.Label>Name</Form.Label>
                                    <Form.Control type="text" name="name" placeholder="Vendor Name" value={item.name} onChange={this.handleChange}></Form.Control>
                                </Form.Group>
                                <Form.Group>
                                    <SingleImageUpload name="image" file={item.image} onChange={this.handleChange}></SingleImageUpload>
                                </Form.Group>
                            </Form>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
            <BtnSave onClick={this.save} onCancel={this.cancel}></BtnSave>
        </Container>
    }
} export default withRouter(VendorForm)
