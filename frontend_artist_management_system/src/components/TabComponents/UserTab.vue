<template>
    <div class="content-container">
       
       <button class="add-button" @click="addUser">Add New User</button>

        <div class="table-div">

            <div class="heading-row"> 
                <div class="table-cell">First Name</div>
                <div class="table-cell">Last Name</div>
                <div class="table-cell">Email</div>
                <div class="table-cell">Password</div>
                <div class="table-cell">Phone</div>
                <div class="table-cell">Dob</div>
                <div class="table-cell">Gender</div>
                <div class="table-cell">Address</div>
                <div class="table-cell"></div>
            </div>

            <div class="table-body-row" v-for="item in usersList" :key="item.id">
                <div class="table-cell">{{ item.first_name }}</div>
                <div class="table-cell">{{ item.last_name }}</div>
                <div class="table-cell">{{item.email}}</div>
                <div class="table-cell">{{item.password}}</div>
                <div class="table-cell">{{item.phone}}</div>
                <div class="table-cell">{{item.dob}}</div>
                <div class="table-cell">{{item.gender}}</div>
                <div class="table-cell">{{item.address}}</div>
                <div class="table-cell action-button-cell">
                    <p @click="editUser(item.id)">edit</p>
                    <p @click="deleteUser(item.id)">delete</p>
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
            usersList:[],
        }
    },
    async mounted(){
        console.log('hekko')
        await axios.get('http://127.0.0.1:8000/api/get-all-users').then((response)=>{
            this.usersList=response.data.data
             console.log(this.usersList)

        })
    },
    methods:{
        addUser(){
            console.log('adduser');
            this.$router.push('/add-user')
        },
        editUser(id){
            console.log(id);
            this.$router.push('/edit-user/'+id);
        },
        deleteUser(id){
            console.log(id);
        }
    }
}

</script>

<style scoped> 


.heading-row{
    display:flex;
}
.table-cell{
    width:100px;
    border:1px solid black;
    display:flex;
    align-items:center;
    padding:5px;
    justify-self: auto;
    height:auto;
}
.table-body-row{
    display:flex;
}
.action-button-cell{
    display:flex;
    gap:10px;
}
.content-container{
    display:flex;
    flex-direction:column;
    gap:20px;
}
.add-button{
    width:120px;
    background-color:#80976d;
    color:white;
    border:none;
    padding:10px;
}
</style>