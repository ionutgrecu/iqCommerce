import React from 'react'
import {Button,Image} from 'react-bootstrap'

class CategoryItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: props.item
        }

        this.delete = () => {
            props.onDelete(this.state.item)
        }
    }

    render() {
        const { item } = this.state

        return <>
            <tr id={"cat-" + item.id}>
                <td>{item.id}</td>
                <td>{item.name} {item.parents?(<><br /><small>{item.parents.map((e)=>{return e.name+" / "})}</small></>):''}</td>
                <td><div className="preview"><Image src={(item.image && item.image.indexOf('://')>-1)?item.image:ASSETS_URL+item.image}></Image></div></td>
                <td><Button variant="success" href={"#/edit-category/"+item.id}><i className="fas fa-pencil-alt"></i> Edit</Button> <Button variant="danger" onClick={this.delete}><i className="fas fa-trash-alt"></i> Delete</Button> </td>
            </tr>
        </>
    }
} export default CategoryItem
