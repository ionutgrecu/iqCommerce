import { EventEmitter } from 'fbemitter'
import axios from 'axios'

class CategoriesStore {
    constructor() {
        this.items = []
        this.emitter = new EventEmitter
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
                console.log(response)
            }, (error) => {
                console.log(error.response.data)
                this.emitter.emit('SAVE_CATEGORY_ERROR', error.response.data)
            })
    }
} export default CategoriesStore
