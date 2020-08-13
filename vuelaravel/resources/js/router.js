import VueRouter from 'vue-router';
// Pages
import Home from './components/Home';
import Register from './components/Register';
import Login from './components/Login';
import Dashboard from './components/user/Dashboard';
import AdminDashboard from './components/admin/Dashboard';




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

 
 
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
    auth: true,
    }
  },

  { path: '*', redirect: '/' },


];
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
});


export default router

