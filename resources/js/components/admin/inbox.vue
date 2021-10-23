<template>
 <div class="container mt-0">
   
   <div class="alert alert-info" v-if="inbox==''">No messages yet!</div>
   
     <div v-if="inbox!=''">
      <v-list three-line>
      <template v-for="(item, index) in inbox">
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
          <v-list-item-content v-bind:class="{'text-secondary':item.read==1,'text-dark':item.read==0}">
          <v-list-item-title class="font-weight-normal" v-text="item.subject"></v-list-item-title>
          <v-list-item-subtitle class="font-weight-light" v-bind:class="{'text-secondary':item.read==1,'text-dark':item.read==0}" v-html="'<b>'+item.username+'</b>'+' - '+item.body"></v-list-item-subtitle>
          <v-spacer></v-spacer>
          <v-list-item-subtitle class="text-caption">
          <v-icon small class="ml-auto">mdi-clock</v-icon>
            <i>{{date(item.created_at)}}</i>
          </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
         <v-divider
          v-if="index < inbox.length - 1"
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
       inbox:Array,
       
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
      // return moment(val).format('MMM Do YYYY, h:mm a');
       return moment(val).format('MMM Do YYYY, h:mm a'); },
      viewMessage(id){
       this.MSG_RD(id)
       .then((r) => {
         this.$router.push('/admin/messages/view-message/'+id)
       }).catch((r) => {
         alert(e.response.data.message)
       });
     }
   },
   created(){
      this.GET_MSG()
       .then(r=>{
           this.inbox=r.data.inbox;
       }).catch(e=>{
           alert(e.response.data.message)
       })
     
   },
   updated(){},
   mounted(){},
 }
</script>