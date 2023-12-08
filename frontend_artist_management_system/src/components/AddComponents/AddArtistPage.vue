<template>
    <div class="form-div">

        <h1>Add Artist</h1>

        <div class="row">
            <p>Name</p>
            <input type="text" v-model="name">
        </div>

        <div class="row">
            <p>DOB</p>
            <input type="date" v-model="dob">
        </div>

       <div class="row">
            <p>Gender</p>
    
            <select v-model="gender">
                <option value="m">m</option>
                <option value="f">f</option>
                <option value="o">o</option>
            </select>
        
        </div>

        <div class="row">
            <p>Address</p>
            <input type="text" v-model="address">
        </div>



         <div class="row">
            <p>First Release Year</p>
            <input type="date" v-model="firstReleaseYear">
        </div>

         <div class="row">
            <p>No of Album</p>
            <input type="text" v-model="noOfAlbumsReleased">
        </div>

        



        <div class="footer-div">
        <button @click="addArtist" class="submit-button">Add</button>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
export default{
    data(){
        return{
            name:'',
            dob:'',
            gender:'',
            address:'',
            firstReleaseYear:'',
            noOfAlbumsReleased:'',
        }
    },

    methods:{
       async addArtist(){
            await axios.post('http://127.0.0.1:8000/api/register-artist',{
                name:this.name,
                dob:this.dob,
                gender:this.gender,
                address:this.address,
                first_release_year:this.firstReleaseYear,
                no_of_albums_released:this.noOfAlbumsReleased,
            }).then((response)=>{
                console.log(response)
            }).catch(function (error){
                console.log(error)
            })
        },

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