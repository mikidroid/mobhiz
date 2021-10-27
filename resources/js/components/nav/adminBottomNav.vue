<template>
  <v-bottom-navigation
    v-model="value"
    :background-color="color"
    class="gradient-custom4 text-danger"
    fixed
    grow
    v-show="screen == 'small'"
  >
    <v-btn to="/" >
      <span>Home</span>

      <v-icon>mdi-home</v-icon>
    </v-btn>

    <v-btn to="/admin" v-show="auth">
      <span>Dashboard</span>

      <v-icon>mdi-post</v-icon>
    </v-btn>
    

    <v-btn to="/admin/messages" v-show="auth">
      <span>Inbox</span>

      <v-icon>mdi-email</v-icon>
    </v-btn>

    <v-btn>
      <span>Contact</span>

      <v-icon>mdi-phone</v-icon>
    </v-btn>
    
   <v-menu
      top
      right
      offset-y
:nudge-width="200"
   >
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
 <v-list-item v-show="auth">
      <v-list-item-avatar>
       <img src="/storage/core/logo.png" >
      </v-list-item-avatar>
      <v-list-item-title>
       Profile
      </v-list-item-title>
     </v-list-item>
 <v-list-item v-show="auth" @click="logout">
  <v-list-item-action>
   <v-icon>mdi-logout</v-icon>
  </v-list-item-action>
   
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
import config from '../config/config-header.js';
 export default {
    data(){
      return{
        drawer: false,
        group: null,}},
    
    computed:{
      auth(){
       return localStorage.getItem('token')},
      token(){
       return localStorage.getItem('token')},
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
        break;}}  },
     
    watch: {
      group(){
        this.drawer = false},  },
        
    methods:{
      logout(){
         const Config=new config(this.token)
         .getT();
         this.axios.get('/api/logout',Config)
         .then(r=>{
         let data=['token','adminNav','admin','user'];
         for (let single in data){
         localStorage.removeItem(data[single]);}
         this.$swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'You have been logged out!',
           showConfirmButton: false,
           timer: 5000});
          this.$router.go('/');})
          .catch(e=>{
            this.$swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Unable to logout!'+''+e.response.data.message,
           showConfirmButton: false,
           timer: 5000});})},  },
           
     created(){

     },
     updated(){

           }
     }
</script>