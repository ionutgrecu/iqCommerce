import Axios from "axios"
import { EventEmitter } from "fbemitter"
import { errorsRoll } from "../helpers"

class ProductsStore {
    constructor() {
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
                this.emitter.emit('GET_PRODUCT_RESOURcES_ERROR', errors)
            })
    }

    async loadCharacteristics(categoryId) {
        if (!categoryId) return

        Axios.get(`${APIURL}/resources?object=characteristics-tree&category-id=${categoryId}`, { withCredentials: true })
            .then((response) => {
                this.characteristics = response.data.data['characteristics-tree']
                this.emitter.emit('GET_PRODUCT_CHARACTERISTICS_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_PRODUCT_CHARACTERISTICS_ERROR', errors)
            })
    }
} export default ProductsStore
