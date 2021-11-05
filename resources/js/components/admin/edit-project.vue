<template>
 <div class="container col-md-10">
<v-card>
  <v-card-title>
 Update project
 <hr>
  </v-card-title>
<v-card-text>
 <v-text-field
            label="Project title"
            type="text"
            v-model="form.title"
          ></v-text-field>
           <v-text-field
            label="Client"
            type="text"
            v-model="form.client"
          ></v-text-field>
         <vue-editor placeholder="Enter Project details..." v-model="form.details"></vue-editor>
          <v-text-field
            label="Duration"
            type="text"
            v-model="form.duration"
          ></v-text-field>
        <span 
          class="text-caption grey--text text--darken-1">
            Upload project image.
          </span>
          <div class="alert alert-success">File: {{form.image}}</div>
         <v-file-input
          show-size
          counter
          @change="onChange"
          label="Upload image"
        ></v-file-input>
      <v-spacer></v-spacer>
      <v-btn @click="onSubmit" color="blue" class="text-white" big>Update project</v-btn>
</v-card-text>
</v-card>
<br>
<br>

 <v-btn
 color="error"
 class="mt-3 mb-3"
 tile
@click="$router.go(-1)"
 outlined
 background="text-danger"
 ><v-icon class="mr-1" >mdi-arrow-left</v-icon>
  Go back</v-btn>
  </v-card-text>
</v-card>
<br>
<br>
<br>
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
     showProjects:false,
     form:{
     details:"",
     title:"",
     client:"",
     image:"",
     duration:""},
     image:"",
     UPDATE_PROJECT:updateApi.UPDATE_PROJECT,
     VIEW_PROJECT:getApi.VIEW_PROJECT
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('project')); },
   },
   methods:{
     fetchProject(){
       this.VIEW_PROJECT(this.$route.params.id).then(r=>{
       this.form=r.data
     })
     },
     
     onChange(){
       this.image=event.target.files[0];
     },
     onSubmit(){
       let form=new FormData();
       form.append('details',this.form.details)
       form.append('title',this.form.title)
       form.append('client',this.form.client)
       form.append('duration',this.form.duration)
       form.append('image',this.image);
       form.append('_method','put');
       this.UPDATE_PROJECT(this.$route.params.id,form).then
       (r=>{
         this.$swal.fire({
           toast:true,
           showConfirmButton:false,
           title:"Project updated!",
           icon:'success',
           timer:3500
         });
         this.$router.go(-1);
       }).catch(e=>{alert("Project could not be updated!")})
     }
   },
   created(){
     this.fetchProject()
   },
   updated(){},
   mounted(){},
 }
</script>