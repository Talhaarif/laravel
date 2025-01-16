<template>
  <div class="dashboard">
    <Sidebar />
    <div class="main-content">
      <Header />
      <div class="content-div">
        <router-view />
      </div>
    
    </div>
  </div>
</template>

<script>
import Sidebar from './Sidebar.vue';
import Header from './Header.vue';

export default {
  components: {
    Sidebar,
    Header,
  },
};
</script>

<style scoped>
.dashboard {
  display: flex;
  min-height: 100vh;
}
.content-div{
  padding: 20px 40px;
}
.main-content {
  flex: 1;
  background: #222;
}
</style>
