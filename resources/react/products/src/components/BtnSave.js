import React from 'react'
import { Fab, Action } from 'react-tiny-fab'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faSave, faMinus } from '@fortawesome/free-solid-svg-icons'
import { bottom } from '@popperjs/core'

class BtnSave extends React.Component {
    constructor(props) {
        super(props)

        this.clickHandler = () => {
            if ('function' == typeof (this.props.onClick))
                this.props.onClick()
        }

        this.cancel = () => {
            if ('function' == typeof (this.props.onCancel))
                this.props.onCancel()
        }
    }

    render() {
        return <Fab
            mainButtonStyles={{ backgroundColor: 'green' }}
            icon={<FontAwesomeIcon icon={faSave} />}
            alwaysShowTitle={true}
            onClick={this.clickHandler}
        >
            <Action text="Cancel" onClick={this.cancel}><FontAwesomeIcon icon={faMinus}></FontAwesomeIcon></Action>
        </Fab>
    }
} export default BtnSave
