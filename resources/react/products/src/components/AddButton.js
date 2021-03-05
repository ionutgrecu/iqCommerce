import React from 'react'
import { HashRouter as Router, Switch, Route, Link } from 'react-router-dom'
import { Fab, Action } from 'react-tiny-fab'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faAsterisk, faCubes, faPlus, faSitemap, faUserSecret } from '@fortawesome/free-solid-svg-icons'
import CategoryForm from './CategoryForm'

class AddButton extends React.Component {
    addCategory() {
        location.href = "#/add-category"
    }

    render() {
        return <Fab
            icon={<FontAwesomeIcon icon={faPlus} />}
            alwaysShowTitle={true}
        >
            <Action text="Category"><FontAwesomeIcon icon={faSitemap} onClick={this.addCategory} /></Action>
            <Action text="Vendor"><FontAwesomeIcon icon={faUserSecret} /></Action>
            <Action text="Characteristic"><FontAwesomeIcon icon={faAsterisk} /></Action>
            <Action text="Product"><FontAwesomeIcon icon={faCubes} /></Action>
        </Fab>
    }
} export default AddButton
