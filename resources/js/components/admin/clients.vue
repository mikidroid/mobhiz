<template>
 <div>
<div class="container" >
 <h2>Clients</h2>
<p v-if="tok"> There is token</p>
 </div>
 </div>
</template>


<script>
export default{
 computed:{
  tok(){
   return localStorage.getItem('token')
  }
 }
}
 
     
</script>