<template>
 <div class="container mt-0">
 <h3 class="mt-0">View Message</h3>
 <hr>

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
   components:{},
   data(){ return{
     
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{},
   created(){
     this.GET_MSG()
       .then(r=>{
           this.inbox=r.data.inbox;
           this.outbox=r.data.outbox;
       })
   },
   updated(){},
   mounted(){},
 }
</script>