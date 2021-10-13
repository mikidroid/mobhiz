<template>
 <div style="margin: 0 !important;">
<nav class="navbar navba navbar-dark text-white bg-dark px-2 mb-3 p-4 ">
  <router-link class="text-decoration-none " to="/">  <div style="margin-left:5px;margin-right:2px;font-weight:bolder;"><img src="/storage/core/logo.jpg" height="30px" width="auto" style="margin-bottom:7px"><span class="dml" style="font-size:1.6em">MOBHIZ (Admin)</span></div></router-link>
     <button class="btn btn-outline" data-toggle="modal" data-target="#guest-nav">
            <span class="text-white">+</span>
     </button>
 </nav>
 
 <!-- Modal menu -->
 <nav-modal>
  <template v-slot:menu-title>
   MOBHIZ
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
  <template v-slot:menu-footer></template>
 </nav-modal>
 </div>
</template>

<style>
 .dmr{
  margin-right:5px;
  color:'red';
 }
 .dml{
  margin-left:3px;
  color:#dedede;
 }
</style>