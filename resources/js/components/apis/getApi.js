import config from '../config/config-header.js';

export default {
  PRODUCT_ORDER:function(ref_id,form){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/product-order/'+ref_id,form,CONFIG)},
    
  BUSINESS_ORDER:function(ref_id,form){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/business-order/'+ref_id,form,CONFIG)},
    
  TRADEMARK_ORDER:function(ref_id,form){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/trademark-order/'+ref_id,form,CONFIG)},
    
  ORDERS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/orders',CONFIG)},
    
  SEARCH_ORDERS:function(data,val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get("/api/"+data+"/search/"+val,CONFIG)},
    
  MESSAGES:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/message',CONFIG)},
    
  REGISTERED_PRODUCTS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-product',CONFIG)},
    
 SEARCH_REGISTERED_PRODUCTS:function(data,val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/'+data+'/search/'+val,CONFIG)},
    
  VIEW_REGISTERED_BUSINESS:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-business'+val,CONFIG)},
    
  REGISTERED_TRADEMARKS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-product',CONFIG)},
    
  VIEW_REGISTERED_PRODUCT:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-product/'+val,CONFIG)},
    
  VIEW_REGISTERED_TRADEMARK:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-trademark'+val,CONFIG)},
    
  VIEW_MESSAGE:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/message'+val,CONFIG)},
    
}