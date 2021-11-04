<template>
 <div class="container col-md-10">
<v-card>
  <v-card-title>
 Add project
 <hr>
  </v-card-title>
<v-card-text>
 <v-text-field
            label="Project title"
            type="text"
            v-model="title"
          ></v-text-field>
           <v-text-field
            label="Client"
            type="text"
            v-model="client"
          ></v-text-field>
         <vue-editor placeholder="Enter Project details..." v-model="details"></vue-editor>
          <v-text-field
            label="Duration"
            type="text"
            v-model="duration"
          ></v-text-field>
        <span 
          class="text-caption grey--text text--darken-1">
            Upload project image.
          </span>
         <v-file-input
          show-size
          counter
          @change="onChange"
          label="Upload image"
        ></v-file-input>
      <v-spacer></v-spacer>
      <v-btn @click="onSubmit" color="blue" class="text-white" big>Add project</v-btn>
</v-card-text>
</v-card>
<br>
<hr>
<br>
<v-card>
  <v-card-title><v-btn color="text-danger" tile small @click="!showProjects?showProjects=true:showProjects=false" >{{showProjects?'Hide Projects':'Show Projects'}} <v-icon>{{showProjects?'mdi-chevron-down':'mdi-chevron-right'}}</v-icon></v-btn></v-card-title>
  <v-card-text v-show="showProjects">
  <div  class="table-responsive">
<table class="table">
 <thead>
  <tr>
  <th>S/N</th>
  <th>Title</th>
  <th>Client</th>
  <th>Duration</th>
  <th>Actions</th>
  </tr>
 </thead>
  <tbody>
   <tr v-for="(project,index) in pageOfItems" :key="project.id">
    <td>{{index+1}}</td>
<td>{{project.title}}</td>
 <td>{{project.client}}</td>
 <td>{{project.duration}}</td>
 <td>   <v-menu
      top
      right
      offset-y
:nudge-width="200"
   >
    <template v-slot:activator="{on,attr}">
  <v-btn
     small
     v-on="on"
     v-bind="attr"  >    
     <span>Edit</span>
      <v-icon small>mdi-pencil</v-icon>
    </v-btn>
    </template>
   <v-card>
    <v-list>
  
   <v-list-item :to="{name:'edit-project',params:{id:project.id}}">
    
      <v-list-item-title>
       Edit
      </v-list-item-title>
      
     </v-list-item>
 
   <v-list-item @click="deleteProject(project.id)" >
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
 <div class="alert alert-info" v-if="projects==''">
  Sorry! No Project added yet.
 </div>

<jw-pagination :items="projects" :pageSize="5" @changePage="onChangePage"></jw-pagination>

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
     pageOfItems:[],
     DELETE_PROJECT:deleteApi.DELETE_PROJECT,
     projects:[],
     details:"",
     title:"",
     client:"",
     duration:"",
     image:"",
     ADD_PROJECT:postApi.ADD_PROJECT,
     LIST_PROJECTS:getApi.PROJECTS
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('project')); },
   },
   methods:{
     fetchProjects(){
       this.LIST_PROJECTS().then(r=>{
       this.projects=r.data
     })
     },
     deleteProject(id){
       this.DELETE_PROJECT(id).then(r=>{
         this.$swal.fire({
           toast:true,
           showConfirmButton:false,
           title:"Project deleted!",
           icon:'success',
           timer:3500
         });
         this.fetchProjects()
       })
     },
     onChangePage(pageOfItems){
       this.pageOfItems=pageOfItems;
     },
     onChange(){
       this.image=event.target.files[0];
     },
     onSubmit(){
       let form=new FormData();
       form.append('details',this.details)
       form.append('title',this.title)
       form.append('client',this.client)
       form.append('duration',this.duration)
       form.append('image',this.image);
       this.ADD_PROJECT(form).then
       (r=>{
         this.$swal.fire({
           toast:true,
           showConfirmButton:false,
           title:"Project added!",
           icon:'success',
           timer:3500
         });
         this.fetchProjects();
       }).catch(e=>{alert(e.response.data.message)})
     }
   },
   created(){
     this.fetchProjects()
   },
   updated(){},
   mounted(){},
 }
</script>