<template >
 <div class="container" >
<div class="jumbotron jumbotron-fluid text-grey">
  
    <h1 class="display-4">Quality at its best!</h1>
    <p class="lead">We at MOBHIZ, offer the best registration services and products to suit your needs.</p>
   <hr class="my-4">
  <p>Want to Know us better? click button below</p>
  <p class="lead">
    <v-btn small color="info" to="/about" >Learn more</v-btn>
  </p>
</div>
<br>
<br>
<br>
<br>

<div class="row">
 <div class="col-sm-12">
  <div class="mt-0" style="width:100%">
    <div class="row">
   <div class="col-md-6">
 <h5 style="background-color:#5dbb63;color:#fff;font-weight:bolder" class="p-3 m-1">
<i class="fa fa-spinner fa-spin"></i>
     NAFDAC Registration
     
    </h5>
<div style="" class="card alert-light shadow m-1" >
    <div class="card-body">
 <router-link to="/user/register-product" class="text-decoration-none text-secondary">
  <p class="card-text" >
<i class="far fa-edit"></i>
      NAFDAC Product Registration
     </p>
</router-link>
     <hr>
 <router-link to="/user/register-replace-cert" class="text-decoration-none text-secondary">
  <p class="card-text" >
<i class="fa fa-certificate" aria-hidden="true"></i>
      NAFDAC Certificate Replacement
     </p>
     </router-link>
     <hr>
    </div>
    
   </div>
   </div>
   
   
<div class=" col-md-6">
  <h5 style="background-color:#4393d4;color:#fff;font-weight:bolder;" class="gradient-custom6 p-3 m-1">
<i class="fa fa-spinner fa-spin"></i>
     Business Registration
     
    </h5>
<div style="" class="card alert-light shadow m-1" >
      <div class="card-body">
 <router-link to="/user/register-business" class="text-decoration-none text-secondary">
  <p class="card-text" >
<i class="far fa-edit"></i>
      CAC Registration
     </p>
</router-link>
     <hr>
 <router-link to="/user/register-trademark" class="text-decoration-none text-secondary">
  <p class="card-text" >
<i class="far fa-edit"></i>
      Trademark Registration
     </p>
</router-link>
  
     <hr>
    </div>
    
   </div>
   </div>
   </div>
   
<br>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="4000">
    <div class="carousel-inner" >
    <div style="background-color:#000;height:250px" v-for="(item,index) in items" class="carousel-item" v-bind:class="{'active':index==0}">
      <img class="d-block w-100" style="opacity:0.6" :src="item.src" alt="First slide">
      <div class="carousel-caption ">
        <h1>{{item.title}}</h1>
        <hr>
        <p>{{item.subtitle}}</p>
        <v-btn :href="item.link" v-show="item.link">{{item.link_text}}</v-btn>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
  
  <!--Projects slide -->
<project-slide class="mt-6"></project-slide>
  
   <div style="width:50%;float:left">
    <a class="text-decoration-none" href="mailto:info@mikidroid.com">
    <div style="height:180px" class="card shadow text-center alert-warning m-1 mt-5" >
    <div class="card-body py-7">
      <v-icon class="h5--text p-1" large>mdi-email</v-icon>
     <h3 class="card-title" >
      Send Us An <div>Email</div>
     </h3>
    </div>
   </div></a>
   </div>
   
   <div style="width:50%;float:left">
  <a class="text-decoration-none" href="tel:+2348137344078">
     <div style="height:180px" class="card text-center alert-success shadow m-1 mt-5" >
    <div class="card-body py-7">
      <v-icon class="h5--text p-1" large>mdi-phone</v-icon>
     <h3 class="card-title" >
      <div>Call Us</div> Now
     </h3>
    </div>
   </div></a>
   </div>
   
  </div>
  <p></p>
  <div class="mt-4" style="width:100%">
   
   <div style="width:50%;float:left">
 <a class="text-decoration-none" href="#">
    <div style="height:180px" class="card shadow text-center alert-light m-1 mt-5" >
    <div class="card-body py-7">
      <v-icon class="h5--text p-1" large>mdi-clipboard-text</v-icon>
     <h3 class="card-title" >
      Terms & conditions
     </h3>
    </div>
   </div></a>
   </div>
   
   <div style="width:50%;float:left">
     <router-link class="text-decoration-none" to="/about">
     <div style="height:180px" to="/about" class="card text-center alert-light shadow m-1 mt-5" >
    <div class="card-body py-7">
      <v-icon class="h5--text p-1" large>mdi-help-circle</v-icon>
     <h3 class="card-title" >
      <div>About</div> us
     </h3>
    </div>
   </div></router-link>
   </div>
   
  </div>
 </div>
 
 <div class="col-sm-12 col-md-4">
  
  
  

  
  

 </div>
</div>
</div>
</template>

<script>
import {mapMutations} from 'vuex';
import { mapActions } from 'vuex';
import cons from '../config/const.js';
import vue from 'vue';
vue.component('project-slide',require('./project-slide.vue').default);

 export default{
created(){
  
},
data () {
      return {
        WHATSAPP_LINK:cons.WHATSAPP_LINK,
        items: [
          {
            src: '/storage/home-slide/slide1.jpg',
            title:'Our service is 24/7',
            subtitle:'You can contact us anytime without worries.',
            link:cons.WHATSAPP_LINK,
            link_text:'Message us'
          },
          {
            src: '/storage/home-slide/slide2.jpg',
            title:'NAFDAC registration',
            subtitle:'Register your products through us. Leave the stress for us to handle for you.',
            link:'/user/register-product',
            link_text:'Register product'
          },
          {
            src: '/storage/home-slide/slide3.jpg',
            title:'Register business name',
            subtitle:'Business name registration now made easy.',
            link:'/user/register-business',
            link_text:'Register business'
          },
          {
            src: '/storage/home-slide/slide4.jpg',
            title:'Register trademark',
            subtitle:'Trademark registration made easy. Let us handle the work',
            link:'/user/register-trademark',
            link_text:'Register trademark'
          },
        ],
      }
    },
  
 }
 
</script>

<style>

 
</style>