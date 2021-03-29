import React from 'react'
import { Form } from 'react-bootstrap'
import { Editor } from '@tinymce/tinymce-react'

class ProductCharacteristicItem extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            item: {
                id: props.item.id,
                name: props.item.name,
                type: props.item.type,
                prepend: props.item.prepend,
                append: props.item.append,
                val_boolean: props.item.val_boolean ? 1 : 0,
                val_numeric: props.item.val_numeric ? props.item.val_numeric : '',
                val_short_text: props.item.val_short_text ? props.item.val_short_text : '',
                val_text: props.item.val_text ? props.item.val_text : '',
                suggested_values: props.item.suggested_values,
            },
        }

        this.handleChange = (e) => {
            let item = this.state.item

            if ('function' == typeof (this.props.onChange))
                this.props.onChange(e)

            switch (item.type) {
                case 'boolean':
                    item.val_boolean = e.target.checked ? 1 : 0
                    break;
                case 'numeric':
                    item.val_numeric = e.target.value
                    break;
                case 'short_text':
                    item.val_short_text = e.target.value
                    break;
            }
            this.setState({ item: item })
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
                                <Form.Check.Input name={`characteristic-${item.id}`} id={`characteristic-${item.id}`} value="1" onChange={this.handleChange} checked={item.val_boolean}></Form.Check.Input>
                                <Form.Check.Label htmlFor={`characteristic-${item.id}`}>{item.name}</Form.Check.Label>
                            </Form.Check>
                        </Form.Label>,
                        'numeric': <><Form.Control type="number" name={`characteristic-${item.id}`} value={item.val_numeric} onChange={this.handleChange} list={`list-characteristic-${item.id}`}></Form.Control><datalist id={`list-characteristic-${item.id}`}>{item.suggested_values.map(v => <option>{v.value}</option>)}</datalist></>,
                        'short_text': <><Form.Control type="text" name={`characteristic-${item.id}`} value={item.val_short_text} onChange={this.handleChange} value={item.val_short_text} list={`list-characteristic-${item.id}`}></Form.Control><datalist id={`list-characteristic-${item.id}`}>{item.suggested_values.map(v => <option>{v.value}</option>)}</datalist></>,
                        'text': <Editor
                            initialValue={item.val_text}
                            value={item.val_text}
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
