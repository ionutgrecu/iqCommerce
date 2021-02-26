import React from 'react'
import {Link} from 'react-router-dom'
import CategoriesStore from '../stores/CategoriesStore'

class Categories extends React.Component {
    constructor() {
        super()

        this.state={
            items:[]
        }

        this.store=new CategoriesStore()
        this.store.getItems()
    }

    componentDidMount(){
        this.store.emitter.addListener('GET_CATEGORIES_SUCCESS',()=>{
            this.setState({
                items:this.store.items
            })
        });
    }

    render() {
        return <>
        <div>Categories</div>
        <Link to={'/orders'} className="nav-link">Orders</Link>
        </>
    }
} export default Categories;
