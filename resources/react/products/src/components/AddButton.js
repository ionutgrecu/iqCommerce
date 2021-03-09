import React from 'react'
import { HashRouter as Router, Switch, Route, Link } from 'react-router-dom'
import { Fab, Action } from 'react-tiny-fab'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faAsterisk, faCubes, faPlus, faSitemap, faUserSecret } from '@fortawesome/free-solid-svg-icons'

class AddButton extends React.Component {
    addCategory() {
        location.href = "#/add-category"
    }

    addVendor() {
        location.href = "#/add-vendor"
    }

    addCharacteristic() {
        location.href = "#/add-characteristic"
    }

    addProduct() {
        location.href = '#/add-product'
    }

    render() {
        return <Fab
            icon={<FontAwesomeIcon icon={faPlus} />}
            alwaysShowTitle={true}
        >
            <Action text="Category" onClick={this.addCategory}><FontAwesomeIcon icon={faSitemap} /></Action>
            <Action text="Vendor" onClick={this.addVendor}><FontAwesomeIcon icon={faUserSecret} /></Action>
            <Action text="Characteristic" onClick={this.addCharacteristic}><FontAwesomeIcon icon={faAsterisk} /></Action>
            <Action text="Product" onClick={this.addProduct}><FontAwesomeIcon icon={faCubes} /></Action>
        </Fab>
    }
} export default AddButton
