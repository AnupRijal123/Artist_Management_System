<template>
    <div class="content-container" :class="{makeBlur:showAddForm===true||showEditForm===true || showDeleteForm===true ||showArtistImportForm===true }">
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
                    <button class="add-button" @click="goToSongs(item.id,item.name)">list of songs</button>
                </div>
                <div class="table-cell action-button-cell">
                    <p @click="editArtist(item.id)">edit</p>
                    <p @click="deleteArtist(item.id,item.name)">delete</p>
                </div>
            </div>

        </div>

       <div class="csv-button-div">
           <button class="add-button" @click="importCSV">Import CSV</button>

           <button class="add-button" @click="downloadCSV">Download CSV</button>
       </div>


    </div>

    <div class="custom-popup">
        <AddArtistPage v-if="showAddForm" @closeForm="handleAddForm"/>
        <EditArtistPage v-if="showEditForm" :id="artistId" @closeForm="handleEditForm"/>
        <ConfirmDeletePopup v-if="showDeleteForm" @closeDeleteForm="handleDeleteForm" :value="artistName"/>
        <ImportArtistCSV v-if="showArtistImportForm" @closeImportForm="handleImportForm"/>
    </div>
</template>
<script>
import axios from 'axios';
import AddArtistPage from '../AddComponents/AddArtistPage.vue';
import EditArtistPage from '../EditComponents/EditArtistPage.vue';
import ConfirmDeletePopup from '../ConfirmDeletePopup.vue';
import ImportArtistCSV from '../CSVComponents/ImportArtistCSV.vue';

export default{
    components:{
      AddArtistPage,
      EditArtistPage,
      ConfirmDeletePopup,
      ImportArtistCSV,
    },
    data(){
        return{
            allArtist:[],
            showAddForm:false,
            showEditForm:false,
            artistId:'',
            showDeleteForm:false,
            artistName:'',
            showArtistImportForm:false

        }
    },
    mounted(){
        axios.get('http://127.0.0.1:8000/api/get-all-artist').then((response)=>{
            console.log(response.data.data);
            this.allArtist=response.data.data;
        })
    },

    methods:{
        handleImportForm(value){
            console.log(value);
            if(value===true){
                this.showArtistImportForm=false;
            }
        },
        handleDeleteForm(value){
                console.log(value)

            if(value==='no'){
                this.showDeleteForm=false;
            }
            if(value==='yes'){
                 axios.delete('http://127.0.0.1:8000/api/delete-artist/'+this.artistId);
                 this.showDeleteForm=false;
            }
        },
        handleAddForm(value){
            console.log(value);
            if(value===true){
                this.showAddForm=false;
            }
        },
        handleEditForm(value){
            if(value===true){
                this.showEditForm=false;
            }
        },
        addArtist(){
            console.log('add artist')
            this.showAddForm=true;
            // this.$router.push('/add-artist');
        },
        editArtist(id){
            // this.$router.push({
            //     path:'/edit-artist/'+id,
            //     params:id
            // })
            console.log(id);
            this.showEditForm=true;
            this.artistId=id;
        },
        async deleteArtist(id,artistName){
            this.showDeleteForm=true;
            this.artistId=id;
            this.artistName=artistName;

        },
        goToSongs(artistId,artistName){
            console.log(artistId,artistName)
            this.$router.push({
                path:'/music-list/'+artistId+'/'+artistName,
            });
        },
        importCSV(){
            // this.$router.push('/import-artist-csv')
            this.showArtistImportForm=true;
        },
        downloadCSV(){
            axios.get('http://127.0.0.1:8000/api/csv-download-artist',{responseType:'blob'})
                .then((response)=>{
                    console.log(response.data)
                    const url=window.URL.createObjectURL(new Blob([response.data]));
                    const link=document.createElement('a');
                    link.href=url;
                    link.setAttribute('download','artist.csv');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
            })
                .catch(error=>{
                    console.log("error downloading",error);
                })
        }
    }
}

</script>

<style scoped> 

.heading-row{
    display:flex;
    justify-content:space-between;
    background-color:#ccc;
    padding-top:20px;
    padding-bottom:20px;
}
.table-cell{
    width:150px;
    display:flex;
    align-items:center;
    padding:10px;
    justify-self: auto;
    height:auto;
    overflow:auto;
    
}
.table-body-row{
    display:flex;
    justify-content:space-between;
    border-bottom:1px solid #ccc;
}
.action-button-cell{
    display:flex;
    gap:10px;
}
.add-button{
    width:150px;
    color:black;
    border:none;
    padding:15px 20px;
    border-radius:10px;
    font-size:14px;
}
.content-container{
    display:flex;
    flex-direction:column;
    gap:20px;
}
.custom-popup{
    background-color:white;
    position:absolute;
    padding-left:10px;
}
.makeBlur{
    filter:blur(10px);
}
.heading-row .table-cell{
    font-weight:bold;
}
.csv-button-div{
    display:flex;
    justify-content:flex-end;
    gap:20px;
}
</style>