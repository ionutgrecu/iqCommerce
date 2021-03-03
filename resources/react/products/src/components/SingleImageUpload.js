import React from 'react'
import { v4 as uuidv4 } from 'uuid';
import { inArray, urlAbsolute } from '../helpers'
import { toast } from 'react-toastify'

toast.configure()

class SingleImageUpload extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            file: this.props.file ? this.props.file : null,
            id: this.props.id ? this.props.id : uuidv4(),
            name: this.props.name ? this.props.name : uuidv4(),
        }

        this.uploadSingleFile = (e) => {
            if (!e.target.files) return false

            if (!inArray(e.target.files[0].type, ['image/jpeg', 'image/png'])) {
                toast.error('Invalid image type', { position: toast.POSITION.BOTTOM_RIGHT })
                e.target.value = null
                return false
            }

            this.setState({
                file: URL.createObjectURL(e.target.files[0]),
            })

            if ('function' == typeof (this.props.onChange))
                this.props.onChange(e)
        }

        this.uploadSingleFile = this.uploadSingleFile.bind(this)
    }

    componentWillReceiveProps(props) {
        if ('string' == typeof (props.file))
            this.setState({ file: props.file })
    }

    render() {
        let imgPreview
        if (this.state.file) {
            imgPreview = <img src={this.state.file} className="rounded" />;
        }

        return (<div id={this.state.id}>
            <div className="preview">
                <img src={urlAbsolute(this.state.file)} className="rounded" />
            </div>

            <div>
                <input type="file" className="form-control" accept="image/*" onChange={this.uploadSingleFile} name={this.state.name} />
            </div>
        </div>)
    }
} export default SingleImageUpload
