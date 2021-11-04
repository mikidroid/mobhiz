<template>
 <div class="container">
   <div class="card">
     <div class="card-body">
 <div class="display-4 card-title text-center">About</div>
 <hr>
<div class="card-text text-muted p-2">
At MOBHIZ GLOBAL, we help our clients in the registration of products for Nafdac,(imported and locally manufactured products) and obtaining of licenses for sales purpose.
<br/><br>
We also help our clients with the registration with some organizations such as  SON(Standard Organizations of Nigeria), MAN(Manufacturers Association of Nigeria), for microscale and small businesses. 
<br/><br>
We also have a section for marketing/sales of products of all types.
</div>
</div>
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
   components:{},
   data(){ return{
     
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