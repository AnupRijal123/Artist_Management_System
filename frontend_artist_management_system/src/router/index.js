import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../components/HomePage';
import LoginPage from '../components/LoginPage';
import RegisterPage from '../components/RegisterPage';
import DashboardPage from '../components/DashboardPage';

import MusicList from '../components/MusicComponents/MusicList.vue';

import UserTab from '../components/TabComponents/UserTab.vue'
import ArtistTab from '../components/TabComponents/ArtistTab.vue';


const routes = [
  {
    path:'/',
    component:HomePage 
  },
  {
    path:'/login',
    component:LoginPage
  },

  {
    path:'/register',
    component:RegisterPage
  },

  {
    path:'/dashboard',
    component:DashboardPage,
    children:[
      {
        path:'user',
        component:UserTab,
      },
      {
        path:'artist',
        component:ArtistTab,
      },
      {
        path:'/music-list/:artistId/:artistName/',
        component:MusicList
      },

    ]
  },




 
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
