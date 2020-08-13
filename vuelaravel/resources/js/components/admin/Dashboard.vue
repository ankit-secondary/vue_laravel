<template>
    <div class="container">
        
       <h1 class="text-center">
           <b> Welcome Admin</b>
        </h1>
        
        <div id="content">
            
      <userList></userList>
            
        </div>
    </div>
</template>
<script>
  import userList from '../../components/user-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
    }
  }
</script>