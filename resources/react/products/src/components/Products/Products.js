import React from "react"
import { Button, Image } from "react-bootstrap"
import DataTable from "react-data-table-component"
import { toast } from "react-toastify"
import ProductsStore from "../../stores/ProductsStore"

class Products extends React.Component {
    constructor() {
        super()

        this.state = {
            columns: [
                { name: '#', selector: 'id', sortable: true },
                { name: 'Name', selector: 'name', sortable: true },
                { name: 'Vendor', selector: 'vendor.name', sortable: true },
                { name: 'Image', cell: row => <>{row.images.length ? <Image src={-1 == row.images[0].file.indexOf(':/') ? `${ASSETS_URL}${row.images[0].file}` : row.images[0].file} className="preview"></Image> : ''}</> },
                { name: "Price", cell: (row) => <>{row.price_min > 0 ? <><del>{row.price}</del> <div className="price">{row.price_min}</div></> : <div className="price">{row.price}</div>}</>, sortable: false, right: true },
                { name: '', cell: (row) => <Button variant="danger" onClick={this.deleteItem} id={row.id}><i className="fas fa-trash-alt"></i></Button>, ignoreRowClick: true, allowOverflow: true, button: true }
            ],
            items: []
        }

        this.store = new ProductsStore()
        this.store.getItems()

        this.deleteItem = (e) => {
            this.store.deleteItem(e.target.id)
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
        });
    }

    render() {
        let { columns, items } = this.state

        return <DataTable
            title="Product list"
            pagination={true}
            paginationServer={true}
            paginationServerOptions={{ persistSelectedOnPageChange: false, persistSelectedOnSort: false }}
            className="table"
            columns={columns}
            data={items}
        />
    }
} export default Products
