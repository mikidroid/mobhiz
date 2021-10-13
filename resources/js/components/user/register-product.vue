<template>
 <div class="container">
  
  <v-card
    class="mx-auto"
    max-width="500"
  >
    <v-card-title class="text-h6 font-weight-regular justify-space-between">
      <span><h3>Register Product</h3></span>
      <v-avatar
        color="primary lighten-2"
        class="subheading white--text"
        size="24"
        v-text="step"
      ></v-avatar>
    </v-card-title>

    <v-window v-model="step">
      <v-window-item :value="1">
       <v-card-subtitle>Fill your company details</v-card-subtitle>
        <v-card-text>
 <v-text-field
            label="Personal phone"
            type="number"
            v-model="phone"
          ></v-text-field>
 <v-text-field
            label="Company Name"
            type="text"
            v-model="company_name"
          ></v-text-field>
           <v-text-field
            label="Company Email"
            type="email"
            v-model="company_email"
          ></v-text-field>
          <v-text-field
            label="Company Address"
            type="text"
            v-model="company_address"
          ></v-text-field>
  <v-text-field
            label="Company Phone1"
            type="text"
            v-model="company_phone1"
          ></v-text-field>
  <v-text-field
            label="Company Phone2 (Optional)"
            type="text"
            v-model="company_phone2"
          ></v-text-field>
          <span class="text-caption grey--text text--darken-1">
            This is the email you will use to login to your Vuetify account
          </span>
        </v-card-text>
      </v-window-item>

      <v-window-item :value="2">
           <v-card-subtitle>Fill Product details</v-card-subtitle>
        <v-card-text>
       <v-select
          :items="type_items"
          v-model="type"
          label="Select the type of registration"
          dense
          outlined
        ></v-select>
  <v-text-field
            label="Product Names"
            type="text"
            v-model="product_names"
          ></v-text-field>
   <v-file-input
    show-size
    counter
    @change="onChange"
    label="Upload required document(s)"
  ></v-file-input>
        
          <span class="text-caption grey--text text--darken-1">
            This is the email you will use to login to your Vuetify account
          </span>
        </v-card-text>
      </v-window-item>

      <v-window-item :value="3">
        <div class="pa-4 text-cener">
          
          <h3 class="text-h6 font-weight-light mb-2">
            Save Details
          </h3>
          <v-btn rounded color="warning" @click="submitDetails" class="mb-3">
<v-icon left>
        mdi-arrow-up-bold-box-outline
      </v-icon>
           Save
          </v-btn>
          <div class="text-caption grey--text">Your details will be saved for further actions.</div>
        </div>
      </v-window-item>
    <v-window-item :value="4">
        <v-card>
        <div class="pa-4 text-center">
          <h3 class="text-h6 font-weight-normal mb-2 text-secondary">
            Make Payment
          </h3>
          <hr/>
          <span class="text-caption grey--text">Make payment through paystack for your order to be complete!</span>
 <p></p>
     <paystack
        :amount="amountNew"
        :email="user.email"
        :paystackkey="paystackkey"
        :reference="new_ref"
        :callback="callback"
        :close="close"
        :embed="false" ><v-btn color="success">
        <i class="fas fa-money-bill-alt mr-2"></i>
       Make Payment</v-btn>
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
        
      </v-window-item>
     
    </v-window>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn
        :disabled="step === 1 || step ===4"
        text
        @click="step--" >
        Back
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn
        :disabled="step > 2"
        color="primary"
        depressed
        @click="step++">
        Next
      </v-btn>
    </v-card-actions>
  </v-card>
 
 </div>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import getApi from '../apis/getApi.js';
import c from '../apis/deleteApi.js';
import {mapActions} from 'vuex';
import paystack from 'vue-paystack';

 export default {
  components:{paystack},
    data(){
      return{
         COM_ORDER:getApi.PRODUCT_ORDER,
         REG_PRODUCT:postApi.REGISTER_PRODUCT,
         step:1,
         type_items:['new','renewal'],
         type:"",
         doc:"",
         paystackkey:cons.PAYSTACK_KEY,
         amount:cons.REGISTER_PRODUCT_PRICE,
         phone:null,
         company_phone1:"",
         company_phone2:"",
         company_address:"",
         product_names:null,
         company_name:null,
         company_email:null,
         size:1,
         statu:null,
         statu2:null,
         ref_id:null,
      }
     } ,
    
  computed:{
     user(){
       return JSON.parse(localStorage.getItem('user'));},
     new_ref(){
           return uniqid(Date().now)},
     amountNew(){
       let amount=String(this.amount)+"00";
       return parseInt(amount);},
     token(){
       return localStorage.getItem('token');
      }},
  methods:{
   
  onChange(){
        this.doc=event.target.files[0];
      },
      submitDetails(){
       let Config=new config(this.token).getT();
       let form=new FormData();
       
       form.append('documents',this.doc);
         form.append('phone',this.phone);
         form.append('company_phone1',this.company_phone1);
         form.append('company_phone2',this.company_phone2);
         form.append('company_address',this.company_address);
         form.append('product_names',this.product_names);
         form.append('company_name',this.company_name);
         form.append('company_email',this.company_email);
         form.append('ref_id',this.ref_id);
         form.append('type',this.type);
       //this.axios.post('/api/register-product',doc,Config).
       this.REG_PRODUCT(form).
       then(r=>{
        this.$swal.fire({
           position: 'top-end',
          icon: 'success',
        title:'Data Registered!',
        toast:true,
       showConfirmButton: false,
       timer: 3500
         });
         this.step=4;
       }).
       catch(e=>{
         this.statu=e.response.data.message;
         this.statu2=e.response.data.line;
         this.$swal.fire({
           position: 'top-end',
           icon: 'error',
           toast:true,
           title:e.response.data.message,
           showConfirmButton: false,
           timer: 3500  })})
      },
    close: function(){
          alert("Payment closed")
      },
    callback:function(response){
         let form=new FormData();
         form.append('new_ref',response.reference);
          this.COM_ORDER(this.ref_id,form).
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
          timer: 3500
        })
      })},
      add(){
       this.size+=1;}
     },
     created(){
      this.ref_id=uniqid(Date.now());
     },
     updated(){
           }
     }
     
</script>