<template>
 <div class="container mt-0">
 <div v-if="outbox==''">No messages yet!</div>
     <div v-if="outbox!=''">
         {{outbox}}
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

 export default{
    props:{
       outbox: Array,
       
    },
   components:{
       
   },
   data(){ return{
     
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{},
   created(){
     
   },
   updated(){},
   mounted(){},
 }
</script>