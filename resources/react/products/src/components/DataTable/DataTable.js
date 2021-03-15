import React, { useMemo } from "react"
import { Button, Image, Table } from "react-bootstrap"

class DataTable extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            columns: props.columns,
            items: props.items
        }
    }

    shouldComponentUpdate(props) {
        let { items } = this.state

        if (JSON.stringify(items) === JSON.stringify(props.items)) return false;

        this.setState({ items: props.items })
        return true
    }

    render() {
        let { columns, items } = this.state

        return <Table className="table table-responsive-sm table-striped">
            <thead>
                <tr>
                    {columns.map(col => <th key={`datatable-th-${col.name}`}>{col.name}</th>)}
                </tr>
            </thead>
            <tbody>
                {items.map(row => <tr key={`datatable-tr-${row.id}`}>
                    {columns.map(col => <td key={`datatable-td-${row.id}-${col.name}`}>{row[col.selector]}</td>)}
                </tr>)}
            </tbody>
        </Table>
    }
} export default DataTable
