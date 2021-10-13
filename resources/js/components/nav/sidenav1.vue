<template>
 <div >

<nav style="background-color:#7a4988" class="navbar navba  text-white px-2 mb-3 p-2">
  <router-link class="text-decoration-none " to="/">  <div style="margin-left:5px;margin-right:2px;font-weight:bolder;"><img src="/storage/core/logo.png" height="30px" width="auto" style="margin-bottom:7px">

  <span class="dml" style="font-size:1.6em"></span></div></router-link>
     <button class="btn btn-outline" data-toggle="modal" data-target="#guest-nav">
            <span class="text-white">+</span>
     </button>
 </nav>
 
 <!-- Modal menu -->
 <nav-modal >
  <template v-slot:menu-title>
<img src="/storage/core/logo.png" height="30px" width="auto" style="margin-bottom:7px">
   
  </template>
  <template v-slot:menu-body>
  <div class="w-100">
      
       <ul class="navbar-nav ml-auto">
         <div style="width:100%">
          <div class="col-sm-6 " style="width:33%;float:left">
               <li class="nav-item">
                <div class="d-flex">   <a class="nav-link" href="#">+ Link</a></div>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">+ Link 2</a>
                </li>
          </div>
       
          <div style="width:33%;float:left">
                <li class="nav-item">
                <div class="d-flex">   <a class="nav-link" href="#">+ Link</a></div>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">+ Link 2</a>
                </li>
          </div>
  <div style="width:33%;float:left">
                <li class="nav-item">
                <div class="d-flex">   <a class="nav-link" href="#">+ Link</a></div>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">+ Link 2</a>
                </li>
          </div>
            </div>
            </ul>
        </div>
    
  </template>
  <template v-slot:menu-footer>
  <div v-show="!auth">
   <router-link class="btn alert-primary btn-primary text-decoration-none" to="/login" data-dismiss="modal">Login</router-link>
   <router-link to="/register" data-dismiss="modal">Register</router-link>
   </div>
  </template>
 </nav-modal>
 </div>
</template>

<script>
 export default{
  data(){
   return{
    
   }
  },
  computed:{
      auth(){
       return localStorage.getItem('token')
      }
  }
  
  
 }
 
</script>
<style>
 .dmr{
  margin-right:5px;
  color:'red';
 }
 .dml{
  margin-left:3px;
  color:#fff;
 }
</style>