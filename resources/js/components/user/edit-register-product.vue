<template>
 <div class="container">
  
  <v-card
    class="mx-auto"
    max-width="500"
  >
    <v-card-title class="text-h6 font-weight-regular justify-space-between">
      <span><h3>Update Registered Product</h3></span>
     {{data.product_names[0].value}}
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
            v-model="data.phone"
          ></v-text-field>
 <v-text-field
            label="Company Name"
            type="text"
            v-model="data.company_name"
          ></v-text-field>
           <v-text-field
            label="Company Email"
            type="email"
            v-model="data.company_email"
          ></v-text-field>
          <v-text-field
            label="Company Address"
            type="text"
            v-model="data.company_address"
          ></v-text-field>
  <v-text-field
            label="Company Phone1"
            type="number"
            v-model="data.company_phones[0]"
          ></v-text-field>
  <v-text-field
            label="Company Phone2 (Optional)"
            type="number"
            v-model="data.company_phones[1]"
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
          v-model="data.type"
          label="Select the type of registration"
          dense
          outlined
        ></v-select>
  <v-text-field
            label="Product Names"
            type="text"
            v-model="data.product_names"
          ></v-text-field>
    <div class="p-2 alert-success" v-text="data.documents"></div>
   <v-file-input
    show-size
    counter
    @change="onChange"
    label="Upload required document(s)"
  ></v-file-input>
        
          <span class="text-caption grey--text text--darken-1">
            This are the documents that will be required for this process.
          </span>
        </v-card-text>
      </v-window-item>

      <v-window-item :value="3">
        <div class="pa-4 text-cener">
          
          <h3 class="text-h6 font-weight-light mb-2">
            Update Details
          </h3>
          <v-btn rounded color="warning" @click="submitDetails" class="mb-3">
<v-icon left>
        mdi-arrow-up-bold-box-outline
      </v-icon>
           Save
          </v-btn>
          <div class="text-caption grey--text">Your details will be updated.</div>
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
{{productNames}}
 </div>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import c from '../apis/deleteApi.js';
import {mapActions} from 'vuex';
import paystack from 'vue-paystack';

 export default {
  components:{paystack},
    data(){
      return{
         COM_ORDER:getApi.COMPLETE_ORDER,
         EDIT_REG_PRODUCT:getApi.VIEW_REGISTERED_PRODUCT,
         UPD_REG_PRODUCT:updateApi.UPDATE_REGISTERED_PRODUCT,
         step:1,
         type_items:['new','renewal'],
         doc:"",
         data:{
         
         },
         size:1,
         statu:null,
         statu2:null,
         
      }
     } ,
    
  computed:{
     user(){
       return JSON.parse(localStorage.getItem('user'));
      },
      
     amountNew(){
       let amount=String(this.amount)+"00";
       return parseInt(amount);
      },
     token(){
       return localStorage.getItem('token');
      }},
  methods:{
   
  onChange(){
        this.doc=event.target.files[0];
        this.data.documents="File updated!"
      },
      submitDetails(){
       //let Config=new config(this.token).getT();
       let id=this.$route.params.id;
       let doc=new FormData();
         doc.append('documents',this.doc);
         doc.append('phone',this.data.phone);
         doc.append('company_phone1',this.data.company_phones[0]);
         doc.append('company_phone2',this.data.company_phones[1]);
         doc.append('company_address',this.data.company_address);
         doc.append('product_names',this.data.product_names);
         doc.append('company_name',this.data.company_name);
         doc.append('company_email',this.data.company_email);
         doc.append('ref_id',this.ref_id);
         doc.append('type',this.data.type);
         doc.append('_method','put');
       //this.axios.post('/api/register-product',doc,Config).
       this.UPD_REG_PRODUCT(id,doc).
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
      }},
    
      
     created(){
      this.EDIT_REG_PRODUCT(this.$route.params.id)
      .then(r=>{
        this.data=r.data;
        this.product_names=r.data.product_names;
      }).catch(e=>{
       alert('No data.')
      })
     },
     updated(){
           }
     }
     
</script>