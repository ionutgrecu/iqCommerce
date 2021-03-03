import React from 'react'
import Button from 'react-bootstrap/Button'

class CategoryItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: props.item
        }

        this.delete = () => {
            props.onDelete(this.state.item.id)
        }
    }

    render() {
        const { item } = this.state

        return <>
            <tr id={"cat-" + item.id}>
                <td>{item.id}</td>
                <td>{item.name}</td>
                <td><Button variant="success"><i className="fas fa-pencil-alt"></i> Edit</Button> <Button variant="danger" onClick={this.delete}><i className="fas fa-trash-alt"></i> Delete</Button> </td>
            </tr>
        </>
    }
} export default CategoryItem
