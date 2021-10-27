import config from '../config/config-header.js';

export default {
  DELETE_ORDER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.delete("/api/orders/"+val,CONFIG)},
    
DELETE_USER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.delete("/api/users/"+val,CONFIG)},
    
  DELETE_REGISTERED_PRODUCT:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.delete("/api/register-product/"+val,CONFIG)},
 
}