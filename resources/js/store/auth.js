import Vuex from 'vuex';
import Vue from 'vue';
import user from './../apis/user';
import csrf from './../apis/csrf';
import axios from 'axios';

Vue.use(Vuex);

export const authstore = new Vuex.Store({

 
 state:{
      authenticated:false,
      user:{},
      userType:"",
      error:"",
      success:"",
      errors:"",
      
      token:"",
      test:[{'name':'uche','message':'hello'},{'name':'uche','message':'hello'}],
      loading:true
 },
 
 getters:{
      authenticated(state){
       return localStorage.getItem('authenticated');
      },
      user(state){
       return state.user;
      },
      error(state,actions){
       return this.$store.dispatch('err');
      },
     token(state){
       return localStorage.getItem('token');
      }
 },
 
 mutations:{
      SET_AUTHENTICATED(state,value){
           state.authenticated=value;
      },
      SET_USER(state,value){
           state.user=value;
      },
SET_USERTYPE(state,value){
           state.userType=value;
      },
      SET_ERROR(state,value){
           state.error=value;
      },
      SET_ERRORS(state,value){
           state.errors=value;
      },
      SET_SUCCESS(state,value){
           state.success=value;
      },
      SET_TEST(state,value){
           state.test=value;
      },
      SET_TOKEN(state,value){
           state.token=value;
      },
      SET_LOADING(state,value){
           state.loading=value;
      }
 },
 
actions:{
 
      fucToken(){
       return localStorage.getItem('token')
      },
      
              
        config(token){
        let config={
         headers:{'Authorization':'bearer '+token} };
         return config;
      }}
 
 
});