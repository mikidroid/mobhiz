<template>
 <div class="container">
<h3>Dashboard</h3>
<hr>
<v-btn to="/user/profile">
 <v-icon>mdi-account</v-icon>
 Profile
</v-btn>
<v-btn to="/user/register-product">
 <v-icon>mdi-product</v-icon>
 Register Product
 
</v-btn>
<v-btn to="/user/my-orders">
 
 <v-icon>mdi-product</v-icon>
 My Orders
 
</v-btn>

<v-btn to="/user/registered-products">
 
 <v-icon>mdi-product</v-icon>
 Registered Products
 
</v-btn>
 </div>
</template>

<script>
import uniqid from 'uniqid';
import paystack from 'vue-paystack';
export default{
 components:{
  
 },
 computed:{
  
 },
 data(){
  return{
          
  }
 },
 methods:{
   
        
 },
 created(){
     
}}
</script>

