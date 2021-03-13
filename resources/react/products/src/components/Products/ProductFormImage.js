import { FontAwesomeIcon } from "@fortawesome/react-fontawesome"
import React from "react"
import { Button, Card, Col, Container, Form, Image, Row } from "react-bootstrap"

class ProductFormImage extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id:this.props.id,
            item: this.props.item
        }

        this.handleImageDelete = (e) => {
            let {item,id}=this.state

            if ('function' == typeof (props.onDelete)) props.onDelete(e,id)
        }
    }

    render() {
        let { item } = this.state
console.log(item)
        return <Col xl="1" lg="2" md="4" sm="6" xs="12">
            <Button variant="danger" onClick={this.handleImageDelete}><i className="fas fa-trash-alt"></i></Button>
            <Image src={item.file.indexOf(':/') == -1 ? `${ASSETS_URL}${item.file}` : item.file} thumbnail></Image>
        </Col>
    }
} export default ProductFormImage
