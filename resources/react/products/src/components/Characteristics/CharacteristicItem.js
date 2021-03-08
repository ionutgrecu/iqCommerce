import React from 'react'
import { Button } from 'react-bootstrap'

class CharacteristicItem extends React.Component {
    constructor(props) {
        super(props)

        this.state={item:props.item}

    }

    render(){
        const {item}=this.state

        return <tr>
            <td>{item.id}</td>
            <td>{item.name} {item.group?(<><br /><small>Group {item.group}</small></>):''}</td>
            <td>{item.category?item.category.name:'*'}</td>
            <td>{item.type}</td>
            <td>{item.is_filter?(<i class="fas fa-check"></i>):''}</td>
            <td><Button variant="success" href={"#/edit-characteristic/"+item.id}><i className="fas fa-pencil-alt"></i> Edit</Button> <Button variant="danger"><i className="fas fa-trash-alt"></i> Delete</Button></td>
        </tr>
    }
} export default CharacteristicItem
