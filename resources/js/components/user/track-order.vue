<template>
<div class="container">
 <div class="row">
  <div class="col-8">
 <h2>Track Order Progress</h2></div>

 </div>
  <hr/>
  <div ></div>

<v-timeline
        align-top
        dense
      >
        <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-dark':orders.status>=1}" >

            <v-col>
              <strong>Order Made</strong>
              <div class="text-caption">
                Your order has been made
              </div>
            </v-col>
            <v-col cols="3">
                <p>
        <v-icon v-bind:class="{'text-info':orders.status>=1}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
   <v-timeline-item
          color="pink"
          small>
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.status<2,'text-dark':orders.status>=2}">

            <v-col>
              <strong>Payment Complete</strong>
              <div class="text-caption">
                Your payment has been confirmed! 
              </div>
            </v-col>
            <v-col cols="3">
              <p  >
               <v-icon color="#ededed" v-bind:class="{'text-grey':orders.status<2,'text-info':orders.status>=2}">fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.status<3,'text-dark':orders.status>=3}">

            <v-col>
              <strong>Reviewing documents</strong>
              <div class="text-caption">
                Your documents are being checked for quality assurance
              </div>
            </v-col>
            <v-col cols="3">
                <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.status<3,'text-info':orders.status>=3}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.status<4,'text-dark':orders.status>=4}">
    
            <v-col>
              <strong>Processing</strong>
              <div class="text-caption">
          We are processing your order
              </div>
            </v-col>
        <v-col cols="3">
                      <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.status<4,'text-info':orders.status>=4}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>

  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.status<5,'text-success':orders.status>=5}">

            <v-col>
              <strong>Complete</strong>
              <div class="text-caption">
                Congrats! Order is complete and delivered
              </div>
            </v-col>
            <v-col cols="3">
                  <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.status<5,'text-info':orders.status>=5}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
      </v-timeline>
  
 <v-btn
 class="mt-5 mb-5"
 color="error"
@click="$router.go(-1)"
 tile
 outlined
 background="text-danger"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
  Go back</v-btn>
  
 </div>
</template>

<script>
import Vue from 'vue';
import config from '../config/config-header.js';
import deleteApi from '../apis/deleteApi.js';

 export default {

     props:{
       id:Number,
       
     },
     data(){
      return{
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
      let c=new config(this.token).getT();
      this.axios.get(`/api/orders/${this.id}`,c).then(r=>{
       this.orders=r.data;
       this.loading=false;
      }).catch(e=>{this.error=e.response.data.message})
      
      
     },
     updated(){

           }
     }
     
</script>