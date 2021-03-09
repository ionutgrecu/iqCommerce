import React from "react"
import { Card, Col, Container, Form, Row } from "react-bootstrap"
import { withRouter } from 'react-router-dom'
import { toast } from "react-toastify"
import CharacteristicsStore from "../../stores/CharacteristicsStore"
import BtnSave from "../BtnSave"
import Select2 from 'react-select2-wrapper'
import { objectTreeToArrList } from "../../helpers"
import { v4 as uuidv4, v4 } from 'uuid';

class CharacteristicForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.match.params.id ? this.props.match.params.id : 0,
            item: { name: '', group: '', category_id: null, is_filter: 0, append: '', prepend: '' },
            categories: [],
            nameValues: [],
            groupValues: [],
            typeValues: [],
            prependValues: [],
            appendValues: [],
        }

        this.store = new CharacteristicsStore()

        if (this.props.match.params.id) {
            toast.info('Item is loading, wait...', { position: toast.POSITION.BOTTOM_RIGHT, autoClose: false })

            this.store.getItem(this.props.match.params.id)
        }

        this.handleChange = (e) => {
            let item = this.state.item

            if ('checkbox' == e.target.type)
                item[e.target.name] = e.target.checked
            else
                item[e.target.name] = e.target.value

            this.setState({ item: item })
        }

        this.handleSelectChange = (currentNode, selectedNodes) => {
            let item = this.state.item

            item[currentNode.target.name] = currentNode.target.value
            this.setState({ item: item })
        }

        this.save = () => {
            toast.info('Saving...', { position: toast.POSITION.BOTTOM_RIGHT })
            this.store.saveItem(this.state.item)
        }

        this.cancel = () => {
            location.href = "#/characteristics"
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_CHARACTERISTIC_SUCCESS', () => {
            let categories = []

            try {
                categories = objectTreeToArrList(this.store.data.categories, 'childs', 'name', ['id', 'name'], ['id', 'text'])
            } catch (error) {
                console.log(error)
                categories = []
            }

            this.setState({
                item: this.store.data.data,
                categories: categories,
                nameValues: this.store.data.nameValues,
                groupValues: this.store.data.groupValues,
                typeValues: this.store.data.typeValues,
                prependValues: this.store.data.prependValues,
                appendValues: this.store.data.appendValues
            })

            toast.dismiss()
        })

        this.store.emitter.addListener('GET_CHARACTERISTIC_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot load item: ' + errors.message + ' ' + errors.errors.join(', '), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('SAVE_CHARACTERISTIC_SUCCESSS', () => {
            toast.dismiss()
            toast.success('Item saved', { position: toast.POSITION.BOTTOM_RIGHT, pauseOnFocusLoss: false })
            this.setState({ item: this.store.data.data })
        })

        this.store.emitter.addListener('SAVE_CHARACTERISTIC_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot save item: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })
    }

    render() {
        const { id, item, categories, nameValues, groupValues, typeValues, prependValues, appendValues } = this.state

        return <Container>
            <Row className="justify-content-md-center">
                <Col xs lg="6" md="10">
                    <Card>
                        <Card.Header>{id == 0 ? "Add characteristic" : `Edit characteristic ${item.name}`}</Card.Header>
                        <Card.Body>
                            <Form id={`cat-${id}`}>
                                <Form.Group>
                                    <Form.Label>Prepend</Form.Label>
                                    <Form.Control type="text" name="prepend" value={item.prepend ? item.prepend : ''} onChange={this.handleChange} autoComplete="off" list="prependValues"></Form.Control>
                                    <datalist id="prependValues">{prependValues.map(item => <option key={item}>{item}</option>)}</datalist>
                                </Form.Group>
                                <Form.Group>
                                    <Form.Label>Name</Form.Label>
                                    <Form.Control type="text" name="name" placeholder="Vendor Name" value={item.name} onChange={this.handleChange} autoComplete="off" list="nameValues"></Form.Control>
                                    <datalist id="nameValues">{nameValues.map(item => <option key={item}>{item}</option>)}</datalist>
                                </Form.Group>
                                <Form.Group>
                                    <Form.Label>Append</Form.Label>
                                    <Form.Control type="text" name="append" value={item.append ? item.append : ''} onChange={this.handleChange} autoComplete="off" list="appendValues"></Form.Control>
                                    <datalist id="appendValues">{appendValues.map(item => <option key={item}>{item}</option>)}</datalist>
                                </Form.Group>
                                <Form.Group>
                                    <Form.Label>Group</Form.Label>
                                    <Form.Control type="text" name="group" placeholder="Item group" value={item.group ? item.group : ''} onChange={this.handleChange} list="groupValues" autoComplete="off"></Form.Control>
                                    <datalist id="groupValues">{groupValues.map(item => <option key={item}>{item}</option>)}</datalist>
                                </Form.Group>
                                <Form.Group>
                                    <Form.Label>Category</Form.Label>
                                    <Select2 style={{ width: "100%" }} data={categories} options={{ placeholder: 'Select parent category' }} value={item.category_id ? item.category_id : ''} onChange={this.handleSelectChange} name="category_id"></Select2>
                                </Form.Group>
                                <Form.Group>
                                    <Form.Label>Type</Form.Label>
                                    <Select2 style={{ width: "100%" }} data={typeValues} options={{ placeholder: 'Select characteristic type' }} value={item.type} onChange={this.handleSelectChange} name="type"></Select2>
                                </Form.Group>
                                <Form.Group>
                                    <Form.Label>
                                        <Form.Check>
                                            <Form.Check.Input name="is_filter" id="isFilter" value="1" checked={item.is_filter} onChange={this.handleChange}></Form.Check.Input>
                                            <Form.Check.Label htmlFor="isFilter">Is filter</Form.Check.Label>
                                        </Form.Check>
                                    </Form.Label>
                                </Form.Group>
                            </Form>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
            <BtnSave onClick={this.save} onCancel={this.cancel}></BtnSave>
        </Container>
    }
} export default withRouter(CharacteristicForm)
