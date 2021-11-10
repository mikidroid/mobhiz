<template>
 <div >
  <v-app app style="background-image:url('/img/home-top-background.png');object-fit:cover;background-repeat:no-repeat" >
<drawerNav></drawerNav>
<v-content >
 <v-container class="col-md-9 col-lg-9">
 <div v-show="loading" class="text-center">
  <b-spinner style="opacity:0.7;index-z:-1;width: 2rem; height: 2rem;" variant="primary" type="grow" label="Spinning"></b-spinner>
<b-spinner style="opacity:0.7;index-z:-1;width: 2rem; height: 2rem;" variant="primary" label="Spinning"></b-spinner>
<b-spinner type="grow" style="opacity:0.7;index-z:-1;width: 2rem; height: 2rem;" variant="primary" label="Spinning"></b-spinner>

</div>
<transition name="fade">
 <router-view>
 </router-view>
 </transition>
<div class="text-center font-weight-light text-caption">Developed by <b>•Mikidroid</b></div>
<br>
<br>
<br>
 </v-container>
 </v-content>

<bottomNav></bottomNav>
 </v-app>
 </div>
</template>

<script>
import Vue from 'vue'
Vue.component('bottomNav', require('./nav/bottomNav.vue').default)
Vue.component('drawerNav', require('./nav/drawerNav.vue').default)

 export default {
     data(){
      return{
       loading:this.$store.state.loading,
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