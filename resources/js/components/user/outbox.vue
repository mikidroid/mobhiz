<template>
 <div class="container mt-0">
 <div v-if="outbox==''">No messages yet!</div>
     <div v-if="outbox!=''">
         <v-list >
           <v-list-item  v-for="message in outbox" @click="viewMessage(message.id)" key="message.id" >
             <v-list-item-content v-bind:class="{'text-secondary':message.read==1,'text-dark':message.read==0}">
             <v-list-item-title>
               {{message.username}}
             </v-list-item-title>
             <v-list-item-subtitle v-bind:class="{'text-secondary':message.read==1,'text-dark':message.read==0}">
               {{message.subject}}
             </v-list-item-subtitle>
             </v-list-item-content>
             <v-list-item-action-text v-bind:class="{'text-secondary':message.read==1,'text-dark':message.read==0}">
               {{date(message.created_at)}}
             </v-list-item-action-text>
           </v-list-item>          
         </v-list>
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
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';
import moment from 'moment';

 export default{
    props:{
       outbox: Array,
       
    },
   components:{
       
   },
   data(){ return{
     MSG_RD:getApi.MESSAGE_READ,
     
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
  
   },
   methods:{
    date(val){
       return moment(val).format('MMMM Do YYYY, h:mm a'); },
     viewMessage(id){
       this.MSG_RD(id)
       .then((r) => {
         this.$router.push('/user/messages/view-message/'+id)
       }).catch((r) => {
         alert(e.response.data.message)
       });
     }
   },
   created(){
     
   },
   updated(){},
   mounted(){},
 }
</script>