import Axios from "axios"
import { EventEmitter } from "fbemitter"
import { errorsRoll } from "../helpers"

class ProductsStore {
    constructor() {
        this.items = []
        this.links = []
        this.currentPage=1
        this.item = {}
        this.resources = {}
        this.characteristics = {}
        this.emitter = new EventEmitter
    }

    async getItems(pageNo=1) {
        Axios.get(`${APIURL}/products?page=${pageNo}`, { withCredentials: true })
            .then((response) => {
                this.items = response.data.data
                this.links = response.data.links
                this.currentPage=response.data.current_page
                this.emitter.emit('GET_PRODUCTS_SUCCESS')
            }), (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_PRODUCTS_ERROR', errors)
            }
    }

    async deleteItem(id) {
        Axios.delete(`${APIURL}/products/${id}`, { withCredentials: true })
            .then((response) => {
                this.emitter.emit('DELETE_PRODUCT_SUCCESS', response.data.id)
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('DELETE_PRODUCT_ERROR', errors)
            })
    }

    async loadResources() {
        Axios.get(`${APIURL}/resources?object[]=categories-tree&object[]=vendors`, { withCredentials: true })
            .then((response) => {
                this.resources = response.data.data
                this.emitter.emit('GET_PRODUCT_RESOURCES_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_PRODUCT_RESOURCES_ERROR', errors)
            })
    }

    async loadCharacteristics(categoryId, productId) {
        if (!categoryId) return

        Axios.get(`${APIURL}/resources?object=characteristics-tree&category-id=${categoryId}&product-id=${productId}`, { withCredentials: true })
            .then((response) => {
                this.characteristics = response.data.data['characteristics-tree']
                this.emitter.emit('GET_PRODUCT_CHARACTERISTICS_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_PRODUCT_CHARACTERISTICS_ERROR', errors)
            })
    }

    async saveItem(item, characteristics, files) {
        const formData = new FormData()
        console.log(files)

        for (const key in item)
            if (Object.hasOwnProperty.call(item, key)) {
                let value = item[key];
                formData.append(key, value)
            }

        for (let keyGroup in characteristics)
            for (let ch of characteristics[keyGroup])
                formData.append(`characteristics[${ch.id}]`, JSON.stringify({ val_boolean: ch.val_boolean, val_numeric: ch.val_numeric, val_short_text: ch.val_short_text, val_text: ch.val_text }))

        for (let i in files)
            formData.append(`image[${i}]`, files[i])

        Axios.post(`${APIURL}/products`, formData, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.emitter.emit('SAVE_PRODUCT_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('SAVE_PRODUCT_ERROR', errors)
            })
    }

    async deleteImage(id) {
        Axios.delete(`${APIURL}/products/image/${id}`, { withCredentials: true })
            .then((response) => {
                this.emitter.emit('DELETE_PRODUCT_IMAGE_SUCCESS', id)
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('DELETE_PRODUCT_IMAGE_ERROR', errors)
            })
    }
} export default ProductsStore
