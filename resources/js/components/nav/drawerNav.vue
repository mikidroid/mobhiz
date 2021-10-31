<template>
 <div>
 <!-- white app bar -->
 <!-- <v-app-bar
      color="#fff"
      fixed
      light
      height="70px"> -->
      
     <v-app-bar
      color="#7a4988"
      fixed
      dark
      elevation="0"
      height="70px">
      <v-toolbar-title><img class="mr-2" src="/storage/core/logo.png" height="45px"></v-toolbar-title>

      <v-spacer></v-spacer>
    <div v-show="screen != 'small'" >

    <v-btn icon to="/user" v-show="auth" class="mr-7 ml-5">
      <span>Dashboard</span>
    </v-btn>
    
    <v-btn icon to="/user/messages" v-show="auth" class="mr-5 ml-5">
      <span>Inbox <v-icon>mdi-email</v-icon> </span>
    </v-btn>

    <v-btn icon class="mr-5 ml-5">
      <span class="">Contact</span>
    </v-btn>
    
   <v-menu
      top
      right
      offset-y
:nudge-width="250"
   >
    <template v-slot:activator="{on,attr}">
  <v-btn
     icon
     class="ml-7 mr-7"
     v-on="on"
     v-bind="attr"  >    
     <span class="">Account  <v-icon>mdi-account</v-icon> </span>
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
  
</div>
      
<div class="mt-2" v-show="screen == 'small'">
<v-btn v-show="!auth" :to="'/login'" icon class="mr-2 ml-5">
      Login
      </v-btn>
<v-btn v-show="!auth" :to="'/register'" icon class="mr-2 ml-5">
      Register
      </v-btn>
</div>
    </v-app-bar>
<br/>
<br/>
<br/>
  </div>
</template>

<script>

 export default {
     data(){
      return{

         }
     } ,
    
     computed:{
      auth(){
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
           timer: 5000});})}, 
     },
     created(){

     },
     updated(){

           }
     }
     
</script>