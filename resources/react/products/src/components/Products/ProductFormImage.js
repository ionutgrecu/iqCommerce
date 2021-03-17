import { FontAwesomeIcon } from "@fortawesome/react-fontawesome"
import React from "react"
import { Button, Card, Col, Container, Form, Image, Row } from "react-bootstrap"

class ProductFormImage extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.id,
            item: this.props.item,
            className: this.props.className,
        }

        this.handleImageDelete = (e) => {
            let { item, id } = this.state

            if ('function' == typeof (props.onDelete)) props.onDelete(e, id, item)
        }

        this.handleImageDefault = (e) => {
            let { item } = this.state

            if ('function' == typeof (props.onDefault)) props.onDefault(e, item)
        }
    }

    render() {
        let { id, item, className } = this.state

        const renderImage = () => {
            if ('File' == item.constructor.name) {
                return <>
                    <div className="buttons">
                        <Button variant="danger" onClick={this.handleImageDelete} title="Delete"><i className="fas fa-trash-alt"></i></Button>
                    </div>
                    <Image src={URL.createObjectURL(item)} thumbnail></Image></>
            } else if ('string' == typeof (item.file)) {
                return <>
                    <div className="buttons">
                        <Button variant="warning" onClick={this.handleImageDefault} title="Make default"><i className="far fa-star"></i></Button>
                        <Button variant="danger" onClick={this.handleImageDelete} title="Delete"><i className="fas fa-trash-alt"></i></Button>
                    </div>
                    <Image className={item.default?'default':''} src={-1 == item.file.indexOf(':/') ? `${ASSETS_URL}${item.file}` : item.file} thumbnail></Image></>
            }
        }

        return <Col xl="2" lg="2" md="4" sm="6" xs="12" className={className} id={`img-${id}`}>
            {renderImage()}
        </Col>
    }
} export default ProductFormImage
