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
import Vue from 'vue'

 export default {
     data(){
      return{

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

     },
     updated(){

           }
     }
     
</script>