<template>
 <div class="container">
<template>
  <v-card
    max-width="375"
    class="mx-auto">
    
  <v-card-title class="text-h4">Contact</v-card-title>
    
   <v-divider inset></v-divider>
    <v-list two-line>
      <!--Phone 1-->
      <v-list-item>
        <v-list-item-icon>
        <a class="text-decoration-none" :href="'tel:'+PHONE_1">
          <v-icon color="indigo">
            mdi-phone
          </v-icon>
          </a>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{PHONE_1}}</v-list-item-title>
          <v-list-item-subtitle>Mobile</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-icon >
        <a class="text-decoration-none" :href="'https://wa.me/'+PHONE_1">
          <v-icon>mdi-message-text</v-icon>
          </a>
        </v-list-item-icon>
      </v-list-item>
     <!-- Phone 2 -->
     <v-list-item>
        <v-list-item-icon>
        <a class="text-decoration-none" :href="'tel:'+PHONE_2">
          <v-icon color="indigo">
            mdi-phone
          </v-icon>
          </a>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{PHONE_2}}</v-list-item-title>
          <v-list-item-subtitle>Work</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-icon >
        <a class="text-decoration-none" :href="'https://wa.me/'+PHONE_2">
          <v-icon>mdi-message-text</v-icon>
          </a>
        </v-list-item-icon>
        
     <!-- Email 1 -->
      </v-list-item>
      <v-divider inset></v-divider>
      <v-list-item>
        <v-list-item-icon>
         <a class="text-decoration-none" :href="'mailto:'+ADMIN_EMAIL">
          <v-icon color="indigo">
            mdi-email
          </v-icon></a>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{ADMIN_EMAIL}}</v-list-item-title>
          <v-list-item-subtitle>Office</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
     <!-- Email 2 -->
      <v-list-item>
        <v-list-item-icon>
    <a class="text-decoration-none" :href="'mailto:'+PERSONAL_EMAIL">
          <v-icon color="indigo">
            mdi-email
          </v-icon></a>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{PERSONAL_EMAIL}}</v-list-item-title>
          <v-list-item-subtitle>Personal</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>
      <v-list-item>
        <v-list-item-icon>
          <v-icon color="indigo">
            mdi-map-marker
          </v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>Lagos, Nigeria</v-list-item-title>
          <v-list-item-subtitle>lagos</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>
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
     PHONE_1:cons.PHONE_1,
     PHONE_2:cons.PHONE_2,
     ADMIN_EMAIL:cons.ADMIN_EMAIL,
     PERSONAL_EMAIL:cons.PERSONAL_EMAIL,
   }},
   computed:{
     user(){
       return JSON.parse(localStorage.getItem('user')); },
   },
   methods:{},
   created(){},
   updated(){},
   mounted(){},
 }
</script>