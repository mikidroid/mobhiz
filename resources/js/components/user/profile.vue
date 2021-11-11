<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>Profile</h2></div>
 <div class="col-4 d-flex flex-row-reverse">
 <v-btn
 color="indigo"
to="/user/edit-profile"
 outlined
 ><v-icon class="mr-1">mdi-pencil</v-icon>Edit</v-btn></div>
 </div>
  <hr/>
    <v-avatar
      color="brown"
      size="78" 
      v-show="!user.profile_pic"
      class="mt-2 ml-2 mb-3"
      >
    <span class="white--text text-h5">{{textAvatar(user.username)}}</span>
    </v-avatar>
   <img v-show="user.profile_pic" style="border-radius:50%;width:150px;height:150px;object-fit:cover" :src="'/storage/profile-pics/'+user.profile_pic">
   
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
      <td>Username</td>
      <td>{{user.username=='null'?'':user.username}}</td>
    </tr>
    <tr>
      <td>Gender</td>
      <td>{{user.gender=='null'?'':user.gender}}</td>
    </tr>
  <tr>
      <td>Phone</td>
      <td>{{user.phone=='null'?'':user.phone}}</td>
    </tr>
  <tr>
      <td>Country</td>
      <td>{{user.country=='null'?'':user.country}}</td>
    </tr>
  <tr>
      <td>City</td>
      <td>{{user.city=='null'?'':user.city}}</td>
    </tr>
  </tbody>
</table>
 <v-btn
 color="error"
 tile
 @click="$router.push('/user')"
 outlined
 background="text-danger"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
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
      textAvatar(text){
         return text.slice(0,2)
       },
     },
     created(){

     },
     updated(){

           }
     }
     
</script>