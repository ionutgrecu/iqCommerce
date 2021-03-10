import Axios from "axios"

class ProductsStore{
    async loadResources(){
        Axios.get(`${APIURL}/products`)
    }
}export default ProductsStore
