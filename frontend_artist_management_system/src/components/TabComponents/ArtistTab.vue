<template>
    <div class="content-container">
       <button class="add-button" @click="addArtist">Add new Artist</button>
        <div class="table-div">
            <div class="heading-row"> 
                <div class="table-cell">Name</div>
                <div class="table-cell">DOB</div>
                <div class="table-cell">Gender</div>
                <div class="table-cell">Address</div>
                <div class="table-cell">First Release Year</div>
                <div class="table-cell">No of Album Released</div>
                <div class="table-cell">Go to songs</div>

                <div class="table-cell"></div>
            </div>

            <div class="table-body-row" v-for="item in allArtist" :key="item.id">
                <div class="table-cell">{{item.name}}</div>
                <div class="table-cell">{{item.dob}}</div>
                <div class="table-cell">{{item.gender}}</div>
                <div class="table-cell">{{item.address}}</div>
                <div class="table-cell">{{item.first_release_year}}</div>
                <div class="table-cell">{{item.no_of_albums_released}}</div>
                <div class="table-cell">
                    <button @click="goToSongs(item.id,item.name)">list of songs</button>
                </div>
                <div class="table-cell action-button-cell">
                    <p @click="editArtist(item.id)">edit</p>
                    <p @click="deleteArtist(item.id)">delete</p>
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
            allArtist:[],
        }
    },
    mounted(){
        axios.get('http://127.0.0.1:8000/api/get-all-artist').then((response)=>{
            console.log(response.data.data);
            this.allArtist=response.data.data;
        })
    },

    methods:{
        addArtist(){
            console.log('add artist')
            this.$router.push('/add-artist');
        },
        editArtist(id){
            this.$router.push({
                path:'/edit-artist/'+id,
                params:id
            })
        },
        async deleteArtist(id){
          await  axios.delete('http://127.0.0.1:8000/api/delete-artist/'+id);
        },
        goToSongs(artistId,artistName){
            console.log(artistId,artistName)
            this.$router.push({
                path:'/music-list/'+artistId+'/'+artistName,
            });
        }
    }
}

</script>

<style scoped> 

.heading-row{
    display:flex;
    justify-content:space-between;
}
.table-cell{
    min-width:100px;
    border:1px solid black;
    display:flex;
    justify-content:center;
    align-items:center;
    width:100px;
    padding:5px;
    
}
.table-body-row{
    display:flex;
    justify-content:space-between;
}
.action-button-cell{
    display:flex;
    gap:10px;
}
.add-button{
    width:120px;
    background-color:#80976d;
    color:white;
    border:none;
    padding:10px;
}
.content-container{
    display:flex;
    flex-direction:column;
    gap:20px;
}
</style>