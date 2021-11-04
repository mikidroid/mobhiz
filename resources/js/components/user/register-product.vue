<template>
 <div class="container">
   <br>
   <br>
 <v-btn class="mb-2" elevation="1" color="text-danger" tile small @click="!showGuide?showGuide=true:showGuide=false" >{{showGuide?'Registration requirements':'Registration requirements'}} <v-icon>{{showGuide?'mdi-chevron-down':'mdi-chevron-right'}}</v-icon></v-btn>
   <div class="my-2" v-show="showGuide">
   <div class="alert alert-danger p-2">
  <b>NOTE:</b> You are required to put all required PDF or JPG documents in a folder and zip it before you upload it.
   </div>
  <div class="alert alert-success p-1 font-weight-normal">
   <ul>
<li> CAC certificate</li>
<li> Trademark for products</li>
<li> Tin number if available </li>
<li> Company name and address </li>
<li> Product name(s) </li>
<li> Phone number(s) </li>
<li> Colored artworks/labels </li>
<li> Certificate of Analysis </li>
<li> Power of Attorney for (imported products)</li>
<li> Freesale for (imported products)</li>
<li> Notarized declaration for (imported products)</li>
<li> S. O. Ps (Standard Operation Procedure)</li>
<li> Medical fitness test for staffs </li>
<li> Water treatment certificate</li>
<li> Fumigation certificate  </li>
<li> Copy of Expired license(for renewal purpose only)</li>


   </ul>
   </div>
 </div>

  <v-card
    class="mt-2 mx-auto"
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
<span class="text-caption grey--text text--darken-1">
            Ensure that you put all required documents in a folder and ZIP it using softwares like "WinRar" before you upload it below.
          </span>
   <v-file-input
    show-size
    counter
    @change="onChange"
    label="Upload required document(s)"
  ></v-file-input>
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
     <v-card-content>
      <v-card-subtitle>
        Your Transaction Id is: 
      <span class="p-2 alert-success">
        {{ref_id}}
      </span>
      </v-card-subtitle>
      <v-card-text>
        You will be required to submit this code to our agent after negotiation and payment has been completed. Only then will your payment be confirmed.
      </v-card-text>
      <v-divider></v-divider>
      <v-card-text>
        Please connect with our agent below to begin negotiation and complete payment.
      </v-card-text>
      <v-card-text>
      <v-btn :href="WHATSAPP_LINK+'?text=Hi admin, my name is '+user.firstname+' with transaction id: '+ref_id+'. I will like to complete my registration. Thank you!'" color="info">
      <i class="fas fa-money-bill-alt mr-2"></i>
       Connect with our Agent
     </v-btn>
      <i class="fas fa-money-bill-alt mr-2"></i>
       Connect with our Agent
     </v-btn>
      </v-card-text>
     </v-card-content>
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
 <br>
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
import sendE from '../config/send-email.js';

 export default {
  components:{paystack},
    data(){
      return{
         COM_ORDER:getApi.PRODUCT_ORDER,
         REG_PRODUCT:postApi.REGISTER_PRODUCT,
         SITE_NAME:cons.SITE_NAME,
         WHATSAPP_LINK:cons.WHATSAPP_LINK,
         step:1,
         showGuide:false,
         type_items:['new','renewal'],
         type:"",
         doc:"",
         phone:null,
         company_phone1:"",
         company_phone2:"",
         company_address:"",
         product_names:null,
         company_name:null,
         company_email:null,
         size:1,
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
    
    sendEmail(val){
     let subject=`Order Placed!`;
     let body=`
      <div>
      <p>Dear ${this.user.firstname}, we are pleased to inform you that your PRODUCT REGISTRATION order has been placed.</p>
      <p></p>
      <p>Your Transaction Id is: 
       <b style="margin-left:3px;font-size:16px;color:#ed4786">${this.ref_id}</b></p>
      <p>You will be required to submit your Transaction Id before completing payment. So keep it safe!</b></p>
      <p><b>Click the link below to complete your order:</b></p>
    <div><b><a href="${this.WHATSAPP_LINK}?text=Hi admin, my name is ${this.user.firstname} with transaction id: ${this.ref_id}. I will like to complete my registration. Thank you!">${this.WHATSAPP_LINK}</a></b></div>
      <p></p>
      <p>Once order is successful, you will be able to track your registration progress through your dashboard on <span class="alert-success p-1">"Orders >> Edit >> Track"</span>. </p>
      <p></p>
      <p>Feel free to contact us via your inbox or our direct email.</p>
      <hr>
      <p><b>Cheers!</b></p>
      <p><b>Yours truely, ${this.SITE_NAME}</b></p>
      <div>`;
      let send_email=new sendE(this.user.email,subject,body).sendEmail();
      if(send_email){
       return 1}},
   
    onChange(){
        this.doc=event.target.files[0];},
      
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
           this.REG_PRODUCT(form)
           .then(r=>{
           if(this.sendEmail(form)){
            this.$swal.fire({
               position: 'top-end',
              icon: 'success',
            title:'Data Registered!',
            toast:true,
           showConfirmButton: false,
           timer: 3500
             });
             this.step=4;}
           })
           .catch(e=>{
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