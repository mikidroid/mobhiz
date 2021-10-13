import axios from 'axios';

export default {
     login(data){
           return this.axios.post('/api/login',data);
                },
     register(data){
           return this.axios.post('/api/register',data);
     },
     logout(token){
         let config = {
              headers:{'Authorization':'bearer '+token,}
         };
           return this.axios.get('/api/logout',config);
     },
     details(token){
         let config = {
              headers:{'Authorization':'bearer '+token,}
         };
           return this.axios.get('/api/user',config);
     },
     posts(){
           return this.axios.get('/api/chat');
     }
}