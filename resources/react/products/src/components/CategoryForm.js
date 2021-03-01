import React from 'react'
import { Form } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'
import SingleImageUpload from './SingleImageUpload';

class CategoryForm extends React.Component {
    constructor(props) {
        super(props)

    }

    handleEditorChange = (content, editor) => {
        console.log('Content was updated:', content);
    }

    render() {
        return <Form method="POST" encType="multipart/form-data">
            <Form.Group>
                <Form.Label>Name</Form.Label>
                <Form.Control type="text" placeholder="Category Name"></Form.Control>
            </Form.Group>
            <Form.Group>
                <SingleImageUpload name="image"></SingleImageUpload>
            </Form.Group>
            <Form.Group>
                <Form.Label>Description</Form.Label>
            </Form.Group>
            <Form.Group>
                <Editor
                    initialValue=""
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
        </Form >
    }
} export default CategoryForm
