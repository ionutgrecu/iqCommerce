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
            console.log(e.target.value)
            this.setState({ [e.target.name]: e.target.value })
        }

        this.save = () => {
            this.store.saveItem(this.state)
        }
    }

    handleEditorChange = (content, editor) => {
        // console.log('Content was updated:', content);
        this.setState({ description: content })
    }

    componentDidMount() {
        this.store.emitter.addListener('SAVE_CATEGORY_ERROR', (message) => {
            toast.error('Cannot save item: '+message, { position: toast.POSITION.BOTTOM_RIGHT })
            console.log('Error on category save: '+message)
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
