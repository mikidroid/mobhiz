<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>My Registered Products</h2></div>
 
 </div>
  <hr/>
  
  <search v-bind:data="'register-product'" v-on:search="search($event)"></search>
  <div  class="table-responsive">
<table class="table">
 <thead>
  <tr>
  <th>S/N</th>
  <th>Fullname</th>
  <th>Company Address</th>
  <th>Type</th>
  <th>Email</th>
  <th>Phone</th>
  <th>Payment</th>
  <th>Actions</th>
  </tr>
 </thead>
  <tbody>
   <tr v-for="(product,index) in pageOfItems" :key="product.id">
    <td>{{product.id}}</td>
<td>{{product.fullname}}</td>
 <td>{{product.company_address}}</td>
 <td>{{product.type}}</td>
 <td>{{product.email}}</td>
 <td>{{product.phone}}</td>
 <td><div>{{product.payment}}</div></td>
 <td>   <v-menu
      top
      right
      offset-y
:nudge-width="200"
   >
    <template v-slot:activator="{on,attr}">
  <v-btn
     v-on="on"
     v-bind="attr"  >    
     <span>Edit</span>
      <v-icon>mdi-pencil</v-icon>
    </v-btn>
    </template>
   <v-card>
    <v-list>
  
   <v-list-item :to="{name:'edit-registered-product',params:{id:product.id}}">
    
      <v-list-item-title>
       Edit Registration
      </v-list-item-title>
      
     </v-list-item>
   <v-list-item v-bind:href="'/storage/register-product/'+product.documents" >
    
      <v-list-item-title>
       Download Documents
      </v-list-item-title>
      
     </v-list-item>
     
   <v-list-item @click="deleteProduct(product.id)" >
      <v-list-item-title>
       Delete
      </v-list-item-title>
     </v-list-item>
     
 
    </v-list>
   </v-card>
    </v-menu></td>
   </tr>
  
  </tbody>
</table>
 <div class="alert alert-info" v-if="products==''">
  Sorry! No Registered products Available.
 </div>

<jw-pagination :items="products" :pageSize="5" @changePage="onChangePage"></jw-pagination>

</div>
 <v-btn
 color="error"
 class="mt-3 mb-3"
 tile
@click="$router.go(-1)"
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

 export default {


     data(){
      return{
       DEL_REGISTERED_PRODUCT:deleteApi.DELETE_REGISTERED_PRODUCT,
       REGISTERED_PRODUCTS:getApi.REGISTERED_PRODUCTS,
       page:1,
       error:"",
       number:0,
       products:[],
       pageOfItems:[],
       loading:true
         }
     } ,
    
     computed:{
      user(){
       return JSON.parse(localStorage.getItem('user'))
      },
      token(){
       return localStorage.getItem('token')
      },
     },
     
     watch: {
      
    },
     methods:{
        search(value){
         this.products=value;
        },
        onChangePage(pageOfItems) {
          // update page of items
          this.pageOfItems = pageOfItems;},
     row(){
       return this.products.length;},
     nafdac_status(val){ 
       switch (val){
        case 0:
         return 'level 1';
         break;
        case 1:
         return 'level 2';
         break;}
       return `hey ${val}`},
     deleteProduct(val){
      
       this.DEL_REGISTERED_PRODUCT(val).then(r=>{
         this.products=r.data;
         this.$swal.fire({
            icon:'success',
            toast:'true',
            title:'Deleted successfully!',
            position:'top-end',
            showConfirmButton:false,
            timer:2500
         })
       }).catch(e=>{
        this.error=e.response.data
       })
      },
      d2:function(val){
       if(val=='Kalu'){
     
        return "paid";
       }else{
        return "not paid";
       }
      }
     },
     created(){
      let c=new config(this.token).getT();
      this.REGISTERED_PRODUCTS().then(r=>{
       this.products=r.data;
       this.loading=false;
      }).catch(e=>{
       alert(e.response.data.message)
       this.error=e.response.data.message})
     },
     updated(){

           }
     }
     
</script>