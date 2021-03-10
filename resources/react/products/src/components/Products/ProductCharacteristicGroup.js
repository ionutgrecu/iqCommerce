import React from 'react'
import { Card, Col } from 'react-bootstrap'
import ProductCharacteristicItem from './ProductCharacteristicItem'
import { v4 as uuidv4 } from 'uuid'

class ProductCharacteristicGroup extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            name: props.name,
            items: props.items
        }
    }

    render() {
        return <Col xs="12" lg="6" md="6">
            <Card>
                <Card.Header>{this.state.name}</Card.Header>
                <Card.Body>
                    {Object.keys(this.state.items).map((key) => <ProductCharacteristicItem key={uuidv4} name={key} item={this.state.items[key]}></ProductCharacteristicItem>)}
                </Card.Body>
            </Card>
        </Col>
    }
} export default ProductCharacteristicGroup
