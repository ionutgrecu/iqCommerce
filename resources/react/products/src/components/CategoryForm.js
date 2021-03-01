import React from 'react'
import { Form } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'
import SingleImageUpload from './SingleImageUpload';

class CategoryForm extends React.Component {
    handleEditorChange = (content, editor) => {
        console.log('Content was updated:', content);
    }

    render() {
        return <Form>
            <Form.Group>
                <Form.Label>Name</Form.Label>
                <Form.Control type="text" placeholder="Category Name"></Form.Control>
                <Form.Label>Image</Form.Label>
                <SingleImageUpload></SingleImageUpload>
                <Form.Label>Description</Form.Label>
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
        </Form>
    }
} export default CategoryForm
