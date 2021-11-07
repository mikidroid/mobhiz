<template >
 <div class="container text-white">

  <h2 class="" >Register</h2>
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
 <button type="submit" class="btn-dark btn mt-3">Register</button>
  </form>
 </div>
</template>

<script>
import {mapMutations} from 'vuex';
import { mapActions } from 'vuex';
import sendE from '../config/send-email.js';
import cons from '../config/const.js';

 export default{
  data(){
    return{
     SITE_NAME:cons.SITE_NAME,
     PERSONAL_EMAIL:cons.PERSONAL_EMAIL,
     errors:{},
     form:{firstname:"",}}},
  
  computed:{
    error(){
     return this.$store.state.errors;},
    success(){
     return this.$store.state.success;},
    emailSubject(){
     let subject=`Welcome to ${this.SITE_NAME}!`;
     return subject;},
    emailBody(){
     let body=`
      <div>
      <p>Welcome ${this.form.firstname}, we will strive to give you the best service possible as you are important to us.</p>
      <p>Feel free to contact us via your dashboard message or our direct email.</p>
      <p>Visit your dashboard frequently: <a href="${this.SITE_LINK}">${this.SITE_LINK}</a></p>
      <hr>
      <p><b>Cheers!</b></p>
      <p><b>Yours truely, ${this.SITE_NAME}</b></p>
      <div>`;
     return body;},},
  
  created(){},
  methods:{
   register(){
      this.axios.post('/api/register',this.form)
      .then(r=>{
          this.$swal.fire({
            title:"Registered Successfully!",
            icon:"success",
            toast:true,
            position:"top-end",
            showConfirmButton:false,
            timer:3000, });
          let send_email = new sendE(this.form.email,this.emailSubject,this.emailBody).sendEmail();
          if(send_email){
            let msg_admin=new sendE(this.PERSONAL_EMAIL,'New registration on '+this.SITE_NAME,'Congrats! you have a new client with username: <b>'+this.form.username+'</b> on '+this.SITE_NAME+'. Please check your dashboard to view client details.').sendEmail();
          }
          this.errors="";
          this.form={};
          this.$router.push('/login') })
      .catch(err=>{
          this.errors=err.response.data.errors;});}
           }
 }
 
</script>