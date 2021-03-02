import React from 'react'
import { Form } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'
import CategoriesStore from '../stores/CategoriesStore'
import SingleImageUpload from './SingleImageUpload'
import BtnSave from './BtnSave'
import { toast } from 'react-toastify'

toast.configure()

class CategoryForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            name: '',
            image: null,
            description: ''
        }

        this.store = new CategoriesStore()

        this.handleChange = (e) => {
            if ('object' == typeof (e.target.files) && e.target.files && 'object' == typeof (e.target.files[0]))
                this.setState({ [e.target.name]: e.target.files[0] })
            else
                this.setState({ [e.target.name]: e.target.value })
        }

        this.handleEditorChange = (content, editor) => {
            // console.log('Content was updated:', content);
            this.setState({ description: content })
        }

        this.save = () => {
            this.store.saveItem(this.state)
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('SAVE_CATEGORY_ERROR', (message, errors) => {
            toast.error('Cannot save item: ' + message + ", " + errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
            console.log('Error on category save: ' + errors.join("\n"))
        })
    }

    render() {
        return <Form>
            <Form.Group>
                <Form.Label>Name</Form.Label>
                <Form.Control type="text" placeholder="Category Name" value={this.state.name} onChange={this.handleChange} name='name'></Form.Control>
            </Form.Group>
            <Form.Group>
                <SingleImageUpload name="image" file={this.state.image} onChange={this.handleChange}></SingleImageUpload>
            </Form.Group>
            <Form.Group>
                <Form.Label>Description</Form.Label>
            </Form.Group>
            <Form.Group>
                <Editor
                    initialValue={this.state.description}
                    init={{
                        height: 500,
                        menubar: false,
                        plugins: [
                            'advlist autolink lists link image charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount'
                        ],
                        toolbar:
                            'undo redo | formatselect | bold italic backcolor | \
             alignleft aligncenter alignright alignjustify | \
             bullist numlist outdent indent | removeformat | help'
                    }}
                    onEditorChange={this.handleEditorChange}
                />
            </Form.Group>
            <BtnSave onClick={this.save}></BtnSave>
        </Form >
    }
} export default CategoryForm
