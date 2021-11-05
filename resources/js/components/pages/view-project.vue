<template>
 <div class="container">
  <div class="card">
    <div class="card-body">
    <div class="card-header-img mb-3">
    <img style="width:100%;height:auto;object-fit:;" :src="'/storage/project/'+data.image">
  </div>
 <h3 class="mt-2 p-1">{{data.title}}</h3>
<div class="p-1 bg-light mt-1 font-weight-light"><i>Client: </i>{{data.client}}</div>
<div class="mt-1 p-1">Time completed: <i style="background-color:#dc4321;color:#fff;border-radius:9px;padding-left:5px;padding-right:5px">{{data.duration}}</i></div>
 <p class="bg-light p-1 mt-1 font-weight-light">Description</p>
<div class="mt-1 p-1" v-html="data.details"></div>
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
     data:"",
     VIEW_PROJECT:getApi.VIEW_PROJECT,
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{},
   created(){
     this.VIEW_PROJECT(this.$route.params.id).then(r=>{
       this.data=r.data;
     })
   },
   updated(){},
   mounted(){},
 }
</script>

<style>
  .bg-grey{
    background-color: #efefef;
  },
 .bg-red{
    background-color: #efefef;
  }
</style>