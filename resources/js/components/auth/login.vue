<template >
<div class="text-white">
  
  <div v-text="success"></div>
  <h2 class="mt-7">Login</h2>
  <hr/>
 <div class="alert-danger" 
  v-text="errors.incorrect"></div>
  <form @submit.prevent="login">

   <label for="Email">Email:</label>
  <div class="alert-danger" 
  v-text="errors.email"></div>
   <input type="text" class="form-control" name="email" v-model="form.email">
   <label for="password" class="mt-2">Password:</label>
  <div class="alert-danger" 
  v-text="errors.password"></div>
   <input type="password" class="form-control" name="password" v-model="form.password">
   <button type="submit" class="btn-dark btn mt-3">Login <loader v-show="loading"></loader> </button>
  </form>
 </div>
</template>

<script>
import {mapMutations} from 'vuex';
import { mapActions } from 'vuex';
import config from '../config/config-header.js';
 export default{
  
  data(){
   return{
     loading:false,
     errors:{},
     form:{
      tokenName:"user-default"
     }
   }
  },
  
  computed:{
   
   success(){
     return this.$store.state.success;
   },
Eerrors(){
     
   },
   ...mapMutations([
    'SET_ERROR','SET_LOADING','SET_AUTHENTICATED'
   ]),
   
  },
  
  created(){
 
  },
  methods:{
   
    login(){
     this.loading=true;
     this.axios.post('/api/login',this.form).
          then((r)=>{
           this.$swal.fire({
            title:"Logged in Successfully!",
            icon:"success",
            toast:true,
            position:"top-end",
            showConfirmButton:false,
            timer:3000, });
            localStorage.setItem('token',r.data.token);
            let token=localStorage.getItem('token');
              const Config=new config(token);
              let header=Config.getT();
              this.axios.get('/api/user',header).
                then(r=>{
                 if(r.data.user.username=='admin'){
                  localStorage.setItem('admin',4);
                  }
                  localStorage.setItem('user',JSON.stringify(r.data.user));
                   this.$router.go('/user');
                   this.loading=false;
                }).
          catch((err)=>{
              this.errors=err.response.data.errors;
              this.loading=false;})
           }).
          catch((err)=>{
              this.errors=err.response.data.errors;
              this.loading=false;
          }); 

   
   }
  }
  
 }
 
</script>