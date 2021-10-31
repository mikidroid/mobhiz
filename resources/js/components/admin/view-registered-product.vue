<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>Profile</h2></div>
 <div class="col-4 d-flex flex-row-reverse">
 <v-btn
 color="indigo"
 outlined
 ><v-icon class="mr-1">mdi-pencil</v-icon>Edit</v-btn></div>
 </div>
  <hr/>
<table class="table">
  <tbody>
    <tr>
      <td>Firstname</td>
      <td>{{user.firstname}}</td>
    </tr>
    <tr>
      <td>Lastname</td>
      <td>{{user.lastname}}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{user.email}}</td>
    </tr>
  <tr>
      <td>Phone</td>
      <td>{{user.phone}}</td>
    </tr>
  <tr>
      <td>Country</td>
      <td>{{user.country}}</td>
    </tr>
  <tr>
      <td>City</td>
      <td>{{user.city}}</td>
    </tr>
  </tbody>
</table>
 <v-btn
 color="error"
 tile
 outlined
 background="text-danger"
 ><v-icon class="mr-1" @click="$router.push('/user')">mdi-arrow-left</v-icon>
  Go back</v-btn>
 </div>
</template>

<script>
import Vue from 'vue';
import config from '../config/config-header.js';
import deleteApi from '../apis/deleteApi.js';
import getApi from '../apis/getApi.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import cons from '../config/const.js';
import sendE from '../config/send-email.js';

 export default {
     data(){
      return{
         VIEW_REGISTERED_PRODUCT:getApi.VIEW_REGISTERED_PRODUCT,
         data:""
         }
     } ,
    
     computed:{
      user(){
       return JSON.parse(localStorage.getItem('user'))
      }
     },
     
     watch: {
      
    },
     methods:{
        
     },
     created(){
      // this.VIEW_REGISTERED_PRODUCT(this.$route.params.id).
     },
     updated(){

           }
     }
     
</script>