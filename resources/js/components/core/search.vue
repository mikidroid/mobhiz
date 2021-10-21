 <template>
  <div>

 <v-text-field
            v-model="searchValue"
            :append-icon="searchValue ? 'mdi-arrow-right' : ''"
            filled
            clear-icon="mdi-close-circle"
            clearable
            label="Search"
            type="text"
            @change="search"
            @click:append="search"
            @click:clear="clearSearchValue"
          ></v-text-field>
  </div>

  </template>

  <script>
     
import vue from 'vue';
import cons from '../config/const.js';
import postApi from '../apis/postApi.js';
import updateApi from '../apis/updateApi.js';
import getApi from '../apis/getApi.js';
import deleteApi from '../apis/deleteApi.js'; 

   export default{
    props:{
     data:String,
    },
    data(){
     return{
      SH_REG_PROD:getApi.SEARCH_REGISTERED_PRODUCTS,
      SH_ORDERS:getApi.SEARCH_ORDERS,
      SH_MESSAGES:getApi.SEARCH_MESSAGES,
      searchValue:"",
     }
    },
    watch:{
      searchValue(before,after){
       this.search();
      }
    },
    methods:{
     clearSearchValue(){
        this.searchValue="";},
     search(){
      switch(this.data){
       case 'register-product':
        this.searchProduct();
        break;
       case 'orders':
        this.searchOrder();
        break;
        case 'message':
        this.searchMessage();
        break;}
             },
     //Product search function
     searchProduct(){
        this.SH_REG_PROD(this.data,this.searchValue).
        then(r=>{
         this.$emit('search',r.data)
        })   },
     //Message search function
     searchMessage(){
        this.SH_MESSAGES(this.data,this.searchValue).
        then(r=>{
         this.$emit('search',r.data)
        })   },
     //Order search
     searchOrder(){
       this.SH_ORDERS(this.data,this.searchValue)
       .then(r=>{
       this.$emit('search',r.data)})
       .catch(e=>{
        alert(e.response.data.message)  })
                }
    },
    created(){
     
    }
   }
  </script>