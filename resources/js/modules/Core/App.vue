
<template>
  <LoadingComponent/>
  <template v-if="store.isLogin">
    <template v-if="globalStore.accept_status === 200">
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
    <template v-else-if="globalStore.accept_status === 403">
      <Forbidden />
    </template>
    <template v-else>
      <NotFound />
    </template>
  </template>
  <template v-else>
    <RouterView></RouterView>
  </template>
</template>

<script setup>
import { RouterView } from 'vue-router';
import TheHeader from './layouts/TheHeader.vue';
import TheSideBar from './layouts/TheSideBar.vue';
import TheFooter from './layouts/TheFooter.vue';
import NotFound from "./errors/NotFound.vue";
import Forbidden from "./errors/Forbidden.vue";
import { onMounted, ref } from "vue";
import toastHelper from './helpers/toastHelper';
import LoadingComponent from "~/Core/components/LoadingComponent.vue";
import { useAuthStore } from '~/User/store/authStore';
import { useSettingStore } from '~/Setting/store/settingStore';
import { useGlobalStore } from './stores/globalStore';


const store = useAuthStore();
const settingStore = useSettingStore();
const globalStore = useGlobalStore();

onMounted(async () => {
  window.addEventListener("offline", () => {
    toastHelper.error("Có vẻ bạn đã mất internet");
  });
  window.addEventListener("online", () => {
    toastHelper.success("Internet đã quay trở lại");
  });

  // Echo.join(`notifications`)
  //   .here((users) => {
  //       console.log(users);
  //   })
  //   .joining((user) => {
  //       console.log(user);
  //   })
  //   .leaving((user) => {
  //       console.log(user);
  //   })
  //   .error((error) => {
  //       console.error(error);
  //   });

  Echo.channel(`presence-notifications`)
    .listen('.notifications', (event) => {
      if (document.visibilityState == "visible"){
        toastHelper.success(event.title);
      }
      else{
        const data = {
          body: event.data.name
        }
        toastHelper.showNotification(event.title, data);
      }
    });
    
  if(!settingStore.getSettings().name){
    await settingStore.setSettings();
  }
})
</script>


<style>
.content-wrapper {
  background-color: #ffffff;
}
</style>
