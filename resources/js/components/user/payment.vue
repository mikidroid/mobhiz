<template>
 <div class="container">
  <v-card>
   <div class="pa-4 text-center">
     <h3 
      class="text-h6 font-weight-normal mb-2 text-secondary">
        Make Payment
     </h3>
    <hr/>
    <v-card-content>
      <v-card-subtitle>
        Your Transaction Id is: 
      <span>{{ref_id}}</span>
      </v-card-subtitle>
      <v-card-text>
        You will be required to submit this code to our agent after negotiation and payment has been completed. Only then will your payment be confirmed.
      </v-card-text>
      <v-card-text>
        
      </v-card-text>
    </v-card-content>
    <p></p>
     <v-btn color="info">
      <i class="fas fa-money-bill-alt mr-2"></i>
       Complete Negotiation with our Agent
     </v-btn>
   </div>
 </v-card>
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

 export default{
   components:{paystack},
   data(){ return{
     COM_ORDER:"",
     data:{},
     amount:"",
     paystackkey:cons.PAYSTACK_KEY,
     ref_id:this.$route.params.ref_id,}},
   computed:{
     new_ref(){
           return uniqid()
       },
     user(){
       return JSON.parse(localStorage.getItem('user')); },},
    
   methods:{
          
          },
   created(){
     
   },
   updated(){},
   mounted(){},
 }
</script>