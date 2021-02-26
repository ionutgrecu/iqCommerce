import React from 'react'
import Button from 'react-bootstrap/Button';

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
                <td>{item.name}</td>
            </tr>
        </>
    }
} export default CategoryItem
