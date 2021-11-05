import config from '../config/config-header.js';

export default {
  
  USERS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/users',CONFIG)},
    
  VIEW_USER:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/users/'+val,CONFIG)},
    
  SEARCH_USERS:function(data,val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get("/api/"+data+"/search/"+val,CONFIG)},
    
  ORDERS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/orders',CONFIG)},
    
  PROJECTS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/project-guest',CONFIG)},
    
  SEARCH_ORDERS:function(data,val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get("/api/"+data+"/search/"+val,CONFIG)},

  SEARCH_MESSAGES:function(data,val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get("/api/"+data+"/search/"+val,CONFIG)},
    
  MESSAGES:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/message',CONFIG)},

  MESSAGE_READ:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/message/'+val+'/edit',CONFIG)},
    
  REGISTERED_PRODUCTS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-product',CONFIG)},
    
  REGISTERED_TRADEMARKS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-product',CONFIG)},
    
  REGISTERED_BUSINESS:function(){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-business',CONFIG)},
    
 SEARCH_REGISTERED_PRODUCTS:function(data,val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/'+data+'/search/'+val,CONFIG)},
    
  VIEW_REGISTERED_BUSINESS:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-business/'+val,CONFIG)},
    
  VIEW_REGISTERED_PRODUCT:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-product/'+val,CONFIG)},
    
  VIEW_REGISTERED_TRADEMARK:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-trademark/'+val,CONFIG)},
    
  VIEW_REGISTERED_REPLACE_CERT:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/register-replace-cert/'+val,CONFIG)},
    
  VIEW_MESSAGE:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/message/'+val,CONFIG)},
    
  VIEW_PROJECT:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/project-guest/'+val,CONFIG)},

  REPLIES:function(val){
    let CONFIG=new config(localStorage.getItem('token')).getT()
    return this.axios.get('/api/reply/'+val,CONFIG)},
    
}