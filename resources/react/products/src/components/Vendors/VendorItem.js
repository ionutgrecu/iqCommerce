import React from 'react'
import { Button, Image } from 'react-bootstrap'

class VendorItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: props.item
        }

        this.edit = () => {
            if ('function' == typeof (props.onEdit))
                props.onEdit(this.state.item)
        }

        this.delete = () => {
            if ('function' == typeof (props.onDelete))
                props.onDelete(this.state.item)
        }
    }

    render() {
        const { item } = this.state

        return <tr>
            <td>{item.id}</td>
            <td>{item.name}</td>
            <td><div className="preview"><Image src={(item.image && item.image.indexOf('://') > -1) ? item.image : ASSETS_URL + item.image}></Image></div></td>
            <td>{item.product_count}</td>
            <td><Button variant="success" href={"#/edit-vendor/" + item.id}><i className="fas fa-pencil-alt"></i> Edit</Button> <Button variant="danger" onClick={this.delete}><i className="fas fa-trash-alt"></i> Delete</Button></td>
        </tr>
    }
} export default VendorItem
