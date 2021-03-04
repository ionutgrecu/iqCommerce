import { EventEmitter } from 'fbemitter'
import axios from 'axios'
import { errorsRoll } from '../helpers'

class CategoriesStore {
    constructor() {
        this.items = []
        this.item = {}
        this.categories=[]
        this.emitter = new EventEmitter
    }

    async getItem(id) {
        axios.get(`${APIURL}/categories/${id}`, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.categories=response.data.categories
                this.emitter.emit('GET_CATEGORY_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_CATEGORY_ERROR', errors)
            })
    }

    async getItems() {
        try {
            const response = await axios.get(`${APIURL}/categories`, { withCredentials: true })
            this.items = response.data.data
            this.emitter.emit('GET_CATEGORIES_SUCCESS')
        } catch (err) {
            this.emitter.emit('GET_CATEGORIES_ERROR', err)
        }
    }

    async deleteItem(id) {
        axios.delete(`${APIURL}/categories/${id}`, { withCredentials: true })
            .then((response) => {
                // console.log(response)
                this.emitter.emit('DELETE_CATEGORY_SUCCESS', id)
            }, (error) => {
                let errors = []

                if ('object' == typeof (error.response) && error.response && 'object' == typeof (error.response.data)) {
                    if ('object' == typeof (error.response.data.errors) && error.response.data.errors)
                        for (let i in error.response.data.errors)
                            if (error.response.data.errors.hasOwnProperty(i))
                                errors.push(error.response.data.errors[i])

                    this.emitter.emit('DELETE_CATEGORY_ERROR', error.response.data.message, errors)
                } else this.emitter.emit('DELETE_CATEGORY_ERROR', error, errors)
            })
    }

    async saveItem(item) {
        const formData = new FormData()

        for (const key in item) {
            if (Object.hasOwnProperty.call(item, key)) {
                let value = item[key];
                formData.append(key, value)
            }
        }

        axios.post(`${APIURL}/categories`, formData, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.emitter.emit('SAVE_CATEGORY_SUCCESS')
            }, (error) => {
                let errors = []

                if ('object' == typeof (error.response) && error.response && 'object' == typeof (error.response.data)) {
                    if ('object' == typeof (error.response.data.errors) && error.response.data.errors)
                        for (let i in error.response.data.errors)
                            if (error.response.data.errors.hasOwnProperty(i))
                                errors.push(error.response.data.errors[i])

                    this.emitter.emit('SAVE_CATEGORY_ERROR', error.response.data.message, errors)
                } else this.emitter.emit('SAVE_CATEGORY_ERROR', error, errors)
            })
    }
} export default CategoriesStore
