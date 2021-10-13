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

    <v-tabs-items v-model="tab">
      <v-tab-item>
        one
      </v-tab-item>
<v-tab-item>
        two
      </v-tab-item>
<v-tab-item>
        <createMessage></createMessage>
      </v-tab-item>
    </v-tabs-items>
  
</template>
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
import createMessage from './create-message.vue';
 export default{
   components:{createMessage},
   data(){ return{
tab: null,
        items: [
          'Inbox', 'Outbox', 'Send Message' 
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{},
   created(){},
   updated(){},
   mounted(){},
 }
</script>

