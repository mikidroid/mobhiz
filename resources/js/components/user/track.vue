<template>
<div class="">
 
<track-product v-show="type=='product registration'" :id="id"></track-product>
  
 </div>
</template>

<script>
import Vue from 'vue';
import config from '../config/config-header.js';
import deleteApi from '../apis/deleteApi.js';
Vue.component('track-product',require('./track-nafdac-registration.vue').default);

 export default {

     data(){
      return{
       id:this.$route.params.id,
       type:this.$route.params.type,
       error:"",
       number:0,
       orders:"",
       pageOfItems:[],
       loading:true,
       steps:{
         step1:7,
         step2:false,
         
       }
         }
     } ,
    
     computed:{
      user(){
       return JSON.parse(localStorage.getItem('user'))
      },
      token(){
       return localStorage.getItem('token')
      },
     },
     
     watch: {
    },
     methods:{
     },
     created(){
    
     },
     updated(){

           }
     }
     
</script>