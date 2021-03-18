import React, { useMemo } from "react"
import { Button, Image, Table } from "react-bootstrap"
import { toast } from "react-toastify"
import ProductsStore from "../../stores/ProductsStore"
import { v4 as uuidv4 } from 'uuid'
import DataTable from "../DataTable/DataTable"

class Products extends React.Component {
    constructor() {
        super()

        this.state = {
            columns: [
                { name: '#', selector: 'id', sortable: true },
                { name: 'Name', selector: 'name', sortable: true },
                { name: 'Vendor', selector: 'vendor.name', sortable: true },
                { name: 'Image', cell: row => <>{row.image ? <Image src={-1 == row.image.file.indexOf(':/') ? `${ASSETS_URL}${row.image.file}` : row.image.file} className="preview" loading="lazy"></Image> : ''}</> },
                { name: "Price", cell: (row) => <>{row.price_min > 0 ? <><del>{row.price}</del> <div className="price">{row.price_min}</div></> : <div className="price">{row.price}</div>}</>, sortable: false, right: true },
                { name: '', cell: (row) => <><Button variant="success" href={`#/edit-product/${row.id}`} title="Edit"><i className="fas fa-pencil-alt"></i></Button> <Button variant="danger" onClick={this.deleteItem} id={`btnId-${row.id}`} title="Delete"><i className="fas fa-trash-alt" id={`btnIdIcon-${row.id}`}></i></Button></>, ignoreRowClick: true, allowOverflow: true, button: true }
            ],
            items: [],
            links: [],
            currentPage: 1,
        }

        this.store = new ProductsStore()
        this.store.getItems()

        this.deleteItem = (e) => {
            if (!confirm('Delete this item?')) return

            toast.info('Deleting item...', { position: toast.POSITION.BOTTOM_RIGHT })
            let id = e.target.id.replace('btnId-', '').replace('btnIdIcon-', '')
            this.store.deleteItem(id)
        }

        this.handePageClick = (e) => {
            if (!e.target.dataset.page) return

            let url = new URL(e.target.dataset.page)
            this.store.getItems(url.searchParams.get('page'))
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_PRODUCTS_SUCCESS', () => {
            this.setState({ items: this.store.items, links: this.store.links, currentPage: this.store.currentPage })
            toast.dismiss()
        })

        this.store.emitter.addListener('GET_PRODUCTS_ERROR', errors => {
            toast.dismiss()
            toast.error('Cannot retrieve data: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })

        this.store.emitter.addListener('DELETE_PRODUCT_SUCCESS', (id) => {
            // let { items } = this.state

            // for (let i in items)
            //     if (items[i].id == id)
            //         items.splice(i,1)

            // this.setState({ items: items })
            // toast.dismiss()
            this.store.getItems()
        })

        this.store.emitter.addListener('DELETE_PRODUCT_ERROR', errors => {
            toast.dismiss()
            toast.error('Cannot delete item: ' + errors.message + ", " + errors.errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
        })
    }

    render() {
        let { columns, items, links, currentPage } = this.state

        return <DataTable columns={columns} items={items} links={links} currentPage={currentPage} onPageClick={this.handePageClick}></DataTable>
    }
} export default Products
