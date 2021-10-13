<template>
 <div>
  <v-app app>
<adminDrawerNav></adminDrawerNav>
 <v-container>
 <router-view>
 </router-view>
 </v-container>
 </v-app>
 </div>
</template>

<script>

import Vue from 'vue'
Vue.component('adminDrawerNav',require('./nav/adminDrawerNav.vue').default)

 export default {
     data(){
      return{
      
         }
     } ,
     
     computed:{
   
     },
     methods:{
      
     },
     created(){
     
     }
     }
     
</script>