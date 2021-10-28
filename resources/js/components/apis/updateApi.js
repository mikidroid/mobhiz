import config from '../config/config-header.js';

export default {
   UPDATE_REGISTERED_PRODUCT:function(val,doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-product/'+val,doc,CONFIG)},
 
   UPDATE_ORDER:function(val,doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/orders/'+val,doc,CONFIG)},
    
   UPDATE_REGISTERED_BUSINESS:function(val,doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-business/'+val,doc,CONFIG)},
    
   UPDATE_REGISTERED_TRADEMARK:function(val,doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-trademark/'+val,doc,CONFIG)},
}