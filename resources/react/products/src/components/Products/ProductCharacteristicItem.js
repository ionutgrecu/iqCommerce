import React from 'react'
import { Form } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'

class ProductCharacteristicItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: props.item
        }

        this.handleChange = (e) => {
            if ('function' == typeof (this.props.onChange))
                this.props.onChange(e)
        }
    }

    render() {
        const { item } = this.state

        return <Form.Group>
            {'boolean' != item.type ? <Form.Label>{item.name}</Form.Label> : ''}
            <div className="input-group">
                {item.prepend ? <div className="input-group-prepend"><span className="input-group-text">{item.prepend}</span></div> : ''}
                {
                    {
                        'boolean': <Form.Label>
                            <Form.Check>
                                <Form.Check.Input name={`characteristic-${item.id}`} id={`characteristic-${item.id}`} value="1" onChange={this.handleChange}></Form.Check.Input>
                                <Form.Check.Label htmlFor={`characteristic-${item.id}`}>{item.name}</Form.Check.Label>
                            </Form.Check>
                        </Form.Label>,
                        'numeric': <Form.Control type="number" name={`characteristic-${item.id}`} value={item.value} onChange={this.handleChange}></Form.Control>,
                        'short_text': <Form.Control type="text" name={`characteristic-${item.id}`} onChange={this.handleChange} value={item.value}></Form.Control>,
                        'text': <Editor
                            init={{
                                height: 300,
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
                        />,
                    }[item.type]
                }
                {item.append ? <div className="input-group-append"><span className="input-group-text">{item.append}</span></div> : ''}
            </div>
        </Form.Group>
    }
} export default ProductCharacteristicItem
