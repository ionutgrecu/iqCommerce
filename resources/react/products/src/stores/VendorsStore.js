import Axios from "axios"
import { EventEmitter } from "fbemitter"
import { errorsRoll } from "../helpers"

class VendorsStore {
    constructor() {
        this.items = []
        this.item = {}
        this.emitter = new EventEmitter
    }

    async getItems() {
        Axios.get(`${APIURL}/vendors`, { withCredentials: true })
            .then((response) => {
                this.items = response.data.data
                this.emitter.emit('GET_VENDORS_SUCCESS')
            }, (error) => {
                this.emitter.emit('GET_VENDORS_ERROR', error)
            })
    }

    async getItem(id) {
        Axios.get(`${APIURL}/vendors/${id}`, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.emitter.emit('GET_VENDOR_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_VENDOR_ERROR', errors)
            })
    }

    async deleteItem(id) {
        Axios.delete(`${APIURL}/vendors/${id}`, { withCredentials: true })
            .then((response) => {
                this.emitter.emit('DELETE_VENDOR_SUCCESS', id)
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('DELETE_VENDOR_ERROR', errors.message, errors.errors)
            })
    }

    async saveItem(item) {
        const formData = new FormData()

        for (const key in item)
            if (Object.hasOwnProperty.call(item, key)) {
                let value = item[key];
                formData.append(key, value)
            }

        Axios.post(`${APIURL}/vendors`, formData, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.emitter.emit('SAVE_VENDOR_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('SAVE_VENDOR_ERROR', errors.message, errors.errors)
            })
    }
} export default VendorsStore
