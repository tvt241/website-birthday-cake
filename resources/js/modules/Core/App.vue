
<template>
  <LoadingComponent/>
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

<script setup>
import { RouterView } from 'vue-router';
import TheHeader from './layouts/TheHeader.vue';
import TheSideBar from './layouts/TheSideBar.vue';
import TheFooter from './layouts/TheFooter.vue';
import { onMounted } from "vue";
import toastHelper from './helpers/toastHelper';
import LoadingComponent from "~/Core/components/LoadingComponent.vue";
import { provide } from 'vue';

onMounted(() => {
  window.addEventListener("offline", () => {
    toastHelper.error("Có vẻ bạn đã mất internet");
  });
  window.addEventListener("online", () => {
    toastHelper.success("Internet đã quay trở lại");
  });

  // window.addEventListener("visibilitychange", () => {
  //   if (document.visibilityState == "visible"){
  //     toastHelper.success("Chào mừng trở lại");
  //   }
  // });
})
</script>


<style>
.content-wrapper {
  background-color: #ffffff;
}
</style>
