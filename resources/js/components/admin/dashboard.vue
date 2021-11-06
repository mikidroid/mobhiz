<template>
 <div class="container">
<h3>Admin Dashboard</h3>
<div class="my-3 text-caption">Welcome our lovely admin • <b>{{user.firstname}}</b></div>
   <!-- Row1 -->
   <div class="row">
     <div class="mt-2 col-md-6 col-sm-10"> 
      <v-row class="mb-5">
        <v-col 
          style="height:100px" class="">
          <div class="boxes1">
            <v-card-title class="text-h4">
              {{registerProduct}}
            </v-card-title>
            <v-card-text class="text-caption  ">
              Nafdac registrations
            </v-card-text>
          </div>
        </v-col>
         <v-col 
          style="height:100px" class="">
          <div class="boxes1">
            <v-card-title class="text-h4">
              {{replaceCert}}
            </v-card-title>
            <v-card-text class="text-caption">
              Cert replacement
            </v-card-text>
          </div>
        </v-col>
      </v-row>
      
     <v-row class="mb-5">
        <v-col 
          style="height:100px" class="">
          <div class="boxes1">
            <v-card-title class="text-h4">
              {{trademark}}
            </v-card-title>
            <v-card-text class="text-caption  ">
              Trademark REG.
            </v-card-text>
          </div>
        </v-col>
         <v-col 
          style="height:100px" class="">
          <div class="boxes1">
            <v-card-title class="text-h4">
              {{cac}}
            </v-card-title>
            <v-card-text class="text-caption  ">
              CAC registrations
            </v-card-text>
          </div>
        </v-col>
      </v-row>
     </div>
     
    <div class="col-md-6 col-sm-10"> 
    <v-card elevation="1" class="mt- boxes1">
    <v-list class="">
      <v-subheader>ACTIONS</v-subheader>
      <v-list-item>
        <v-list-item-icon>
       <v-icon>mdi-account</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
        <router-link class="text-decoration-none nav-link" to="/admin/profile">
         Profile
        </router-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      
      <v-list-item>
        <v-list-item-icon>
       <v-icon>mdi-account-group-outline</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
        <router-link class="text-decoration-none nav-link" to="/admin/users">
         Clients
        </router-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      
       <v-list-item>
        <v-list-item-icon>
       <v-icon>mdi-briefcase</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
        <router-link class="text-decoration-none nav-link" to="/admin/project">
         Add project
        </router-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      
      <v-list-item>
        <v-list-item-icon>
       <v-icon>mdi-cart</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
        <router-link class="text-decoration-none nav-link" to="/admin/orders">
         Orders
        </router-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      
    </v-list>
    </v-card>
     </div>
   </div>
   
<!-- Row2 -->
   <div class="row">
     <div class="mt-7"> 
     <orders></orders>
     </div></div>
     
<hr>




 </div>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';
import vue from 'vue';
import orders from './my-orders.vue';
import users from './users.vue';

export default{
 components:{
  orders,users
 },
 computed:{
   user(){
       return JSON.parse(localStorage.getItem('user')); },
 },
 data(){
  return{
      trademark:"",
      cac:"",
      registerProduct:"",
      replaceCert:"",
      DASHBOARD:getApi.DASHBOARD,
  }
 },
 methods:{
   
        
 },
 created(){
     this.DASHBOARD().then(r=>{
       this.trademark=r.data.trademark;
       this.cac=r.data.businessName;
       this.registerProduct=r.data.registerProduct;
       this.replaceCert=r.data.replaceCert;
     })
}}
</script>
<style>
  .boxes1{
    background-color:rgba(139,0,139,0.2);
    color:#952175 ;
    border-radius:10px;
  },
  .boxes2{
    background-color:rgba(39,45,139,0.2);
    color:#43ca32 ;
    border-radius:10px;
  }
</style>
