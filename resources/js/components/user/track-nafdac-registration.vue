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
          <v-row class="pt-1" v-bind:class="{'text-dark':orders.nafdac_status>=0}" >

            <v-col>
              <strong>Order Made</strong>
              <div class="text-caption">
                Your order has been made
              </div>
            </v-col>
            <v-col cols="3">
                <p>
        <v-icon v-bind:class="{'text-info':orders.nafdac_status>=0}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
   <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<1,'text-dark':orders.nafdac_status>=1}">

            <v-col>
              <strong>Payment Complete & Getting all documents in required order</strong>
              <div class="text-caption">
                You have made payment. We are making sure all the documents sent meets the requirements.
              </div>
            </v-col>
            <v-col cols="3">
              <p  >
               <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<1,'text-info':orders.nafdac_status>=1}">fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<2,'text-dark':orders.nafdac_status>=2}">

            <v-col>
              <strong>Creating Company profile</strong>
              <div class="text-caption">
                Company profile is being created.
              </div>
            </v-col>
            <v-col cols="3">
                <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<2,'text-info':orders.nafdac_status>=2}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<3,'text-dark':orders.nafdac_status>=3}">
    
            <v-col>
              <strong>Payment Complete & Getting all documents in required order</strong>
              <div class="text-caption">
                You have made payment. We are making sure all the documents sent meets the requirements.
              </div>
            </v-col>
        <v-col cols="3">
                      <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<3,'text-info':orders.nafdac_status>=3}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>

  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<4,'text-dark':orders.nafdac_status>=4}">

            <v-col>
              <strong>Payment Complete & Getting all documents in required order</strong>
              <div class="text-caption">
                You have made payment. We are making sure all the documents sent meets the requirements.
              </div>
            </v-col>
            <v-col cols="3">
                  <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<4,'text-info':orders.nafdac_status>=4}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        
  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<5,'text-dark':orders.nafdac_status>=5}">

            <v-col>
              <strong>Payment Complete & Getting all documents in required order</strong>
              <div class="text-caption">
                You have made payment. We are making sure all the documents sent meets the requirements.
              </div>
            </v-col>
            <v-col cols="3">
                   <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<5,'text-info':orders.nafdac_status>=5}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>

  <v-timeline-item
          color="pink"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<6,'text-dark':orders.nafdac_status>=6}">

            <v-col>
              <strong>Payment Complete & Getting all documents in required order</strong>
              <div class="text-caption">
                You have made payment. We are making sure all the documents sent meets the requirements.
              </div>
            </v-col>
            <v-col cols="3">
                  <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<6,'text-info':orders.nafdac_status>=6}" >fas fa-check</v-icon></p>
            </v-col>
          </v-row>
        </v-timeline-item>
        <v-timeline-item
          color="teal lighten-3"
          small
        >
          <v-row class="pt-1" v-bind:class="{'text-grey':orders.nafdac_status<7,'text-success':orders.nafdac_status==7}">

            <v-col>
              <strong>Completed!</strong>
              <div class="text-caption">
                Congrats! the entire process is done.
              </div>
            </v-col>
            <v-col cols="3">
                    <p>
        <v-icon color="#ededed" v-bind:class="{'text-grey':orders.nafdac_status<7,'text-info':orders.nafdac_status>=7}" >fas fa-check</v-icon></p>
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
       id:Object,
     },
     data(){
      return{
       data:this.$route.params.id,
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
    onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
        }
      ,
      row(){
       return this.orders.length;
      },
      nafdac_status(val){ 
       switch (val){
        case 0:
         return ' ';
         break;
        case 1:
         return 'Getting all documents in the required order';
         break;
case 1:
         return 'level 2';
         break;
case 1:
         return 'level 2';
         break;
case 1:
         return 'level 2';
         break;
case 1:
         return 'level 2';
         break;
case 1:
         return 'level 2';
         break;
case 1:
         return 'level 2';
         break;
case 1:
         return 'level 2';
         break;
       }
       return `hey ${val}`},
      deleteOrder(val){
       // let c=new config(this.token).getT();
     /*  this.axios.delete(`/api/orders/${val}`,c).then(r=>{
         this.orders=r.data;
         this.$swal.fire({
            icon:'success',
            toast:'true',
            title:'Deleted successfully!',
            position:'top-end',
            showConfirmation:false
         })
       })*/
      let der= new deleteApi(this.token,val).order();
         der.
         then(r=>{
         this.orders=r.data;
         this.$swal.fire({
            icon:'success',
            toast:'true',
            title:'Deleted successfully!',
            position:'top-end',
            showConfirmation:false
         })
       }).catch(e=>{
        this.error=e.response.data
       })
      },
      d2:function(val){
       if(val=='Kalu'){
     
        return "paid";
       }else{
        return "not paid";
       }
      }
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