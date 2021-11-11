<template>
<div>
  
  <v-card>
   <v-card-title class="text-h6 font-weight-regular justify-space-between">
      <span><h3>Edit profile</h3></span>
    </v-card-title>
       <v-card-subtitle>Fill your personal details</v-card-subtitle>
        <v-card-text>
        <v-text-field
            label="FirstName"
            type="text"
            v-model="form.firstname"
          ></v-text-field>
        <v-text-field
            label="LastName"
            type="text"
            v-model="form.lastname"
          ></v-text-field>
        <v-text-field
            label="Email"
            type="email"
            v-model="form.email"
          ></v-text-field>
        <v-text-field
            label="Username"
            type="text"
            v-model="form.username"
          ></v-text-field>
         <v-text-field
            label="Personal phone"
            type="number"
            v-model="form.phone"
          ></v-text-field>
          <div class="mb-2 grey--text">Gender</div>
         <v-select
          :items="select_gender"
          v-model="form.gender"
          label="Select gender"
          dense
          outlined
          ></v-select>
          <v-text-field
            label="Country"
            type="text"
            v-model="form.country"
          ></v-text-field>
         <v-text-field
            label="City"
            type="text"
            v-model="form.city"
          ></v-text-field>
       <v-file-input
        show-size
        counter
        @change="onChange"
        label="Upload profile picture">
       </v-file-input>
      </v-card-text>
     </v-card-content>
     <v-card-actions>
   <button @click="updateProfile" type="submit" class="btn-info mb-5 text-white btn">Update profile <loader class="text-white" v-show="loading"></loader> </button>
     </v-card-actions>
  </v-card>
  
 <v-btn
 color="error"
 tile
 @click="$router.push('/admin')"
 outlined
 background="text-danger"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
  Go back</v-btn>
 </div>
</template>

<script>
import Vue from 'vue';
import uniqid from 'uniqid';
import config from '../config/config-header.js';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import deleteApi from '../apis/deleteApi.js';
import paystack from 'vue-paystack';

 export default {
     data(){
      return{
        profile_pic:'',
        select_gender:['Male','Female'],
        loading:false,
        UPDATE_USER:updateApi.UPDATE_USER,
        form:{
          city:"",
          gender:"",
          country:"",
        }
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
        async refreshUser(){
          let token=localStorage.getItem('token');
          const Config=new config(token).getT();
          const getUser=await this.axios.get('/api/user',Config);
          await localStorage.removeItem('user');
          localStorage.setItem('user',JSON.stringify(getUser.data.user));
        },
        onChange(){
          this.profile_pic=event.target.files[0];
        },
        async updateProfile(){
          this.loading=true;
          let form=new FormData();
          form.append('profile_pic',this.profile_pic)
          form.append('firstname',this.form.firstname)
          form.append('lastname',this.form.lastname)
          form.append('username',this.form.username)
          form.append('email',this.form.email)
          form.append('country',this.form.country)
          form.append('city',this.form.city)
          form.append('gender',this.form.gender)
          form.append('phone',this.form.phone)
          form.append('_method','put')
          try{
          let resp = await this.UPDATE_USER(this.user.id,form);
            this.$swal.fire({
              icon:'success',
              title:'Profile edited',
              showConfirmButton:false,
              timer:3000,
              toast:true,
              position:'top-end'
            });
            //Load user again
            this.refreshUser();
            location.href='/admin/profile';
            this.loading=false;
          }
          catch(e){
            alert(e.response.data.message)
            this.loading=false;
          }
          this.loading=false;
        }
     },

     async created(){
     this.form=this.user;
     },
     updated(){

           }
     }
     
</script>