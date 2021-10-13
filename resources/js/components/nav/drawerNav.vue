<template>
 <div>
    <v-app-bar
      color="#7a4988"
      fixed
      dark
      height="70px"
      
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title><img class="mr-2" src="/storage/core/logo.png" height="45px"></v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-filter</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>
<br/>
<br/>
<br/>
    <v-navigation-drawer
      v-model="drawer"
      floating
      app
      temporary
    >
<v-list-item>
 
        <v-list-item-content>
          <v-list-item-title class="text-h6">
            Application
          </v-list-item-title>
          <v-list-item-subtitle>
            subtext
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
<v-list-item v-if="user">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title >{{user.firstname}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item>
<v-list-item-icon>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-icon>
            <v-list-item-title>Foo</v-list-item-title>
          </v-list-item>
          
<v-list-item>
<v-list-item-icon>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-icon>
            <v-list-item-title>Foo</v-list-item-title>
          </v-list-item>
<v-list-item>
<v-list-item-icon>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-icon>
            <v-list-item-title>Foo</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Bar</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Fizz</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Buzz</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
     </div>
     
</template>



<script>

 export default {
     data(){
      return{
drawer: false,
      group: null,
         }
     } ,
    
     computed:{
      auth(){
       return localStorage.getItem('token')
      },
      user(){
       return JSON.parse(localStorage.getItem('user'))
      }
     },
     
watch: {
      group () {
        this.drawer = false
      },
    },
     methods:{
      
     },
     created(){

     },
     updated(){

           }
     }
     
</script>