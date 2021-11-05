<template>
 <div class="container">
 <h3>Our past jobs</h3>
 <hr>
<div class="row overflow-x">
  <div v-show="projects" v-for="(data,index) in projects" :key="index" class="col-4">
    <router-link class="text-secondary text-decoration-none" :to="'/view-project/'+data.id" >
    <img style="width:100%;height:150px;object-fit:cover" :src="'/storage/project/'+data.image">
    <div class="myTruncate1">{{data.title}}</div>
    <div class="myTruncate1 pl-2 bg-success text-white text-caption" >{{data.duration}}</div>
    </router-link>
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
     PROJECTS:getApi.PROJECTS,
     projects:""
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{},
   created(){
     this.PROJECTS().then(r=>{
       this.projects=r.data;
     })
   },
   updated(){},
   mounted(){},
 }
</script>