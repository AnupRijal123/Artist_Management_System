<template>
    <div class="form-div">

        <h1>Edit Artist</h1>
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
            <button @click="makeEdit" class="submit-button">Submit</button>
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
            artistInfo:{},
        }
    },
    mounted(){
      console.log(this.$route.params.id)
        axios.get('http://127.0.0.1:8000/api/get-single-artist/'+this.$route.params.id).then((response)=>{
            console.log(response.data.data);
            this.artistInfo=response.data.data;
            this.name=this.artistInfo.name;
            this.dob=this.artistInfo.dob;
            this.gender=this.artistInfo.gender;
            this.address=this.artistInfo.address;
            this.firstReleaseYear=this.artistInfo.first_release_year;
            this.noOfAlbumsReleased=this.artistInfo.no_of_albums_released;
        })

    },

    methods:{
         async makeEdit(){
             await axios.patch('http://127.0.0.1:8000/api/edit-artist/'+this.$route.params.id,{
                 name:this.name,
                 dob:this.dob,
                 gender:this.gender,
                 address:this.address,
                 first_release_year:this.firstReleaseYear,
                 no_of_albums_released:this.noOfAlbumsReleased
             }).then((response)=>{
                 console.log(response.data.status);
                 if(response.data.status==='success'){
                     this.$router.push('/dashboard')
                 }else{
                     console.log('error')
                 }

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