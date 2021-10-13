<template>
 <div class="container">
  <v-card>
        <div class="pa-4 text-center">
          <h3 class="text-h6 font-weight-normal mb-2 text-secondary">
            Make Payment
          </h3>
          <hr/>
          <span class="text-caption grey--text">Make payment through paystack for your order to be complete!</span>
 <p></p>
     <paystack
        :amount="amount"
        :email="user.email"
        :paystackkey="paystackkey"
        :reference="ref_id"
        :callback="callback"
        :close="close"
        :embed="false" ><v-btn color="success">
        <i class="fas fa-money-bill-alt mr-2"></i>
       Pay With Paystack</v-btn>
    </paystack>
   <hr/>
    <div class="pa-4 text-center">
          
      <span class="text-caption grey--text">Make payment through Bank payment for your order to be complete!</span>
 <p></p>
     <v-btn color="info">
        <i class="fas fa-money-bill-alt mr-2"></i>
       Bank Payment</v-btn>
    
        </div>
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
     user(){
       return JSON.parse(localStorage.getItem('user')); },},
     amountNew(){
       let amount=String(this.amount)+"00";
       return parseInt(amount);},
   methods:{
     amountCal(val){
       let amount=String(val)+"00";
       return parseInt(amount);},
     close: function(){
          alert("Payment closed")},
     callback:function(response){
          this.COM_ORDER(this.ref_id).
          then(r=>{
          this.$swal.fire({
          icon: 'success',
          toast:true,
          position:'top-end',
          title: 'Payment Successful!',
          showConfirmButton:false,
          timer: 3500});
         this.$router.push('/user');})
      .catch(e=>{
       this.$swal.fire({
          icon: 'error',
          toast:true,
          position:'top-end',
          title:e.response.data.message,
          showConfirmButton:false,
          timer: 3500})})},
          },
   created(){
     switch(this.$route.params.type){
       case 'product registration':
        this.COM_ORDER=getApi.PRODUCT_ORDER;
        this.amount=this.amountCal(cons.REGISTER_PRODUCT_PRICE);
        break;
       case 'trademark registration':
        this.COM_ORDER=getApi.TRADEMARK_ORDER;
        this.amount=cons.REGISTER_TRADEMARK_PRICE;
        break;
       case 'business registration':
        this.COM_ORDER=getApi.BUSINESS_ORDER;
        this.amount=cons.REGISTER_BUSINESS_PRICE;
        break; }
   },
   updated(){},
   mounted(){},
 }
</script>