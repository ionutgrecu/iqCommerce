import React from 'react'
import Button from 'react-bootstrap/Button'

class CategoryItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            content: this.props.item.content
        }
    }

    render() {
        const { item } = this.props

        return <>
            <tr>
                <td>{item.id}</td>
                <td>{item.name}</td>
                <td><Button variant="success"><i className="fas fa-pencil-alt"></i> Edit</Button> <Button variant="danger"><i className="fas fa-trash-alt"></i> Delete</Button> </td>
            </tr>
        </>
    }
} export default CategoryItem
