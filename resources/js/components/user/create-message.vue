<template>
 <div class="container mt-0">
 
 <v-text-field
            label="Enter Subject *"
            type="text"
            required
            v-model="subject"
          ></v-text-field>
<v-textarea
          v-model="body"
          required
          label="Message body *"
          hint="Send message to Admin"
        ></v-textarea>
   <v-file-input
    show-size
    counter
    @change="onChange"
    label="Upload Attachment"
  ></v-file-input>
<v-btn @click="submit" v-bind:class="{'info':subject && body}">Send Message to Admin</v-btn>
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
     SEND_MSG:postApi.SEND_MESSAGE,
     GET_MSG:getApi.MESSAGES,
     subject:"",
     body:"",
     file:"",
     inbox:"",
     outbox:"",
     reciever_username:'admin'
   } },
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{
    submit(){
      let form=new FormData();
      form.append('body',this.body);
      form.append('subject',this.subject);
      form.append('username',this.user.username);
      form.append('reciever_username',this.reciever_username);
      form.append('user_id',this.user.id);
      form.append('file',this.file);
      this.SEND_MSG(form).then(r=>{
       this.$swal.fire({
        icon:'success',
        showConfirmButton:false,
        toast:true,
        title:'Message Sent To Admin!',
        timer:4000
       });
       this.body="";
       this.subject="";
       this.file="";
      }).catch(e=>{
        this.$swal.fire({
        icon:'error',
        showConfirmButton:true,
        toast:true,
        title:'Please fill required fields!',
        timer:4000
       });
       
      })
    },
    onChange(){
     this.file=event.target.files[0];
    }
   },
   created(){
  
   },
   updated(){},
   mounted(){},
 }
</script>