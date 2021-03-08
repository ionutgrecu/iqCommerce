import Axios from "axios"
import { EventEmitter } from "fbemitter"
import { errorsRoll } from "../helpers"

class CharacteristicsStore {
    constructor() {
        this.items = []
        this.item = {}
        this.emitter = new EventEmitter
    }

    async getItems() {
        Axios.get(`${APIURL}/characteristics`, { withCredentials: true })
            .then((response) => {
                this.items = response.data.data
                this.emitter.emit('GET_CHARACTERISTICS_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_CHARACTERISTICS_ERROR', errors.message, errors.errors)
            })
    }

    async getItem(id) {
        Axios.get(`${APIURL}/characteristics/${id}`, { withCredentials: true })
            .then((response) => {
                this.item = response.data.data
                this.emitter.emit('GET_CHARACTERISTIC_SUCCESS')
            }, (error) => {
                let errors = errorsRoll(error)
                this.emitter.emit('GET_CHARACTERISTIC_ERROR', errors)
            })
    }
} export default CharacteristicsStore
