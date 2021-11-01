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
  <th>Status</th>
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
 <td v-show="order.type!='product registration'">
   {{status_select(order.status)}}
   <v-select v-if=""
          v-model="status"
          :items="status_items"
          item-text="status"
          item-value="value"
          label="Update status"
          persistent-hint
          return-object
          single-line
          @change="changeReg(status.value,order)"
        > </v-select>
   </td>
 <td v-show="order.type=='product registration'">
   {{nafdac_status_select(order.nafdac_status)}}
   <v-select v-if=""
          v-model="nafdac_status"
          :items="nafdac_items"
          item-text="status"
          item-value="value"
          label="Update status"
          persistent-hint
          return-object
          single-line
          @change="changeReg(nafdac_status.value,order)"
        > </v-select>
 </td>
 <td><div>{{order.payment}}</div></td>
 <td><v-menu
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
     <v-list-item @click="viewItem(order)" >
      <v-list-item-title>
       View & download item
      </v-list-item-title>
     </v-list-item>
     <v-list-item @click="deleteOrder(order.id)" >
      <v-list-item-title>
       Delete Order
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
import updateApi from '../apis/updateApi.js';
import cons from '../config/const.js';
import sendE from '../config/send-email.js';

 export default {
  data(){
      return{
       DEL_ORDER:deleteApi.DELETE_ORDER,
       SH_ORDERS:getApi.SEARCH_ORDERS,
       ORDERS:getApi.ORDERS,
       UPDATE_ORDER_STATUS:updateApi.UPDATE_ORDER_STATUS,
       SITE_NAME:cons.SITE_NAME,
       SITE_LINK:cons.SITE_LINK,
       PRODUCT_ORDER:postApi.PRODUCT_ORDER,
       BUSINESS_ORDER:postApi.BUSINESS_ORDER,
       page:1,
       number:0,
       nafdac_status:"",
       status:"",
       orders:[],
       ord:"",
       searchValue:"",
       pageOfItems:[],
       loading:true
             } },
  computed:{

     user(){return JSON.parse(localStorage.getItem('user'))},
     
     token(){return localStorage.getItem('token')},
     status_items(){
       let array=[{status:'Order created',value:1 },{status:'Payment complete',value:2 },{status:'Reviewing documents',value:3 },{status:'Processing',value:4 },{status:'Complete',value:5 }]
       return array
     },
     nafdac_items(){
       let array=[{status:'Payment complete & Getting documents',value:1 },{status:'Creating company profile',value:2 },{status:'Registration online',value:3 },{status:'Submission of documents',value:4 },{status:'Vetting of documents',value:5 },{status:'inspection',value:6 },{status:'Process complete!',value:7 },]
       return array
     },},
     
  watch:{
     searchValue(before, after){
        this.search()}
        },
        
  methods:{
     viewItem(val){
       switch(val.type){
         case 'product registration':
           this.$router.push('/admin/view-registered-product/'+val.register_product_id)
           break;
         case 'cac registration':
           this.$router.push('/admin/view-registered-business/'+val.business_name_id)
           break;
       }
     },
     status_select:function(val){
           switch(val){
             case 1:
               return 'Order created';
               break;
             case 2:
               return 'Payment complete';
               break;
            case 3:
               return 'Reviewing documents';
               break;
            case 4:
               return 'Processing documents';
               break;
            case 5:
               return 'Complete';
               break;}},
     nafdac_status_select:function(val){
           switch(val){
             case 1:
               return 'Payment complete & Getting documents';
               break;
             case 2:
               return 'Creating company profile';
               break;
            case 3:
               return 'Registration online';
               break;
            case 4:
               return 'Submission of documents';
               break;
            case 5:
               return 'Vetting of documents';
               break;
            case 6:
               return 'inspection';
               break;
            case 7:
               return 'Process complete!';
               break;}},

    changeReg(val,order){
       let form=new FormData()
       form.append('value',val)
       form.append('type',order.type)
       form.append('_method','put')
           this.UPDATE_ORDER_STATUS(order.id,form)
           .then(r=>{
            if(this.send_StatusEmail(order)){
             this.fetchOrders()
             this.$swal.fire({
               icon:'success',
               showConfirmButton:false,
               title:'Order status changed!',
               timer:3500,
               position:'top-end',
               toast:true
             });
            }
           })
           .catch(e=>{
             alert(e.response.data.message)
           })
    },
    send_StatusEmail(val){
     let subject=`Order Update!`;
     let body=`
      <div>
      <p>Dear ${val.fullname}, we are pleased to inform you that your order has made progress to the next phase.</p>
      <p></p>
      <p>You can always track your registration progress through your dashboard on <span style="padding-left:4px;padding-right:4px;background-color:#25ab12;color:#fff">Orders >> Edit >> Track</span>. </p>
       <p>Visit your dashboard frequently: <a href="${this.SITE_LINK}">${this.SITE_LINK}</a></p>
      <p>Feel free to contact us via your inbox or our direct email.</p>
      <hr>
      <p><b>Cheers!</b></p>
      <p><b>Yours truely, ${this.SITE_NAME}</b></p>
      <div>`;
      let send_email=new sendE(val.email,subject,body).sendEmail();
      if(send_email){
       return 1}},
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
      <p>You can always track your registration progress through your dashboard on <span style="padding-right:4px;padding-left:4px;background-color:#25ab12;color:#fff">Orders >> Edit >> Track</span>. </p>
      <p></p>
      <p></p>
      <p>Feel free to contact us via your inbox or our direct email.</p>
      <hr>
      <p><b>Cheers!</b></p>
      <p><b>Yours truely, ${this.SITE_NAME}</b></p>
      <div>`;
      let send_email=new sendE(val.email,subject,body).sendEmail();
      if(send_email){
       return 1}},
    fetchOrders(){
     let c=new config(this.token).getT();
     this.ORDERS().then(r=>{
       this.orders=r.data;
       this.loading=false;})
       .catch(e=>{
         this.error=e.response.data.message})
    },
    confirmPayment(val){
      switch(val.type){
        case 'product registration':
          let form=new FormData();
          form.append('ref_id',val.ref_id);
          this.PRODUCT_ORDER(form)
          .then(r=>{
          if(this.sendEmail(val)){
            this.$swal.fire({
              icon:'success',
              toast:'true',
              title:'Order Confirmed!',
              position:'top-end',
              showConfirmButton:false,
              timer:2500})
            this.fetchOrders()}})
            .catch(e=>{
              alert(e.response.data.message)});
            break;
        case 'cac registration':
         form=new FormData();
          form.append('ref_id',val.ref_id);
          this.BUSINESS_ORDER(form)
          .then(r=>{
          if(this.sendEmail(val)){
            this.$swal.fire({
              icon:'success',
              toast:'true',
              title:'Order Confirmed!',
              position:'top-end',
              showConfirmButton:false,
              timer:2500})
            this.fetchOrders()}})
            .catch(e=>{
              alert(e.response.data.message)});
            break;
        
      }},
            
    onChangePage(pageOfItems) {
          // update page of items
          this.pageOfItems = pageOfItems;},
          
    row(){return this.orders.length;},
    
    clearSearchValue(){this.searchValue="";},
    
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
       this.fetchOrders() 
          },
          
  updated(){}
     }
     
</script>