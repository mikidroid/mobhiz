<template>
 <div class="mt-0">
   <v-card>
     <v-card-title class="blue lighten-5" >
      {{data.subject}}
     </v-card-title>
     <v-card-subtitle v-show="data.username==user.username" class="blue lighten-5" >
       <span style="font-style:italic">Message to:</span>  <b >{{data.reciever_username}}</b>
     </v-card-subtitle>
      <v-card-subtitle v-show="data.username!=user.username" class="blue lighten-5" >
       <span style="font-style:italic">Message from:</span>  <b >{{data.username}}</b>
     </v-card-subtitle>
     <v-spacer></v-spacer>
     <v-card-text>
       {{data.body}}
     </v-card-text>

     <hr>
     <v-card-actions>
       <v-card-text>
      <v-btn :href="'/storage/message/'+data.file"  v-bind:class="{'green lighten-4':data.file!=''}" v-bind:disabled="data.file==''" small tile >View attachment </v-btn>
         </v-card-text>
          <v-card-text>
         {{data.created_at}}
         </v-card-text>      
     </v-card-actions>

   </v-card>

   <replies class="mt-5" :message_id="$route.params.id">
     
   </replies>

<create-reply :message_id="data.id" class="mt-3">

</create-reply>

 </div>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import CreateReply from './create-reply.vue';
import replies from './replies.vue';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';


 export default{
   components:{CreateReply, replies},
   data(){ return{
     VIEW_MSG:getApi.VIEW_MESSAGE,
     data:'',
     file:false
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
    dataId(){
    return this.data.id },
   },
   methods:{},
   created(){
     this.VIEW_MSG(this.$route.params.id)
     .then((result) => {
       this.data=result.data;
     }).catch((err) => {
       
     });
   },
   updated(){},
   mounted(){},
 }
</script>