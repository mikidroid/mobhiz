<template>
 <div class="container">
<h3>Admin Dashboard</h3>
<hr>
<v-btn to="/admin/profile">
 <v-icon>mdi-account</v-icon>
 Profile
</v-btn>
<v-btn to="/admin/users">
 <v-icon>mdi-product</v-icon>
 Clients
 
</v-btn>
<v-btn to="/admin/orders">
 
 <v-icon>mdi-product</v-icon>
 My Orders
 
</v-btn>

<v-btn to="/admin/registered-products">
 
 <v-icon>mdi-product</v-icon>
 Registered Products
 
</v-btn>

<v-btn to="/admin/project">
 
 <v-icon>mdi-product</v-icon>
 New project
 
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

