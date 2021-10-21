<template>
 <div class="container mt-0">

<v-textarea
          v-model="body"
          required
          label="Send Reply *"
        ></v-textarea>
   <v-file-input
    show-size
    counter
    @change="onChange"
    label="Upload Attachment"
  ></v-file-input>
<v-btn color="blue lighten-5" @click="submit" v-bind:class="{'info':subject && body}">Send Reply</v-btn>
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
   props:{
       message_id:String,
   },
   data(){ return{
     SEND_REPLY:postApi.SEND_REPLY,
     body:"",
     file:"",
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
      form.append('username',this.user.username);
      form.append('message_id',this.message_id);
      form.append('user_id',this.user.id);
      form.append('file',this.file);
      this.SEND_REPLY(form).then(r=>{
       this.$swal.fire({
        icon:'success',
        showConfirmButton:false,
        toast:true,
        title:'Reply Sent!',
        timer:4000
       });
       this.body="";
       this.file="";
      }).catch(e=>{
        this.$swal.fire({
        icon:'error',
        showConfirmButton:true,
        toast:true,
        title:e.response.data.message,
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