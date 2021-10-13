export default {
     csrf(){
        return this.axios.get('/sanctum/csrf-cookie');}
}