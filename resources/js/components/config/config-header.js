export default class config{
 
 constructor(token){
  let c=18;
  this.token=token;
 }
 getT(){
  let header={'headers':{
   'Authorization':`Bearer ${this.token}`,
   'content-type': 'multipart/form-data' 
  }};
  return header;
 }
}