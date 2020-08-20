import VueRouter from 'vue-router';
// Pages
import Home from './components/Home';
import Register from './components/Register';
import Login from './components/Login';
import Dashboard from './components/user/Dashboard';
import AdminDashboard from './components/admin/Dashboard';
import Product from './components/admin/Product';
import ForgotPassword from './components/ForgotPassword';
import ResetPasswordForm from './components/ResetPasswordForm';



// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
{
  path: '/logout',
  name: 'logout',
  meta: {
    auth: true
  }
},

//Forgot password
{ 
  path: '/reset-password', 
  name: 'reset-password', 
  component: ForgotPassword, 
  meta: { 
    auth:false 
  } 
},
{ 
  path: '/reset-password/:token', 
  name: 'reset-password-form', 
  component: ResetPasswordForm, 
  meta: { 
    auth:false 
  } 
},
 
 
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true,
      is_user:true,
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
    auth: true,
    is_admin:true,
    }
  },

   {
    path: '/products',
    name: 'admin.products',
    component:Product,
    meta: {
    auth: true,
    is_admin:true,
    }
  },


];
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
});



  router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.auth)) {

            let role = window.localStorage.getItem('role')
            if(to.matched.some(record => record.meta.is_admin)) {
                if(role == 2){
                    next()
                }
                else{

                  Swal.fire(
                    'Access Denied!',
                    'You have no access',
                    'warning'
                  )

                   next({ name: 'dashboard'})
                }
            }
            
            if(to.matched.some(record => record.meta.is_user)) {
              if(role == 1){
                  next()
              }
              else{

                Swal.fire(
                  'Access Denied!',
                  'You have no access',
                  'warning'
                )
                  next({ name: 'admin.dashboard'})
              }
          }
            
            else {
                next()
            }
        
    } else {
        next()
    }
})
          

export default router

