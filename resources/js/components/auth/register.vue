<template >
 <div class="container ">

  <h2 class="text-center" >Register</h2>
  <hr/>

  <div class="alert-danger" v-text="errors.firstname"></div>
  <div class="alert-danger" v-text="errors.username"></div>
  <div class="alert-danger" v-text="errors.email"></div>
  <form @submit.prevent="register">
   <label for="firstname">Firstname:</label>
   
   <input type="text" class="form-control" name="" v-model="form.firstname">
   
   <label for="lastname" class="mt-3">Lastname:</label>
   <input type="text" class="form-control" name="lastname" v-model="form.lastname">
   
   <label for="email" class="mt-3">Email:</label>
   <input type="email" class="form-control" name="email" v-model="form.email">
   
   <label for="username" class="mt-3">Username:</label>
   <input type="text" class="form-control" name="username" v-model="form.username">
   <label for="password" class="mt-3">Password:</label>
   <input type="password" class="form-control" name="password" v-model="form.password">
 <button type="submit" class="alert-info btn mt-3">Register</button>
  </form>
 </div>
</template>

<script>
import {mapMutations} from 'vuex';
import { mapActions } from 'vuex';

 export default{
  
  data(){
   return{
    errors:{},
    form:{
     firstname:"",
    }
   }
  },
  
  computed:{
    error(){
     return this.$store.state.errors;
    },
   success(){
     return this.$store.state.success;
    },
   ...mapMutations([
    'SET_ERROR','SET_LOADING','SET_SUCCESS','SET_AUTHENTICATED'
   ]),
   
  },
  
  created(){
   
  },
  methods:{

   register(){
    this.axios.post('/api/register',this.form).
          then(r=>{
           this.$swal.fire({
            title:"Registered Successfully!",
            icon:"success",
            toast:true,
            position:"top-end",
            showConfirmButton:false,
            timer:3000, });
            this.errors="";
            this.form={};
            this.$router.push('/login')
           
          })
              .catch(err=>{
               this.errors=err.response.data.errors;
              }); 
   }
  }
  
 }
 
</script>