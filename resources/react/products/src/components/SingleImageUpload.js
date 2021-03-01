import './SingleImageUpload.scss'
import React from 'react'
import { v4 as uuidv4 } from 'uuid';
import { inArray } from '../helpers'
import { ToastContainer } from "react-toastr"

class SingleImageUpload extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            name: this.props.name,
            file: null,
            id: this.props.id ? this.props.id : uuidv4(),
        }
        this.uploadSingleFile = this.uploadSingleFile.bind(this)
    }

    uploadSingleFile(e) {
        if (!inArray(e.target.files[0].type, ['image/jpeg', 'image/png'])) {
            ToastMessage.message(
                <strong>I am a strong title</strong>,
                <em>I am an emphasized message</em>
              });
            return false
        }

        this.setState({
            file: URL.createObjectURL(e.target.files[0])
        })
    }

    render() {
        let imgPreview;
        if (this.state.file) {
            imgPreview = <img src={this.state.file} class="rounded" />;
        }
        return <div id={this.state.id}>
            <div className="preview">
                {imgPreview}
            </div>

            <div>
                <input type="file" className="form-control" name={this.state.name} onChange={this.uploadSingleFile} />
            </div>
        </div>
    }
} export default SingleImageUpload
