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

        this.handleChange = (e) => {
            if ('function' == typeof (this.props.onChange))
                this.props.onChange(e)
        }
    }

    render() {
        return <Col xs="12" lg="6" md="6">
            <Card>
                <Card.Header>{this.state.name}</Card.Header>
                <Card.Body>
                    {Object.keys(this.state.items).map((key) => <ProductCharacteristicItem key={key} name={key} item={this.state.items[key]} onChange={this.handleChange}></ProductCharacteristicItem>)}
                </Card.Body>
            </Card>
        </Col>
    }
} export default ProductCharacteristicGroup
