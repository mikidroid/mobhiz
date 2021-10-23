<template>
 <div class="container mt-0">
 
 <hr>
<template>
  
    <v-card-title class=" justify-center py-6">
      <h3 class="font-weight-normal text-h3 basil--text">
        Messages
      </h3>
    </v-card-title>
    <v-tabs
      v-model="tab"
      background-color="transparent"
      color="basil"
      grow
    >
      <v-tab
        v-for="item in items"
        :key="item"
      >
        {{ item }}
      </v-tab>
    </v-tabs>
      
      <search class="mt-4" v-bind:data="'message'" v-on:search="search($event)"></search>

    <v-tabs-items v-model="tab">
 
      <v-tab-item>
       
        <inbox :inbox="inbox"></inbox>
      </v-tab-item>
<v-tab-item>
        <outbox :outbox="outbox"></outbox>
</v-tab-item>
<v-tab-item>
        <createMessage></createMessage>
      </v-tab-item>
</v-tabs-items>
  
</template>
 </div>
</template>

<script>
import vue from 'vue';
import outbox from './outbox.vue';
import inbox from './inbox.vue';
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';
import createMessage from './create-message.vue';

 export default{
   components:{inbox,outbox,createMessage},
   data(){ return{
        tab: null,
        items: [
          'Inbox', 'Outbox', 'Send Message'],
        inbox:"",
        outbox:"",
        GET_MSG:getApi.MESSAGES,

   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
newInbox(){
       return 'this.inbox' },
   },
   methods:{
     search(val){
       this.outbox=val.outbox;
       this.inbox=val.inbox;
     }
   },
   created(){
       this.GET_MSG()
       .then(r=>{
           this.inbox=r.data.inbox;
           this.outbox=r.data.outbox;
       }).catch(e=>{
           alert(e.response.data.message)
       })
   },
   updated(){},
   mounted(){},
 }
</script>

