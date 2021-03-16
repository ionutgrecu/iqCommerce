import './App.scss'
import React, { Component } from 'react'
import { HashRouter as Router, Switch, Route, Link } from 'react-router-dom'
import Main from './Main'
import Categories from './Categories/Categories'
import Characteristics from './Characteristics/Characteristics'
import Orders from './Orders'
import Vendors from './Vendors/Vendors'
import VendorForm from './Vendors/VendorForm'
import CategoryForm from './Categories/CategoryForm'
import AddButton from './AddButton'
import CharacteristicForm from './Characteristics/CharacteristicForm'
import Products from './Products/Products'
import ProductForm from './Products/ProductForm'

class App extends React.Component {
    render() {
        return <>
            <AddButton></AddButton>
            <Router >
                <Switch>
                    <Route path='/vendors' component={Vendors} />
                    <Route path='/add-vendor' component={VendorForm} />
                    <Route path='/edit-vendor/:id' component={VendorForm} />
                    <Route path='/categories' component={Categories} />
                    <Route path='/add-category' component={CategoryForm} />
                    <Route path='/edit-category/:id' component={CategoryForm} />
                    <Route path='/characteristics' component={Characteristics} />
                    <Route path='/add-characteristic' component={CharacteristicForm} />
                    <Route path='/edit-characteristic/:id' component={CharacteristicForm} />
                    <Route path='/products' component={Products} />
                    <Route path='/add-product' component={ProductForm} />
                    <Route path='/edit-product/:id' component={ProductForm} />
                    <Route exact path='/' component={Main} />
                    <Route path='/orders' component={Orders} />
                </Switch>
            </Router>
        </>
    }
}

export default App;
