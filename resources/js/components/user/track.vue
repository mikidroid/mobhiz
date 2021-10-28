<template>
<div class="">
 
<track-product v-show="option=='register product'" :id="data"></track-product>
  
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
Vue.component('track-product',require('./track-nafdac-registration.vue').default);

 export default {

     data(){
      return{
       data:this.$route.params.id,
       option:"",
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
      this.axios.get(`/api/orders/${this.$route.params.id}`,c).then(r=>{
       this.orders=r.data;
       this.loading=false;
       
      }).catch(e=>{this.error=e.response.data.message})
      
      
     },
     updated(){

           }
     }
     
</script>