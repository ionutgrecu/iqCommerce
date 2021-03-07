import React from 'react'
import { Card, Col, Row, Table } from 'react-bootstrap'
import VendorsStore from '../../stores/VendorsStore'
import VendorItem from './VendorItem'
import AddButton from '../AddButton'
import { confirmComplex } from '../Categories/ComplexConfirmation'
import { toast } from 'react-toastify'

class Vendors extends React.Component {
    constructor() {
        super()

        this.state = {
            items: [],
        }

        this.store = new VendorsStore()
        this.store.getItems()

        this.delete=(item)=>{
            if (!confirm('Delete this item?')) return

            // if(item.product_count>0)
            // confirmComplex({
            //     title:''
            // })

            toast.info('Deleting...', { position: toast.POSITION.BOTTOM_RIGHT })
            this.store.deleteItem(item.id)
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_VENDORS_SUCCESS', () => {
            this.setState({ items: this.store.items })
        })

        this.store.emitter.addListener('GET_VENDORS_ERROR',(err)=>{
            toast.error(err.message, { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('DELETE_VENDOR_SUCCESS', (id) => {
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
                        <Card.Header>Vendors</Card.Header>
                        <Card.Body>
                            <Table responsive striped bordered hover size="sm">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Logo</td>
                                        <td>Products no.</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        this.state.items.map(e=><VendorItem key={e.id} item={e} onDelete={this.delete} />)
                                    }
                                </tbody>
                            </Table>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
            <AddButton />
        </div>
    }
} export default Vendors;
