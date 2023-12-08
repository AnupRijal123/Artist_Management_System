import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../components/HomePage';
import LoginPage from '../components/LoginPage';
import RegisterPage from '../components/RegisterPage';
import DashboardPage from '../components/DashboardPage';

import AddUserPage from '../components/AddComponents/AddUserPage';
import AddArtistPage from '../components/AddComponents/AddArtistPage';
import EditArtistPage from '../components/EditComponents/EditArtistPage.vue';
import EditUserPage from '../components/EditComponents/EditUserPage.vue';
import MusicList from '../components/MusicComponents/MusicList.vue';
import AddMusicPage from "@/components/MusicComponents/AddMusicPage.vue";
import EditMusicPage from '../components/MusicComponents/EditMusicPage.vue';

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
    component:DashboardPage
  },

  {
    path:'/add-user',
    component:AddUserPage
  },

  {
    path:'/add-artist',
    component:AddArtistPage
  },

  {
    path:'/edit-artist/:id',
    component:EditArtistPage
  },

  {
    path:'/edit-user/:id',
    component:EditUserPage
  },

  {
    path:'/music-list/:artistId/:artistName/',
    component:MusicList
  },

  {
    path:'/add-music/:artistId',
    component:AddMusicPage
  },

  {
    path:'/edit-music/:musicId',
    component:EditMusicPage
  }


 
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
