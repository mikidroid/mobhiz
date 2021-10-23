<template>
 <div v-show="replies!=''" class="mt-3">
   <v-spacer></v-spacer>
   <br/>
   <v-card-title class=" justify-center py-6">
      <h4 class="font-weight-normal text-h4 basil--text">
        Replies
      </h4>
    </v-card-title>
    <div v-for="(reply,index) in replies" :key="reply.id" >
       <v-card elevation="0" >
       <v-card-actions class="alert-success">
         <div class="mr-auto text-success" >
       <v-icon class="text-success">mdi-account</v-icon> {{reply.username}}
       </div>
       <v-card-subtitle class="ml-auto">
        #{{index+1}}
       </v-card-subtitle>
       </v-card-actions>
 
     <v-card-text>
       {{reply.body}}
     </v-card-text>

     <v-card-actions>
       
  <v-btn class="ml-2" :href="'/storage/reply/'+reply.file"  v-bind:class="{'green lighten-4':reply.file!=''}" v-bind:disabled="reply.file==''" small tile >View attachment </v-btn>
         
          <div class="mr-2 ml-auto text-caption font-weight-light font-italic">
            <v-icon small class="ml-auto">mdi-clock</v-icon>
         {{date(reply.created_at)}}
         </div>      
     </v-card-actions>
       </v-card> <hr v-if="index < replies.length-1">
</div>
 </div>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import createReply from './create-reply.vue';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';
import CreateReply from './create-reply.vue';
import moment from 'moment';

 export default{
   props:{
       message_id:String},
   data(){ return{
     REPLIES:getApi.REPLIES,
     replies:'',
     m:'',
     file:false
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
        mes(){
       return  1 },
   },
  
   methods:{
     date(val){
       return moment(val).fromNow(); },
   },
   created(){
     
   },
   updated(){},
   mounted(){this.REPLIES(this.message_id)
     .then((result) => {
       this.replies=result.data;
     }).catch((err) => {
       alert(err.response.data.message)
     });},
 }
</script>