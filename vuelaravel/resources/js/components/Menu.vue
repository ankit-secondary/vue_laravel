<template>
  <div>
    <nav >
       <div class="container">
                <div class="nav-wrapper">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <!--UNLOGGED-->

            <li>
            <router-link :to="{name: 'home'}">
                    Home
                </router-link>
           </li>
      
            <li v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                <router-link  :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
            </li>
            <!--LOGGED USER-->
            <li v-if="$auth.check(1)" v-for="(route, key) in routes.user" v-bind:key="route.path">
                <router-link  :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
            </li>
            <!--LOGGED ADMIN-->
            <li v-if="$auth.check(2)" v-for="(route, key) in routes.admin" v-bind:key="route.path">
                <router-link  :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
            </li>

          

          </ul>
            <!--LOGOUT-->
             <ul class="right">
            <li v-if="$auth.check()">
                <a href="#" @click.prevent="$auth.logout()">Logout</a>
                
            </li>
          </ul>
        
      </div>
    </div>
  </nav>
     
        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    <span>&copy; 2018</span>  <a href="https://zapbuild.com" target="_blank" style="color:white;text-decoration:none">Zapbuild technologies</a>
                </div>
            </div>
        </footer>
        
    </div>
</template>
<script>

  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Register',
              path: 'register'
            },
            {
              name: 'Login',
              path: 'login'
            }
          ],
          // LOGGED USER
          user: [
            {
              name: 'Dashboard',
              path: 'dashboard'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Dashboard',
              path: 'admin.dashboard'
            }
          ]
        }
      }
    },
    mounted() {
      //
    }
  }
</script>

<style scoped>
    /*.fade-enter-active, .fade-leave-active {*/
        /*transition: opacity .5s*/
    /*}*/
    /*.fade-enter, .fade-leave-active {*/
        /*opacity: 0*/
    /*}*/
 
    .fade-enter-active,
    .fade-leave-active {
        transition-duration: 0.2s;
        transition-property: opacity;
        transition-timing-function: ease;
    }
 
    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }
 
    .container{
        padding:0px;
    }
    #nav-mobile a:hover{
        text-decoration: none !important;
        color:white;
    }
    #nav-mobile a:focus{
        text-decoration: none !important;
        color:white;
        background-color:rgba(0,0,0,0.1);
    }
 
    .page-footer{
        padding-top:0px;
        position:fixed;
        bottom:0;
        width:100%;
        z-index: 1;
    }
    </style>