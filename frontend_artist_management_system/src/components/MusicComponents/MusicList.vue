<template>
<div class="container" :class="{makeBlur:showAddForm===true || showEditForm===true || showDeleteForm===true || showImportForm===true}">
    <div class="artist-name-div">
        <p>{{artistName}}'s</p>
        <p> Songs</p>
    </div>

    <div class="song-container">
        <button class="add-song-button" @click="addSong">Add songs</button>

        <div class="song-card" v-for="item in songList" :key="item.id">
            <p>photo</p>
            <div class="song-card-footer">
                <div class="card-row">
                    <p class="label">title:</p>
                    <p>{{item.title}}</p>
                </div>
                <div class="card-row">
                    <p class="label">album:</p>
                    <p>{{item.album_name}}</p>
                </div>
                <div class="card-row">
                    <p class="label">genre:</p>
                    <p>{{item.genre}}</p>
                </div>
                <div class="card-row">
                    <p class="label" >created at:</p>
                    <p>{{item.created_at}}</p>
                </div>

                <div class="card-row">
                    <p class="label">updated at:</p>
                    <p>{{item.updated_at}}</p>
                </div>

                <div class="card-row">
                   <button @click="editSong(item.id)">edit</button>
                   <button @click="deleteSong(item.id,item.title)">delete</button>
                </div>
            </div>
        </div>

    </div>

        <button @click="importMusicCSV">Import Csv</button>
        <button @click="downloadMusicCSV">Download Csv</button>

</div>

   <div class="custom-popup">
       <AddMusicPage v-if="showAddForm" @closeForm="handleAddForm"/>
       <EditMusicPage v-if="showEditForm" :songID="songId" @closeForm="handleEditForm"/>
       <ConfirmDeletePopup v-if="showDeleteForm" @closeDeleteForm="handleDeleteform"
       :value="songName"/>
       <ImportMusicCSV v-if="showImportForm" @closeImportForm="handleImportForm"/>
   </div>

</template>

<script>
import axios from 'axios';

import AddMusicPage from '../MusicComponents/AddMusicPage.vue';
import EditMusicPage from '../MusicComponents/EditMusicPage.vue';
import ConfirmDeletePopup from '../ConfirmDeletePopup.vue';
import ImportMusicCSV from "@/components/CSVComponents/ImportMusicCSV.vue";
export default{
    components:{
      AddMusicPage,
      EditMusicPage,
      ConfirmDeletePopup,
      ImportMusicCSV,
    },
 data(){
  return{
     artistId:'',
    artistName:'',
     songList:[],
      showAddForm:false,
      showEditForm:false,
      songId:'',
      showDeleteForm:false,
      songName:'',
      showImportForm:false

  }
 },
    mounted(){
        // console.log(this.$route.params);
        this.artistId=this.$route.params.artistId;
        this.artistName=this.$route.params.artistName;
        axios.get('http://127.0.0.1:8000/api/get-musics/'+this.artistId).then((response)=>{
              console.log(response.data.data);
              this.songList=response.data.data;
        })

    },
    methods:{
        handleImportForm(value){
            if(value===true){
                this.showImportForm=false;
            }
        },
        handleDeleteform(value){
            console.log(value)
            if(value==='no'){
                this.showDeleteForm=false;
            }
            if(value==='yes'){
                 axios.delete('http://127.0.0.1:8000/api/delete-music/'+this.songId).then((response)=>{
                    console.log(response)
                })
                this.showDeleteForm=false;
            }
        },
        handleAddForm(value){
            if(value===true){
                this.showAddForm=false;
            }
        },
        handleEditForm(value){
            if(value===true){
                this.showEditForm=false;
            }
        },
        addSong(){
            // this.$router.push({
            //     path:'/add-music/'+this.artistId,
            // })
            this.showAddForm=true;
        },
        editSong(songId){
            // this.$router.push('/edit-music/'+songId)
            this.songId=songId
            console.log(this.songId)
            this.showEditForm=true;
        },
       async deleteSong(songId,songName){
            this.showDeleteForm=true;
            this.songId=songId;
            this.songName=songName;

        },
        importMusicCSV(){
            // this.$router.push('/import-music-csv');
            this.showImportForm=true;
        },
        downloadMusicCSV(){
            console.log('download')
            axios.get('http://127.0.0.1:8000/api/csv-download-music/'+this.artistId,{responseType:'blob'})
                .then((response)=>{
                    console.log(response.status);
                    const url=window.URL.createObjectURL(new Blob([response.data]));
                    const link=document.createElement('a');
                    link.href=url;
                    link.setAttribute('download','music.csv');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
            }).catch(error=>{
                console.log("error downloading",error);
                console.log(error.response.status)
                if(error.response.status===404){
                    console.log('no music to download')
                }
            })


        }
    }


}
</script>

<style scoped>
.container{
    padding:20px;
}
.artist-name-div{
 display:flex;
 gap:5px;
}
.song-container{
    //background-color:pink;
    display:flex;
    gap:20px;
    padding:40px;
    position:relative;

}
.song-card{
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    width:230px;
    border:1px solid pink;
    border-top-left-radius:40px;
    border-bottom-right-radius:40px;
    padding:10px;
}
.song-card-footer{
    //background-color:yellow;
}
.card-row{
    display:flex;
}
.label{
    min-width:80px;
    font-weight:bold;
}
.add-song-button{
    position:absolute;
    top:0;
    right:0;
}
.custom-popup{
    background-color:white;
    position:absolute;
    padding-left:10px;
    left:30%;
    top:30%;
}
.makeBlur{
    filter:blur(10px);
}
</style>