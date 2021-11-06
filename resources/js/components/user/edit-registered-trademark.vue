<template>
 <div class="container">
  
  <v-card
    class="mx-auto"
    max-width="500"
  >
    <v-card-title class="text-h6 font-weight-regular justify-space-between">
      <span><h3>Edit Trademark registration</h3></span>
      <v-avatar
        color="primary lighten-2"
        class="subheading white--text"
        size="24"
        v-text="step"
      ></v-avatar>
    </v-card-title>

    <v-window v-model="step">
      <v-window-item :value="1">
       <v-card-subtitle>Fill your personal details</v-card-subtitle>
        <v-card-text>
 <v-text-field
            label="Personal phone"
            type="number"
            v-model="data.phone"
          ></v-text-field>

        </v-card-text>
      </v-window-item>

      <v-window-item :value="2">
           <v-card-subtitle>Fill Company details</v-card-subtitle>
        <v-card-text>
 <v-text-field
            label="Company Name"
            type="text"
            v-model="data.company_name"
          ></v-text-field>
          <v-text-field
            label="Company Address"
            type="text"
            v-model="data.company_address"
          ></v-text-field>
          <v-text-field
            label="Product name(s)"
            type="text"
            v-model="data.product_names"
          ></v-text-field>
  
    <span class="
      text-caption 
      grey--text 
      text--darken-1">
     Ensure that you put all required documents in a folder and ZIP it using softwares like "WinRar" before you upload it below.
     </span>
       <v-file-input
        show-size
        counter
        @change="onChange"
        label="Upload required document(s)">
       </v-file-input>
       <div v-show="oldDocuments" class="p-1 alert-success">{{data.documents}}</div>
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

    </v-window>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn
        :disabled="step === 1"
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
import updateApi from '../apis/updateApi.js';
import c from '../apis/deleteApi.js';
import {mapActions} from 'vuex';
import paystack from 'vue-paystack';
import sendE from '../config/send-email.js';

 export default {
  components:{paystack},
    data(){
      return{
         COM_ORDER:getApi.BUSINESS_ORDER,
         UPDATE_REGISTERED_TRADEMARK:updateApi.UPDATE_REGISTERED_TRADEMARK,
         VIEW_REGISTERED_TRADEMARK:getApi.VIEW_REGISTERED_TRADEMARK,
         SITE_NAME:cons.SITE_NAME,
         WHATSAPP_LINK:cons.WHATSAPP_LINK,
         step:1,
         doc:"",
         data:{
         documents:"",
         product_names:"",
         phone:null,
         company_address:"",
         company_name:null,
         ref_id:null},
         size:1,

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
     let subject=`Order Edited!`;
     let body=`
      <div>
      <p>Dear ${this.user.firstname}, we are pleased to inform you that your TRADEMARK REGISTRATION order has been edited.</p>
      <p></p>
      <p><b>If you have not completed your order, please click the link below to complete your order:</b></p>
      <div><b><a href="${this.WHATSAPP_LINK}">${this.WHATSAPP_LINK}</a></b></div>
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
        this.data.documents="File changed!"
        this.doc=event.target.files[0];},
      
    submitDetails(){
       let Config=new config(this.token).getT();
       let form=new FormData();
       
       form.append('documents',this.doc);
         form.append('phone',this.data.phone);
         form.append('company_address',this.data.company_address);
         form.append('company_name',this.data.company_name);
         form.append('product_names',this.data.product_names);
         form.append('ref_id',this.ref_id);
         form.append('_method','put');
       //this.axios.post('/api/register-product',doc,Config).
           this.UPDATE_REGISTERED_TRADEMARK(this.$route.params.id,form)
           .then(r=>{
           if(this.sendEmail(form)){
            this.$swal.fire({
               position: 'top-end',
              icon: 'success',
            title:'Data Updated!',
            toast:true,
           showConfirmButton: false,
           timer: 3500
             });
             this.step=4;}
           })
           .catch(e=>{
             this.$swal.fire({
               position: 'top-end',
               icon: 'error',
               toast:true,
               title:e.response.data.message,
               showConfirmButton: false,
               timer: 12500  })})
      },
    
      add(){
       this.size+=1;}
     },
     created(){
      this.ref_id=uniqid(Date.now());
      this.VIEW_REGISTERED_TRADEMARK(this.$route.params.id).then(r=>{
        this.data=r.data;
        this.oldDocuments=r.data.documents;
      })
     },
     updated(){
           }
     }
     
</script>