import React from 'react'
import { Link } from 'react-router-dom'
import CategoryItem from './CategoryItem'
import CategoryForm from './CategoryForm'
import CategoriesStore from '../stores/CategoriesStore'
import { Table } from 'react-bootstrap'
import AddButton from './AddButton'
import { toast } from 'react-toastify'

toast.configure()

class Categories extends React.Component {
    constructor() {
        super()

        this.state = {
            items: [],
        }

        this.store = new CategoriesStore()
        this.store.getItems()

        this.delete = (id) => {
            if (!confirm('Delete this item?')) return

            toast.info('Deleting...', { position: toast.POSITION.BOTTOM_RIGHT })
            this.store.deleteItem(id)
        }

        this.edit = (item) => {
            location.href = "/#/edit-category/" + item.id
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_CATEGORIES_SUCCESS', () => {
            this.setState({
                items: this.store.items,
            })
        })

        this.store.emitter.addListener('GET_CATEGORIES_ERROR', (err) => {
            toast.error(err.response.data.message, { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('DELETE_CATEGORY_SUCCESS', (id) => {
            let items = this.state.items

            for (let i in items)
                if (items[i].id == id)
                    delete (items[i])

            this.setState({ items: items })

            toast.dismiss()
            toast.success('Item deleted', { position: toast.POSITION.BOTTOM_RIGHT, pauseOnFocusLoss: false })
        })
    }

    render() {
        return <>
            <Table striped bordered hover size="sm">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    {
                        this.state.items.map(e => <CategoryItem key={e.id} item={e} onDelete={this.delete} onEdit={this.edit}></CategoryItem>)
                    }
                </tbody>
            </Table>
            <AddButton />
        </>
    }
} export default Categories
