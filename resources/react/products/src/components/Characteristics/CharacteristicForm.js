import React from "react"
import { withRouter } from 'react-router-dom'
import { toast } from "react-toastify"
import CharacteristicsStore from "../../stores/CharacteristicsStore"

class CharacteristicForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.match.params.id ? this.props.match.params.id : 0,
            item: {}
        }

        this.store = new CharacteristicsStore()

        if (this.props.match.params.id) {
            toast.info('Item is loading, wait...', { position: toast.POSITION.BOTTOM_RIGHT, autoClose: false })

            this.store.getItem(this.props.match.params.id)
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('GET_CHARACTERISTIC_SUCCESS', () => {
            this.setState({ item: this.store.item })

            toast.dismiss()
        })

        this.store.emitter.addListener('GET_CHARACTERISTIC_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot load item: ' + errors.message + ' ' + errors.errors.join(', '), { position: toast.POSITION.BOTTOM_RIGHT })
        })
    }

    render() {
        const {item}=this.state
        return <>{item.name}</>
    }
} export default withRouter(CharacteristicForm)
