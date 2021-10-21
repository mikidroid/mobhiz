<template>
 <div>
 <div v-if="outbox==''">No messages yet!</div>
  <div v-if="outbox!=''">
   <v-list three-line>
      <template v-for="(item, index) in outbox">
        <v-list-item
          :key="item.id"
           @click="viewMessage(item.id)">
          <v-list-item-avatar>
          <v-avatar
              color="primary"
              size="62"  >
          <span class="white--text text-h5">{{item.username.slice(0,1)}}</span>
          </v-avatar>
          </v-list-item-avatar>
          <v-list-item-content>
          <v-list-item-title class="font-weight-bold text-dark" v-text="item.subject"></v-list-item-title>
          <v-list-item-subtitle class="font-weight-light" v-html="'<b>'+item.username+'</b>'+' - '+item.body"></v-list-item-subtitle>
          <v-spacer></v-spacer>
          <v-list-item-subtitle >
          <v-icon small class="ml-auto">mdi-clock-outline</v-icon>
            <i>{{date(item.created_at)}}</i>
          </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
         <v-divider
          v-if="index < outbox.length - 1"
          :key="index">
         </v-divider>
      </template>
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

     active:true,

     MSG_RD:getApi.MESSAGE_READ,
     
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
  
   },
   methods:{
    date(val){
      // return moment(val).format('MMM Do YYYY, h:mm a');
       return moment(val).format('MMM Do YYYY, h:mm a'); },
     viewMessage(id){
         this.$router.push('/user/messages/view-message/'+id)
     }
   },
   created(){
     
   },
   updated(){},
   mounted(){},
 }
</script>