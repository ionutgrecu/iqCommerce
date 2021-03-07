import React from "react";
import PropTypes from "prop-types";
import { Modal, Button, FormControl } from "react-bootstrap";
import { confirmable, createConfirmation } from "react-confirm";

class ComplexConfirmation extends React.Component {
  refCallback(ref) {
    this.inputRef = ref;
  }

  handleOnClick(index) {
    const { proceed } = this.props;
    return () => {
      proceed({
        button: index,
        input: this.inputRef.value
      });
    };
  }

  render() {
    const { show, proceed, dismiss, cancel, message } = this.props;

    return (
      <div className="static-modal">
        <Modal show={show} onHide={dismiss}>
          <Modal.Header>
            <Modal.Title />
          </Modal.Header>
          <Modal.Body>{message}</Modal.Body>
          <Modal.Footer>
            <FormControl
              type="text"
              inputRef={this.refCallback.bind(this)}
              type="text"
            />
            <Button onClick={cancel}>Cancel</Button>
            <Button
              className="button-l"
              bsStyle="default"
              onClick={this.handleOnClick(1)}
            >
              1st
            </Button>
            <Button
              className="button-l"
              bsStyle="default"
              onClick={this.handleOnClick(2)}
            >
              2nd
            </Button>
            <Button
              className="button-l"
              bsStyle="default"
              onClick={this.handleOnClick(3)}
            >
              3rd
            </Button>
          </Modal.Footer>
        </Modal>
      </div>
    );
  }
}

export const confirm = createConfirmation(confirmable(ComplexConfirmation));
