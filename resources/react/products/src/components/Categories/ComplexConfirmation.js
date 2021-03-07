import React from "react";
import PropTypes from "prop-types";
import { Modal, Button, FormControl } from "react-bootstrap";
import { confirmable, createConfirmation } from "react-confirm";
import { v4 as uuidv4 } from 'uuid';

class ComplexConfirmation extends React.Component {
    refCallback(ref) {
        this.inputRef = ref;
    }

    handleOnClick(index) {
        const { proceed } = this.props;
        return () => {
            proceed({
                button: index,
            });
        };
    }

    render() {
        const { show, proceed, dismiss, cancel, title, message, buttons } = this.props;

        return (
            <div className="static-modal">
                <Modal show={show} onHide={dismiss}>
                    <Modal.Header>
                        <Modal.Title>{title}</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>{message}</Modal.Body>
                    <Modal.Footer>
                        {buttons.map((e) => <Button key={uuidv4()} className="button-l" variant="primary" onClick={this.handleOnClick(e.value)}>{e.text}</Button>)}

                        <Button onClick={cancel} variant="danger">Cancel</Button>
                    </Modal.Footer>
                </Modal>
            </div>
        );
    }
}

export const confirmComplex = createConfirmation(confirmable(ComplexConfirmation));
