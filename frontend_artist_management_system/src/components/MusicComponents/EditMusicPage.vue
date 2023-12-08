<template>
    <div class="form-div">

        <h1>Edit Music</h1>

        <div class="row">
            <p>Title</p>
            <input type="text" v-model="title">
        </div>

        <div class="row">
            <p>Album Name</p>
            <input type="text" v-model="albumName">
        </div>

        <div class="row">
            <p>Genre</p>

            <select v-model="genre">
                <option value="rnb">rnb</option>
                <option value="country">country</option>
                <option value="classic">classic</option>
                <option value="rock">rock</option>
                <option value="jazz">jazz</option>
            </select>

        </div>



        <div class="footer-div">
            <button @click="editSong" class="submit-button">Submit</button>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
export default{
    data(){
        return{
            title:'',
            albumName:'',
            genre:'',


        }
    },
    async mounted(){
      console.log(this.$route.params)
       await axios.get('http://127.0.0.1:8000/api/get-single-music/'+this.$route.params.musicId).then((response)=>{
           console.log(response.data.data);
           this.title=response.data.data.title;
           this.albumName=response.data.data.album_name;
           this.genre=response.data.data.genre;


        })
    },
    methods:{
       async editSong(){
            await axios.patch('http://127.0.0.1:8000/api/edit-music/'+this.$route.params.musicId,{
                title:this.title,
                album_name:this.albumName,
                genre:this.genre,
            }).then((response)=>{
                console.log(response)
            })
        }
    }
}

</script>

<style scoped>
.form-div{
    margin:auto;
    min-width:500px;
    width:500px;
    border-bottom:2px solid black;
    padding-bottom:20px;
    margin-top:100px;

}
.row{
    display:flex;
    height:50px;
    align-items:center;
}

.row p{
    min-width:100px;
}
input{
    border-radius:6px;
}

.footer-div{
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:20px;
}
.submit-button{
    background-color:#80976d;
    border:none;
    padding:10px;
    color:white;
}
</style>