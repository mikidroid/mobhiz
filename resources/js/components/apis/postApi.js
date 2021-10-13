import config from '../config/config-header.js';

export default {
  REGISTER_PRODUCT:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-product',doc,CONFIG)},
 
  SEND_MESSAGE:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/message',doc,CONFIG)},
    
  REPLY_MESSAGE:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/reply',doc,CONFIG)},
    
  REGISTER_TRADEMARK:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-trademark',doc,CONFIG)},
    
  REGISTER_BUSINESS:function(doc){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.post('/api/register-business',doc,CONFIG)},
}