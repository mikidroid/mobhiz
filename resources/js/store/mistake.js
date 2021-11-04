import Home from './components/pages/home.vue' ;
import Chats from './components/chat/chats.vue';
import Register from './components/auth/register.vue';
import Login from './components/auth/login.vue';
import admin from './components/AdminEntry.vue' ;
import guest from './components/guest.vue' ;
import CreateNotice from './components/admin/create-notice.vue';
import Clients from './components/admin/clients.vue';
import Guest from './components/guest.vue';
import UserEntry from './components/Users.vue';
import AdminDashboard from './components/admin/dashboard.vue' ;
//Register product for users
import registerProduct from './components/user/register-product.vue' ;
import registeredProducts from './components/user/registered-products.vue' ;
import viewRegisteredProduct from './components/user/view-registered-product.vue' ;
import editRegisteredProduct from './components/user/edit-register-product.vue' ;
//Register business for user
import registerBusiness from './components/user/register-business.vue' ;
import viewRegisteredBusiness from './components/user/view-registered-business.vue' ;
import editRegisteredBusiness from './components/user/edit-registered-business.vue' ;
//Trademark register
import registerTrademark from './components/user/register-trademark.vue' ;
import viewRegisteredTrademark from './components/user/view-registered-trademark.vue' ;
import editRegisteredTrademark from './components/user/edit-registered-trademark.vue' ;
//replaceCert register
import registerReplaceCert from './components/user/register-replace-cert.vue' ;
import viewRegisteredReplaceCert from './components/user/view-registered-replace-cert.vue' ;
import editRegisteredReplaceCert from './components/user/edit-registered-replace-cert.vue' ;
//Others
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
import adminViewRegisteredBusiness from './components/admin/view-registered-business.vue' ;
import adminViewRegisteredTrademark from './components/admin/view-registered-trademark.vue' ;
import adminViewRegisteredReplaceCert from './components/admin/view-registered-replace-cert.vue' ;
import adminMessages from './components/admin/messages.vue' ;
import adminViewMessage from './components/admin/view-message.vue' ;
import adminCreateMessage from './components/admin/create-message.vue' ;
import Users from './components/admin/users.vue' ;
import viewClient from './components/admin/view-client.vue' ;

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
     component: UserEntry,
     //Children routes for users
     children:[
            {name:'dashboard',
            path:'/',
            component: Dashboard},
            {name: 'messages',
            path: 'messages',
            component: UserEntry,
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
            {name: 'view-registered-product',
            path: 'view-registered-product/:id',
            component:viewRegisteredProduct},
            {name: 'register-business',
            path: 'register-business',
            component:registerBusiness},
            {name: 'edit-registered-business',
            path: 'edit-registered-business/:id',
            component:editRegisteredBusiness},
            {name: 'view-registered-business',
            path: 'view-registered-business/:id',
            component:viewRegisteredBusiness},
            {name: 'register-trademark',
            path: 'register-trademark',
            component:registerTrademark},
            {name: 'edit-registered-trademark',
            path: 'edit-registered-trademark/:id',
            component:editRegisteredTrademark},
            {name: 'view-registered-trademark',
            path: 'view-registered-trademark/:id',
            component:viewRegisteredTrademark},
            {name: 'register-replace-cert',
            path: 'register-replace-cert',
            component:registerReplaceCert},
            {name: 'edit-registered-replace-cert',
            path: 'edit-registered-replace-cert/:id',
            component:editRegisteredReplaceCert},
            {name: 'view-registered-replace-cert',
            path: 'view-registered-replace-cert/:id',
            component:viewRegisteredReplaceCert},
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
            path: 'orders/track/:id/:type',
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
           {name: 'view-registered-business',
           path: 'view-registered-business/:id',
           component:adminViewRegisteredBusiness},
           {name: 'view-registered-trademark',
           path: 'view-registered-trademark/:id',
           component:adminViewRegisteredTrademark},
           {name: 'view-registered-replace-cert',
           path: 'view-registered-replace-cert/:id',
           component:adminViewRegisteredReplaceCert},
           {name: 'profile',
           path: 'profile',
           component:adminProfile},
           {name: 'orders',
           path: 'orders',
           component:adminOrders},
           {name: 'adminUsers',
           path: 'users',
           component:Users},
           {name: 'viewClient',
           path: 'view-client/:id',
           component:viewClient}
           ]},

]