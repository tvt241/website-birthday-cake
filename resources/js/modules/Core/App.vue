<script setup>
import { RouterView } from 'vue-router';
import TheHeader from './layouts/TheHeader.vue';
import TheSideBar from './layouts/TheSideBar.vue';
import TheFooter from './layouts/TheFooter.vue';
</script>

<template>
  <div class="navbar-fixed sidebar-fixed" id="body">
    <div class="wrapper">
      <TheSideBar></TheSideBar>
      <div class="page-wrapper">
        <TheHeader></TheHeader>
        <div class="content-wrapper">
          <div class="content">
            <RouterView></RouterView>
          </div>
        </div>
        <TheFooter></TheFooter>
      </div>
    </div>
  </div>
</template>

<style>
  .content-wrapper{
    background-color: #ffffff;
  }
</style>
