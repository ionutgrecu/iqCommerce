import React from "react"
import { Button, Image } from "react-bootstrap"
import DataTable from "react-data-table-component"
import { toast } from "react-toastify"
import ProductsStore from "../../stores/ProductsStore"
import { v4 as uuidv4 } from 'uuid'
import memoize from 'memoize-one'

class Products extends React.Component {
    constructor() {
        super()

        const  columns=memoize(handleAction =>  [
            { name: '#', selector: 'id', sortable: true },
            { name: 'Name', selector: 'name', sortable: true },
            { name: 'Vendor', selector: 'vendor.name', sortable: true },
            { name: 'Image', cell: row => <>{row.images.length ? <Image src={-1 == row.images[0].file.indexOf(':/') ? `${ASSETS_URL}${row.images[0].file}` : row.images[0].file} className="preview"></Image> : ''}</> },
            { name: "Price", cell: (row) => <>{row.price_min > 0 ? <><del>{row.price}</del> <div className="price">{row.price_min}</div></> : <div className="price">{row.price}</div>}</>, sortable: false, right: true },
            { name: '', cell: (row) => <Button variant="danger" onClick={this.deleteItem} id={`btnId-${row.id}`}><i className="fas fa-trash-alt" id={`btnIdIcon-${row.id}`}></i></Button>, ignoreRowClick: false, allowOverflow: true, button: false }
        ])

        this.state = {
            items: []
        }

        this.store = new ProductsStore()
        this.store.getItems()

        this.deleteItem = (e) => {
            let id = e.target.id.replace('btnId-', '').replace('btnIdIcon-', '')
            this.store.deleteItem(id)
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_PRODUCTS_SUCCESS', () => {
            toast.dismiss()
            this.setState({ items: this.store.items })
        })

        this.store.emitter.addListener('GET_PRODUCTS_ERROR', errors => {
            toast.dismiss()
            toast.error('Cannot retrieve data: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('DELETE_PRODUCT_SUCCESS', (id) => {
            let { items } = this.state

            for (let i in items){
                console.log(items[i].id+" "+id)
                if (items[i].id == id){
                    console.log('xx')
                     delete items[i]
                }
            }

            this.setState({ items: items })
            this.handleAction
            toast.dismiss()
        })

        this.store.emitter.addListener('DELETE_PRODUCT_ERROR', errors => {
            toast.dismiss()
            toast.error('Cannot delete item: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })
    }

    render() {
        let { items } = this.state

        return <DataTable
            title="Product list"
            pagination={true}
            paginationServer={true}
            paginationServerOptions={{ persistSelectedOnPageChange: false, persistSelectedOnSort: false }}
            className="table"
            columns={this.columns}
            data={items}
        />
    }
} export default Products
