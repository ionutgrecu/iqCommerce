import React from 'react'
import CategoryItem from './CategoryItem'
import CategoriesStore from '../stores/CategoriesStore'
import { Table, Container, Row, Col, Card } from 'react-bootstrap'
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
        return <div className="container-fluid">
            <Row>
                <Col xs lg md>
                    <Card>
                        <Card.Header>Categories</Card.Header>
                        <Card.Body>
                            <Table responsive striped bordered hover size="sm">
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
                                        this.state.items.map(e => <CategoryItem key={e.id} item={e} onDelete={this.delete}></CategoryItem>)
                                    }
                                </tbody>
                            </Table>
                        </Card.Body>
                    </Card>
                </Col>
                <AddButton />
            </Row>
        </div>
    }
} export default Categories
