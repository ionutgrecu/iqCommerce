import './App.scss';
import React, { Component } from 'react'
import { HashRouter as Router, Switch, Route, Link } from 'react-router-dom'
import Main from './Main'
import Categories from './Categories'
import Characteristics from './Characteristics'
import Orders from './Orders'
import Vendors from './Vendors'

class App extends React.Component {
    render() {
        return <Router>
            <div>
                <h2>Welcome to React Router Tutorial</h2>
                <nav className="navbar navbar-expand-lg navbar-light bg-light">
                    <ul className="navbar-nav mr-auto">
                        <li><Link to={'/'} className="nav-link"> Products </Link></li>
                        <li><Link to={'/categories'} className="nav-link">Categories</Link></li>
                        <li><Link to={'/characteristics'} className="nav-link">characteristics</Link></li>
                        <li><Link to={'/orders'} className="nav-link">Orders</Link></li>
                    </ul>
                </nav>
                <hr />
                <Switch>
                    <Route exact path='/vendors' component={Vendors} />
                    <Route path='/categories' component={Categories} />
                    <Route path='/characteristics' component={Characteristics} />
                    <Route path='/' component={Main} />
                    <Route path='/orders' component={Orders} />
                </Switch>
            </div>
        </Router>
    }
}

export default App;
