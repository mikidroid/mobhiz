 <template>
  <div>
   
 <v-text-field
            v-model="searchValue"
            :append-icon="searchValue ? 'mdi-account' : ''"
            filled
            clear-icon="mdi-close-circle"
            clearable
            label="Search Orders"
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
        break;}
             },
     //Product search function
     searchProduct(){
        this.SH_REG_PROD(this.data,this.searchValue).
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