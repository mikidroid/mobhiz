import config from '../config/config-header.js';

export default {
  REGISTER_PRODUCT:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-product',doc,CONFIG)},
    
  ADD_PROJECT:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/project',doc,CONFIG)},
 
REGISTER_TRADEMARK:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-trademark',doc,CONFIG)},
    
  REGISTER_BUSINESS:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-business',doc,CONFIG)},
    
REGISTER_REPLACE_CERT:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-replace-cert',doc,CONFIG)},
 
  PRODUCT_ORDER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/product-order',val,CONFIG)},
 
  SEND_MESSAGE:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/message',doc,CONFIG)},
    
  SEND_REPLY:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/reply',doc,CONFIG)},
    
  BUSINESS_ORDER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/business-order',val,CONFIG)},
    
  TRADEMARK_ORDER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/trademark-order',val,CONFIG)},
    
  REPLACE_CERT_ORDER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/replace-cert-order',val,CONFIG)},
 
}