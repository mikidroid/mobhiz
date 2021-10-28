<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>My Orders</h2></div>
 <div class="col-4 d-flex flex-row-reverse">

 </div>
  <hr/>
  
  <div >
  <search v-bind:data="'orders'" v-on:search="search"></search>
  </div>
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
<th>Ref Id</th>
  <th>Nafdac status</th>
  <th>Mode</th>
  <th>Payment</th>
  <th>Actions</th>
  </tr>
 </thead>

  <tbody v-show="orders!=''">
   <tr v-for="(order,index) in pageOfItems" :key="order.id">
    <td>{{order.id}}</td>
<td>{{order.fullname}}</td>
 <td>{{order.company_address}}</td>
 <td>{{order.type}}</td>
 <td>{{order.email}}</td>
 <td>{{order.phone}}</td>
 <td>{{order.ref_id}}</td>
 <td>{{nafdac_status(order.nafdac_status)}}</td>
 <td>{{order.mode}}</td>
 <td><div>{{order.payment}}</div></td>
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
     <v-list-item @click="deleteOrder(order.id)" >
      <v-list-item-title>
       Delete Order
      </v-list-item-title>
     </v-list-item>
   <v-list-item :to="{name:'track',params:{id:order.id}}">
    
      <v-list-item-title>
       Track Progress
      </v-list-item-title>
      
     </v-list-item>
 <v-list-item v-if="order.payment==='pending'" >
      <v-list-item-title>
        <v-btn @click="confirmPayment(order)" color="success">
        <i class="fas fa-money-bill-alt mr-2"></i>
       Confirm Payment</v-btn>
      </v-list-item-title>
     </v-list-item>
 
    </v-list>
   </v-card>
    </v-menu></td>
   </tr>
  
  </tbody>
</table>
 <div class="alert alert-info" v-if="orders==''">
  Sorry! No Order Available.
 </div>

<jw-pagination :items="orders" :pageSize="5" @changePage="onChangePage"></jw-pagination>

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

 
 </div>
</template>

<script>
import Vue from 'vue';
import config from '../config/config-header.js';
import deleteApi from '../apis/deleteApi.js';
import getApi from '../apis/getApi.js';
import postApi from '../apis/postApi.js';
import cons from '../config/const.js';
import sendE from '../config/send-email.js';

 export default {
  data(){
      return{
       DEL_ORDER:deleteApi.DELETE_ORDER,
       SH_ORDERS:getApi.SEARCH_ORDERS,
       ORDERS:getApi.ORDERS,
       SITE_NAME:cons.SITE_NAME,
       PRODUCT_ORDER:postApi.PRODUCT_ORDER,
       page:1,
       error:"",
       number:0,
       orders:[],
       ord:"",
       searchValue:"",
       pageOfItems:[],
       loading:true
             } },
  computed:{
     user(){return JSON.parse(localStorage.getItem('user'))},
     token(){return localStorage.getItem('token')},     },
  watch:{
     searchValue(before, after){
        this.search()}
        },
  methods:{
    sendEmail(val){
     let subject=`Order Completed!`;
     let body=`
      <div>
      <p>Dear ${val.fullname}, we are pleased to inform you that your order has been completed and payment confirmed.</p>
      <p></p>
      <p><b>Details as follows:</b></p>
      <table class="p-2">
      <tr>
      <td>Fullname:</td>
      <td><b>${val.fullname}</b></td>
      </tr>
      <tr>
      <td>Company name:</td>
      <td><b>${val.company_name}</b></td>
      </tr>
      <tr>
      <td>Product names:</td>
      <td><b>${val.product_names}</b></td>
      </tr>
      <tr>
      <td>Order type:</td>
      <td><b>${val.type}</b></td>
      </tr>
      </table>
      <p></p>
      <p>You can always track your registration progress through your dashboard on <span class="alert-success p-1">"Orders >> Edit >> Track"</span>. </p>
      <p></p>
      <p>Feel free to contact us via your inbox or our direct email.</p>
      <hr>
      <p><b>Cheers!</b></p>
      <p><b>Yours truely, ${this.SITE_NAME}</b></p>
      <div>`;
      let send_email=new sendE(val.email,subject,body).sendEmail();
      if(send_email){
       return 1}},
       
    confirmPayment(val){
      switch(val.type){
        case 'product registration':
          if(this.sendEmail(val)){
          let form=new FormData();
          form.append('ref_id',val.ref_id);
          this.PRODUCT_ORDER(form)
          .then(r=>{
            alert(r.data)
            this.$swal.fire({
            icon:'success',
            toast:'true',
            title:'Order Confirmed!',
            position:'top-end',
            showConfirmButton:false,
            timer:2500})})
            .catch(e=>{
              alert(e.response.data)})};
            break;}},
            
    onChangePage(pageOfItems) {
          // update page of items
          this.pageOfItems = pageOfItems;},
          
    row(){return this.orders.length;},
    
    clearSearchValue(){this.searchValue="";},
    
    nafdac_status(val){ 
       switch (val){
        case 0:
         return 'level 1';
         break;
        case 1:
         return 'level 2';
         break;}
       return `hey ${val}`},
       
    deleteOrder(val){
       this.DEL_ORDER(val)
       .then(r=>{
         this.orders=r.data;
         this.$swal.fire({
            icon:'success',
            toast:'true',
            title:'Deleted successfully!',
            position:'top-end',
            showConfirmButton:false,
            timer:2500})})
       .catch(e=>{
        this.error=e.response.data})},
        
    search(value){
       this.orders=value;}},
       
  created(){
     let c=new config(this.token).getT();
     this.ORDERS().then(r=>{
       this.orders=r.data;
       this.loading=false;})
       .catch(e=>{
         this.error=e.response.data.message}) 
          },
          
  updated(){}
     }
     
</script>