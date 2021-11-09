<template >
  <v-bottom-navigation
    v-model="value"
    v-show="screen == 'small'"
    :background-color="color"
    class="gradient-custom4 text-danger"
    fixed
    grow >
    <v-btn to="/" >
      <span>Home</span>
      <v-icon>mdi-home</v-icon>
    </v-btn>
    <v-btn to="/user" v-show="auth">
      <span>Dashboard</span>
      <v-icon>mdi-post</v-icon>
    </v-btn>
    

    <v-btn to="/user/messages" v-show="auth">

      <span>Inbox({{messageCount}})</span>
     <v-badge
          color="pink"
          dot
          
        >
      <v-icon>mdi-email</v-icon>
    </v-badge>
    </v-btn>

    
    <v-btn to="/contact">
      <span>Contact</span>
      <v-icon>mdi-phone</v-icon>
    </v-btn>
    
   <v-menu
      top
      right
      offset-y
      :nudge-width="200">
    <template v-slot:activator="{on,attr}">
   <v-btn
     v-on="on"
     v-bind="attr"  >    
     <span>Account</span>
      <v-icon>mdi-account</v-icon>
    </v-btn>
    </template>
   <v-card>
    <v-list>
     <v-list-item v-show="!auth" to="/login">
      <v-list-item-title>
       Login
      </v-list-item-title>
     </v-list-item>
 <v-list-item v-show="!auth" to="/register">
      <v-list-item-title>
       Register
      </v-list-item-title>
     </v-list-item>
 <v-list-item v-show="auth" to="/user/profile" >
      <v-list-item-avatar>
   <v-icon>mdi-account</v-icon>
      </v-list-item-avatar>
      <v-list-item-title>
       Profile
      </v-list-item-title>
     </v-list-item>
 <v-list-item v-show="auth" @click="logout">
  <v-list-item-avatar>
   <v-icon>mdi-logout</v-icon>
  </v-list-item-avatar>
   
      <v-list-item-title>
       Logout
      </v-list-item-title>
     </v-list-item>
    </v-list>
   </v-card>
    </v-menu>
    
  </v-bottom-navigation>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';

 export default {
  
     data(){
      return{
      drawer: false,
      group: null,
      g:5,
      messageCount:"",
      COUNT_INBOX:getApi.COUNT_INBOX,
         }
     } ,
    
     computed:{
      auth(){
       return localStorage.getItem('token')
      },
      msgCount(){
         
      },
      token(){
       return localStorage.getItem('token')
      },
      screen(){ 
        switch(true){
        case window.innerWidth < 550: 
         return 'small';
        break;
        case window.innerWidth > 549 && window.innerWidth < 1200: 
         return 'medium';
        break;
        case window.innerWidth > 1199:
         return 'large';
        break;}} 
     },
     
   watch: {
      group () {
        this.drawer = false
      },
    },
   methods:{
      logout(){
        const Config=new config(this.token).getT();
        this.axios.get('/api/logout',Config).then(r=>{
        let data=['token','adminNav','admin','user'];
        for (let single in data){
         localStorage.removeItem(data[single]);
         }
         this.$swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'You have been logged out!',
           showConfirmButton: false,
           timer: 5000
         });
          this.$router.go('/');})
          .catch(e=>{
           this.$swal.fire({
           position: 'top-end',
           icon: 'error',
           title: 'Unable to logout!'+''+e.response.data.message,
           showConfirmButton: false,
           timer: 5000});}) },
     },
     created(){
          this.COUNT_INBOX().then(r=>{
            this.messageCount=r.data;
          })
     },
     updated(){

           }
     }
     
</script>