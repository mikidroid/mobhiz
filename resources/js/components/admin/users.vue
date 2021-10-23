<template>
 <div class="container">
 <h3>Users</h3>
 <hr>
  <div  class="table-responsive">
<table class="table">
 <thead>
  <tr>
  <th>S/N</th>
  <th>Fullname</th>
  <th>Username</th>
  <th>Phone</th>
  <th>Email</th>
  <th>Gender</th>
  <th>Actions</th>
  </tr>
 </thead>
  <tbody>
   <tr v-for="(user,index) in pageOfItems" :key="user.id">
    <td>{{user.id}}</td>
<td>{{user.firstname+' - '+user.lastname}}</td>
 <td>{{user.username}}</td>
 <td>{{user.phone}}</td>
 <td>{{user.email}}</td>
 <td>{{user.gender}}</td>
 <td>   <v-menu
      top
      right
      offset-y
:nudge-width="200"
   >
    <template v-slot:activator="{on,attr}">
  <v-btn
     v-on="on"
     v-bind="attr"  >    
     <span>Edit</span>
      <v-icon>mdi-pencil</v-icon>
    </v-btn>
    </template>
   <v-card>
    <v-list>
  
   <v-list-item :to="{name:'edit-registered-product',params:{id:user.id}}">
    
      <v-list-item-title>
       View Client
      </v-list-item-title>
      
     </v-list-item>
   <v-list-item  >
    
      <v-list-item-title>
       Message Client
      </v-list-item-title>
      
     </v-list-item>
     
   <v-list-item @click="deleteUser(user.id)" >
      <v-list-item-title>
       Delete
      </v-list-item-title>
     </v-list-item>
     
 
    </v-list>
   </v-card>
    </v-menu></td>
   </tr>
  
  </tbody>
</table>
 <div class="alert alert-info" v-if="users==''">
  Sorry! No Client registered yet.
 </div>

<jw-pagination :items="users" :pageSize="5" @changePage="onChangePage"></jw-pagination>

</div>
 <v-btn
 color="error"
 class="mt-3 mb-3"
 tile
@click="$router.go(-1)"
 outlined
 background="text-danger"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
  Go back</v-btn>


 </div>
</template>

<script>
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';

 export default{
   components:{},
   data(){ return{
     users:[],
     USERS:getApi.USERS,
     pageOfItems:[],
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{
     onChangePage(pageOfItems){
       this.pageOfItems=pageOfItems;
     },
     deleteUser(){
       
     }
   },
   created(){
     this.USERS()
     .then(r=>{
       this.users=r.data;
     }).catch(e=>{alert(e.response.data.message)})
   },
   updated(){},
   mounted(){},
 }
</script>