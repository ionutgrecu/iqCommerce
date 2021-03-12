import Axios from "axios"
import { EventEmitter } from "fbemitter"
import { errorsRoll } from "../helpers"

class ProductsStore {
    constructor() {
        this.item = {}
        this.resources = {}
        this.characteristics = {}
        this.emitter = new EventEmitter
    }

    async loadResources() {
        Axios.get(`${APIURL}/resources?object[]=categories-tree&object[]=vendors`, { withCredentials: true })
            .then((response) => {
                this.resources = response.data.data
                this.emitter.emit('GET_PRODUCT_RESOURcES_SUCCESS')
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
        console.log(characteristics)
        for (let keyGroup in characteristics) {
            for (let ch of characteristics[keyGroup]) {
                formData.append(`characteristic-${ch.id}`,ch)
            }
        }

        for (let key in files)
            formData.append(key, files[key])


        Axios.post(`${APIURL}/products`, formData, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.emitter.emit('SAVE_PRODUCT_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('SAVE_PRODUCT_ERROR', errors)
            })
    }
} export default ProductsStore
