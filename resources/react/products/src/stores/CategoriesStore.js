import {EventEmitter} from 'fbemitter'
import axios from 'axios'

class CategoriesStore{
    constructor(){
        this.items=[]
        this.emitter=new EventEmitter
    }

    async getItems(){
        try{
            const response=await axios.get(`${APIURL}/categories`,{withCredentials: true})
            this.items=response.data
            this.emitter.emit('GET_CATEGORIES_SUCCESS')
        }catch(err){
            this.emitter.emit('GET_CATEGORIES_ERROR')
        }
    }
} export default CategoriesStore
