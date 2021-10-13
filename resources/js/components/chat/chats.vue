<template>
 <div class="container text-center">
  <h2>Chats</h2>
  <hr/>
<div v-if="adminNav=='false'"> No Nav</div>
<div v-show="adminNav" v-text="adminNav"> </div>
  <div>
   <p>Singles Chat</p>
  <p v-text="n"></p>
   <p>Married peoples Chat </p>
<p>{{error}} </p>

<p>Welcome <span v-if="user">{{user.firstname}} </span> <span v-else >Ok oh</span></p>

  
   <button class="alert-info" @click="logout"> click now</button>
  </div>
 </div>
</template>

<script>
import {mapActions} from 'vuex';
import config from '../config/config-header.js';
 export default{
  data(){
   return{
   
    user:"",
    n:""
   }
   
  },
  methods:{
   logout(){
   const Config=new config(this.token).getT();
      this.axios.get('/api/logout',Config).then(r=>{
         localStorage.removeItem('token');
         localStorage.removeItem('adminNav');
         this.user="";
         this.$swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'You have been logged out!',
           showConfirmButton: false,
           timer: 5000
         });
          this.$router.go('/');
      }).catch(e=>{
this.$swal.fire({
           position: 'top-end',
           icon: 'error',
           title: 'Unable to logout!'+''+e.response.data.message,
           showConfirmButton: false,
           timer: 5000
         });
      })
   },
  
  },
computed:{
   auth(){
    return this.$store.state.authenticated;
   },
token(){
    return localStorage.getItem('token');
   },
error(){
    return this.$store.state.error;
   },
adminNav(){
      return localStorage.getItem('adminNav');
     }
},
  
  
 created(){
     
     const Config=new config(this.token).getT();
     this.axios.get('/api/user',Config).
     then(r=>{
         this.user=r.data.user;
     }).
     catch(e=>{
         this.error=e.response.data.errors;
     })
    
    },
beforeRouteEnter(to,from,next){
        
        localStorage.getItem('token')?localStorage.setItem('adminNav',true):localStorage.setItem('adminNav',false);
        next();
     },

    
     
   
  
 }
 
</script>