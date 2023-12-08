<template>
<div class="container">
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
                   <button @click="deleteSong(item.id)">delete</button>
                </div>

            </div>
        </div>
    </div>
</div>

</template>

<script>
import axios from 'axios';
export default{
 data(){
  return{
     artistId:'',
    artistName:'',
     songList:[],

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
        addSong(){
            this.$router.push({
                path:'/add-music/'+this.artistId,
            })
        },
        editSong(songId){
            this.$router.push('/edit-music/'+songId)
        },
       async deleteSong(songId){
            await axios.delete('http://127.0.0.1:8000/api/delete-music/'+songId).then((response)=>{
                console.log(response)
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
    border:1px solid red;
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
</style>