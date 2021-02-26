import React from 'react'
import { Link } from 'react-router-dom'
import CategoryItem from './CategoryItem'
import CategoriesStore from '../stores/CategoriesStore'

class Categories extends React.Component {
    constructor() {
        super()

        this.state = {
            items: []
        }

        this.store = new CategoriesStore()
        this.store.getItems()
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_CATEGORIES_SUCCESS', () => {
            this.setState({
                items: this.store.items
            })
        });
    }

    render() {
        return <>
            <table>
                <tbody>
                    {
                        this.state.items.map(e => <CategoryItem key={e.id} item={e}></CategoryItem>)
                    }
                </tbody>
            </table>
        </>
    }
} export default Categories
