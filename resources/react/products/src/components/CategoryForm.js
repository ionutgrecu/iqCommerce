import React from 'react'
import { withRouter } from 'react-router-dom'
import { Form } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'
import CategoriesStore from '../stores/CategoriesStore'
import SingleImageUpload from './SingleImageUpload'
import BtnSave from './BtnSave'
import { toast } from 'react-toastify'
import { urlAbsolute } from '../helpers'

toast.configure()
const data = {
    label: 'search me',
    value: 'searchme',
    children: [
        {
            label: 'search me too',
            value: 'searchmetoo',
            children: [
                {
                    label: 'No one can get me',
                    value: 'anonymous',
                },
            ],
        },
    ],
}

class CategoryForm extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.match.params.id ? this.props.match.params.id : 0,
            item: { name: '', description: '', image: '' },
            categories: [],
        }

        this.store = new CategoriesStore()

        if (this.props.match.params.id) {
            toast.info('Item is loading, wait...', { position: toast.POSITION.BOTTOM_RIGHT, autoClose: false })
            this.store.getItem(this.props.match.params.id)
        }

        this.handleChange = (e) => {
            let item = this.state.item

            if ('object' == typeof (e.target.files) && e.target.files && 'object' == typeof (e.target.files[0]))
                item[e.target.name] = e.target.files[0]
            else
                item[e.target.name] = e.target.value

            this.setState({ item: item })
        }

        this.handleEditorChange = (content, editor) => {
            let item = this.state.item
            item.description = content
            this.setState({ item: item })
        }

        this.save = () => {
            toast.info('Saving...', { position: toast.POSITION.BOTTOM_RIGHT })
            this.store.saveItem(this.state.item)
        }

        this.cancel = () => {
            location.href = "#/categories"
        }
    }

    componentDidMount() {
        this.store.emitter.addListener('SAVE_CATEGORY_ERROR', (message, errors) => {
            toast.dismiss()
            toast.error('Cannot save item: ' + message + ", " + errors.join(", "), { position: toast.POSITION.BOTTOM_RIGHT })
            console.log('Error on category save: ' + errors.join("\n"))
        })

        this.store.emitter.addListener('SAVE_CATEGORY_SUCCESS', () => {
            toast.dismiss()
            toast.success('Item saved', { position: toast.POSITION.BOTTOM_RIGHT, pauseOnFocusLoss: false })
            this.setState({ item: this.store.item })
        })

        this.store.emitter.addListener('GET_CATEGORY_SUCCESS', () => {
            toast.dismiss()

            let categories = []
            for (let i in this.store.categories)
                categories.push({ value: this.store.categories[i].id, label: this.store.categories[i].name })

            this.setState({ item: this.store.item, categories: categories })
            // this.forceUpdate()
        })

        this.store.emitter.addListener('GET_CATEGORY_ERROR', (errors) => {
            toast.dismiss()
            toast.error('Cannot load item: ' + errors.message + ', ' + errors.errors.join(', '), { position: toast.POSITION.BOTTOM_RIGHT })
        })
    }

    render() {
        let { id, item } = this.state

        return (<Form id={"cat-" + id}>
            <Form.Group>
                <Form.Label>Name</Form.Label>
                <Form.Control type="text" placeholder="Category Name" value={item.name} onChange={this.handleChange} name='name'></Form.Control>
            </Form.Group>
            <Form.Group>
                <Form.Label>Category</Form.Label>
                <DropdownTreeSelect data={data} />
            </Form.Group>
            <Form.Group>
                <SingleImageUpload name="image" file={item.image} onChange={this.handleChange}></SingleImageUpload>
            </Form.Group>
            <Form.Group>
                <Form.Label>Description</Form.Label>
            </Form.Group>
            <Form.Group>
                <Editor
                    value={item.description}
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
            <BtnSave onClick={this.save} onCancel={this.cancel}></BtnSave>
        </Form>)
    }
} export default withRouter(CategoryForm)
