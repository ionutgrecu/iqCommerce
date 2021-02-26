import React from 'react'
import {Link} from 'react-router-dom'

class Categories extends React.Component {
    constructor() {
        super()

        this.state={

        }
    }

    render() {
        return <>
        <div>Categories</div>
        <Link to={'/orders'} className="nav-link">Orders</Link>
        </>
    }
} export default Categories;
