<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>Client</h2></div>
 
 </div>
  <hr/>
<table class="table">
  <tbody>
    <tr>
      <td>Firstname</td>
      <td>{{client.firstname}}</td>
    </tr>
    <tr>
      <td>Lastname</td>
      <td>{{client.lastname}}</td>
    </tr>
    <tr>
      <td>Username</td>
      <td>{{client.username}}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{client.email}}</td>
    </tr>
  <tr>
      <td>Phone</td>
      <td>{{client.phone}}</td>
    </tr>
  <tr>
      <td>Country</td>
      <td>{{client.country}}</td>
    </tr>
  <tr>
      <td>City</td>
      <td>{{client.city}}</td>
    </tr>
  </tbody>
</table>
 <v-btn
 color="error"
 tile
 outlined
 background="text-danger"
 @click="$router.go(-1)"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
  Go back</v-btn>
 </div>
</template>

<script>
import Vue from 'vue';
import getApi from '../apis/getApi.js';

 export default {
     data(){
      return{
          client:"",
          VIEW_USER:getApi.VIEW_USER,
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
       this.VIEW_USER(this.$route.params.id)
       .then(r=>{
         this.client=r.data;
       })
     },
     updated(){

           }
     }
     
</script>