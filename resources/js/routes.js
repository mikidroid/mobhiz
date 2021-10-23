import Home from './components/pages/home.vue' ;
import Chats from './components/chat/chats.vue';
import Register from './components/auth/register.vue';
import Login from './components/auth/login.vue';
import admin from './components/AdminEntry.vue' ;
import guest from './components/guest.vue' ;
import CreateNotice from './components/admin/create-notice.vue';
import Clients from './components/admin/clients.vue';
import Guest from './components/guest.vue';
import AdminDashboard from './components/admin/dashboard.vue' ;
import registerProduct from './components/user/register-product.vue' ;
import registeredProducts from './components/user/registered-products.vue' ;
import editRegisteredProduct from './components/user/edit-register-product.vue' ;
import Dashboard from './components/user/dashboard.vue' ;
import Profile from './components/user/profile.vue' ;
import myOrders from './components/user/my-orders.vue' ;
import messages from './components/user/messages.vue' ;
import viewMessage from './components/user/view-message.vue' ;
import createMessage from './components/user/create-message.vue' ;
import track from './components/user/track.vue' ;
import payment from './components/user/payment.vue' ;
import adminDashboard from './components/admin/dashboard.vue' ;
import adminProfile from './components/admin/profile.vue' ;
import adminEditProfile from './components/admin/edit-profile.vue';
import adminOrders from './components/admin/my-orders.vue' ;
import adminRegisteredProducts from './components/admin/registered-products.vue' ;
import adminViewRegisteredProduct from './components/admin/view-registered-product.vue' ;
import adminMessages from './components/admin/messages.vue' ;
import adminViewMessage from './components/admin/view-message.vue' ;
import adminCreateMessage from './components/admin/create-message.vue' ;
import Users from './components/admin/users.vue' ;

export const routes = [
     //User routes
     {name: 'user',
     path: '/user',
     beforeEnter:(to,from,next)=>{
         if(localStorage.getItem('token')){
          if(localStorage.getItem('admin'))
          {next('/admin');}
           next()}
          else{next('/login')}},
     component: Guest,
     //Children routes for users
     children:[
            {name:'dashboard',
            path:'/',
            component: Dashboard},
            {name: 'messages',
            path: 'messages',
            component: Guest,
            beforeEnter:(to,from,next)=>{
            !localStorage.getItem('admin')?next():next('/admin/messages')},
            children:[{
               name: 'messages',
               path: '/',
               component: messages},{
               name: 'view-message',
               path: 'view-message/:id',
               component: viewMessage},{
               name: 'create-message',
               path: 'create-message',
               component: createMessage}]},
            {name: 'register-product',
            path: 'register-product',
            component:registerProduct},
            {name: 'registered-products',
            path: 'registered-products',
            component:registeredProducts},
            {name: 'edit-registered-product',
            path: 'edit-registered-product/:id',
            component:editRegisteredProduct},
            {name: 'profile',
            path: 'profile',
            component:Profile},
            {name: 'my-orders',
            path: 'my-orders',
            component:myOrders},
            {name: 'payment',
            path: 'payment/:ref_id/:type',
            component:payment},
            {name: 'track',
            path: 'orders/track/:id',
            component:track}]},
     //Guest routes
     {name: 'guest',
     path: '/',
     component: Guest,
     //Children routes for guests
     children:[
        {name: 'home',
        path: '/',
        component: Home },
        {name: 'chats',
        path: '/chats',
        component: Chats},
        {name: 'login',
        path: '/login',
        beforeEnter:(to,from,next)=>
        {!localStorage.getItem('token')?
        next():next('/user');},
        component: Login},
        {name: 'register',
        path: '/register',
        beforeEnter:(to,from,next)=>
        {!localStorage.getItem('token')?
         next():next('/user');},
        component: Register}]},
     //Admin routes
     {name: 'admin',
     path: '/admin',
     beforeEnter:(to,from,next)=>{!localStorage.getItem('admin')?
     next('/user'):next();},  
     component: admin,
     //Children routes for admin
     children:[
           {name: 'dashboard',
           path: '/',
           component: adminDashboard},
           {name: 'clients',
           path: 'clients',
           component: Clients},
           {name: 'create-notice',
           path: 'create-notice',
           component: CreateNotice},
           //Children routes for messages
           {name: 'messages',
           path: 'messages',
           component: admin,
           beforeEnter:(to,from,next)=>{localStorage.getItem('admin')?next():next('/user/messages')},
           children:[
              {name: 'messages',
              path: '/',
              component: adminMessages},
              {name: 'view-message',
              path: 'view-message/:id',
              component: adminViewMessage},
              {name: 'create-message',
              path: 'create-message',
              component: adminCreateMessage}]},
           {name: 'registered-products',
           path: 'registered-products',
           component:adminRegisteredProducts},
           {name: 'view-registered-product',
           path: 'view-registered-product/:id',
           component:adminViewRegisteredProduct},
           {name: 'profile',
           path: 'profile',
           component:adminProfile},
           {name: 'orders',
           path: 'orders',
           component:adminOrders},
           {name: 'adminUsers',
           path: 'users',
           component:Users},
           ]},

]