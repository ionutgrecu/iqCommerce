import React, { useMemo } from "react"
import { Button, Image, Table } from "react-bootstrap"
import { objectRecursiveValue } from "../../helpers"
const _ = require('lodash')

class DataTable extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            columns: props.columns,
            items: props.items,
            links: props.links,
            currentPage: props.currentPage
        }

        this.handlePageClick = (e) => {
            if ('function' == typeof (this.props.onPageClick))
                this.props.onPageClick(e)
        }
    }

    shouldComponentUpdate(props) {
        let { items } = this.state

        // if (JSON.stringify(items) === JSON.stringify(props.items)) return false;
        if (_.isEqual(items, props.items)) return false;

        this.setState({ items: props.items, links: props.links, currentPage: props.currentPage })
        return true
    }

    render() {
        let { columns, items, links, currentPage } = this.state

        return <>
            <Table className="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        {columns.map(col => <th key={`datatable-th-${col.name}`}>{col.name}</th>)}
                    </tr>
                </thead>
                <tbody>
                    {items.map(row => <tr key={`datatable-tr-${row.id}`}>
                        {columns.map(col => <td key={`datatable-td-${row.id}-${col.name}`}>
                            {col.selector ? objectRecursiveValue(row, col.selector) : ''}
                            {col.cell ? col.cell(row) : ''}
                        </td>)}
                    </tr>)}
                </tbody>
            </Table>

            {links.length ? <ul className="pagination">
                {links.map(link => <li key={`link-${link.label}`} className={link.label == currentPage ? "page-item active" : "page-item"}><a className="page-link" onClick={this.handlePageClick} data-page={link.url} dangerouslySetInnerHTML={{ __html: link.label }}></a></li>)}
            </ul> : ''}

        </>
    }
} export default DataTable
