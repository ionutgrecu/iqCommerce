import React from 'react'
import { toast } from 'react-toastify'
import { Table, Container, Row, Col, Card } from 'react-bootstrap'
import CharacteristicsStore from '../../stores/CharacteristicsStore'
import CharacteristicItem from './CharacteristicItem'

class Characteristics extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            items: []
        }

        this.store = new CharacteristicsStore()
        this.store.getItems()
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_CHARACTERISTICS_SUCCESS', () => {
            this.setState({ items: this.store.items })
        })

        this.store.emitter.addListener('GET_CHARACTERISTICS_ERROR', (message, errors) => {
            toast.error(message, { position: toast.POSITION.BOTTOM_RIGHT })
        })
    }

    render() {
        return <div className="container-fluid">
            <Row>
                <Col xs lg md>
                    <Card>
                        <Card.Header>Characteristics</Card.Header>
                        <Card.Body>
                            <Table responsive striped bordered hover size="sm">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Category</td>
                                        <td>Type</td>
                                        <td>Is Filter</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {this.state.items.map(e => <CharacteristicItem key={e.id} item={e}></CharacteristicItem>)}
                                </tbody>
                            </Table>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
        </div>
    }
} export default Characteristics;
