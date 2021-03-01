import React from 'react'
import { Fab, Action } from 'react-tiny-fab'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faSave, faCubes, faPlus, faSitemap, faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { bottom } from '@popperjs/core'

class BtnSave extends React.Component {
    constructor(props) {
        super(props)

        this.clickHandler = () => {
            if ('function' == typeof (this.props.onClick))
                this.props.onClick()
        }
    }

    render() {
        return <Fab
            mainButtonStyles={{ backgroundColor: 'green' }}
            icon={<FontAwesomeIcon icon={faSave} />}
            alwaysShowTitle={true}
            onClick={this.clickHandler}
        >
        </Fab>
    }
} export default BtnSave
