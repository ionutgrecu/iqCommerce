import './App.scss';
import React, { Component } from 'react'
import { HashRouter as Router, Switch, Route, Link } from 'react-router-dom'
import Main from './Main'
import Categories from './Categories'
import Characteristics from './Characteristics'
import Orders from './Orders'
import Vendors from './Vendors'
import CategoryForm from './CategoryForm'

class App extends React.Component {
    render() {
        return <Router>
                <Switch>
                    <Route path='/vendors' component={Vendors} />
                    <Route path='/categories' component={Categories} />
                    <Route path='/add-category' component={CategoryForm} />
                    <Route path='/characteristics' component={Characteristics} />
                    <Route exact path='/' component={Main} />
                    <Route path='/orders' component={Orders} />
                </Switch>
        </Router>
    }
}

export default App;
