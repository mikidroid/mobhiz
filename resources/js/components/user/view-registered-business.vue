<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>Details</h2></div>
 <div class="col-4 d-flex flex-row-reverse">
<v-btn
   small
   :to="'/user/edit-registered-business/'+data.id"
   color="blue"
   outlined>
   <v-icon class="mr-1">mdi-pencil</v-icon>
   Edit
   </v-btn>
 <v-btn
   small
   color="blue"
   :href="'/storage/register-business/'+data.documents"
    class="mr-3 text-white">
   <v-icon class="">mdi-download</v-icon>
   Download
   </v-btn>
 </div>
 </div>
  <hr/>
<table class="table">
  <tbody>
    <tr>
      <td class="font-weight-bold">Client</td>
      <td>{{data.fullname}}</td>
    </tr>
    <tr>
      <td class="font-weight-bold">Client email</td>
      <td>{{data.email}}</td>
    </tr>
    <tr>
      <td class="font-weight-bold">Company name</td>
      <td>{{data.company_name}}</td>
    </tr>
    <tr>
      <td class="font-weight-bold">Company address</td>
      <td>{{data.company_address}}</td>
    </tr>
  <tr>
      <td class="font-weight-bold">Phone</td>
      <td>
       <div>{{data.phone}}</div>
      </td>
    </tr>
  </tbody>
</table>
 <v-btn
 color="error"
 @click="$router.push('/user')"
 tile
 outlined
 background="text-danger"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
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
         VIEW_REGISTERED_BUSINESS:getApi.VIEW_REGISTERED_BUSINESS,
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
       this.VIEW_REGISTERED_BUSINESS(this.$route.params.id)
       .then(r=>{
         this.data=r.data;
       })
       .catch(e=>{
         alert(e.response.data.message);
       })
     },
     updated(){

           }
     }
     
</script>