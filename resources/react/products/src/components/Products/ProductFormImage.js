import React from "react"
import { Card, Col, Container, Form, Image, Row } from "react-bootstrap"

class ProductFormImage extends React.Component {
    constructor(props) {
        super(props)

        this.state={
            item:this.props.item
        }
    }

    render(){
        let {item}=this.state

        return <Col xl="1" lg="2" md="4" sm="6" xs="12">
            <Image src={item.file.indexOf(':/')==-1?`${ASSETS_URL}${item.file}`:item.file} thumbnail></Image>
        </Col>
    }
} export default ProductFormImage
