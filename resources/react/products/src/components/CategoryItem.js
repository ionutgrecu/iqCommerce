import React from 'react'
import {Button,Image} from 'react-bootstrap'

class CategoryItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: props.item
        }

        this.delete = () => {
            props.onDelete(this.state.item.id)
        }

        this.edit=()=>{
            props.onEdit(this.state.item)
        }
    }

    render() {
        const { item } = this.state

        return <>
            <tr id={"cat-" + item.id}>
                <td>{item.id}</td>
                <td>{item.name}</td>
                <td><div className="preview"><Image src={(item.image && item.image.indexOf('://')>-1)?item.image:ASSETS_URL+item.image}></Image></div></td>
                <td><Button variant="success" href={"/#/edit-category/"+item.id} onClick={this.edit}><i className="fas fa-pencil-alt"></i> Edit</Button> <Button variant="danger" onClick={this.delete}><i className="fas fa-trash-alt"></i> Delete</Button> </td>
            </tr>
        </>
    }
} export default CategoryItem
