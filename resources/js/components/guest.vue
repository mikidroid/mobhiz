<template>
 
  <v-app app>
   
<!--<sidenav1></sidenav1> -->

<drawerNav></drawerNav>

<v-content>
 <v-container fliud>
<transition name="fade">
 <router-view>
 </router-view>
 </transition>
 </v-container>
 </v-content>
<br/>
<bottomNav></bottomNav>
 </v-app>
 
</template>

<script>
import Vue from 'vue'
Vue.component('bottomNav', require('./nav/bottomNav.vue').default)
Vue.component('drawerNav', require('./nav/drawerNav.vue').default)

 export default {
     data(){
      return{

         }
     } ,
    
     computed:{
      auth(){
       return localStorage.getItem('token')
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