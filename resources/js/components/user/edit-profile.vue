<template>
<div>
 {{user.firstname}}
 </div>
</template>

<script>
import Vue from 'vue'

 export default {
     data(){
      return{

         }
     } ,
    
     computed:{
      user(){
       return JSON.parse(localStorage.getItem('user'))
      }
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