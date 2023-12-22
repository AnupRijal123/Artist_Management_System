<template>
    <div class="form-div">
        <div @click="closeForm" class="close-button">
            X
        </div>
        <h1>Add Music</h1>

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
            <button @click="addSong" class="submit-button">Add</button>
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
          genre:''

      }
    },
    mounted(){
        console.log(this.$route.params)

    },
    methods:{
        closeForm(){
            this.$emit('close-form',true);
        },
        addSong(){
            axios.post('http://127.0.0.1:8000/api/add-music/'+ this.$route.params.artistId,{
                artist_id:this.$route.params.artistId,
                title:this.title,
                album_name:this.albumName,
                genre:this.genre,
            }).then((response)=>{
                console.log(response)
                if(response.data.status==='success'){
                    console.log('success')


                }
            })
          this.closeForm();
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
.close-button{
    position:absolute;
    right:0;
    top:-10px;
    cursor:pointer;
    color:red;
}
</style>