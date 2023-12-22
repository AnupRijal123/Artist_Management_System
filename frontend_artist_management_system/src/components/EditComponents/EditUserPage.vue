<template>
    <div class="form-div">
        <div @click="closeForm" class="close-button">
            X
        </div>

        <h1>Edit User</h1>

        <div class="row">
            <p>first name</p>
            <input type="text" v-model="firstName">
        </div>

        <div class="row">
            <p>last name</p>
            <input type="text" v-model="lastName">
        </div>

        <div class="row">
            <p>email</p>
            <input type="text" v-model="email">
        </div>

        <div class="row">
            <p>password</p>
            <input type="text" v-model="password">
        </div>

        <div class="row">
            <p>phone</p>
            <input type="text" v-model="phone">
        </div>

        <div class="row">
            <p>dob</p>
            <input type="date" v-model="dob">
        </div>

        <div class="row">
            <p>gender</p>

            <select v-model="gender">
                <option value="m">m</option>
                <option value="f">f</option>
                <option value="o">o</option>
            </select>

        </div>

        <div class="row">
            <p>address</p>
            <input type="text" v-model="address">
        </div>

        <div class="footer-div">
            <button @click="editUser" class="submit-button">submit</button>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default{
  props:['id'],
    data(){
        return{
            firstName:'',
            lastName:'',
            email:'',
            password:'',
            phone:'',
            dob:'',
            gender:'',
            address:'',
            userInfo:{},
        }
    },
    async mounted(){
        console.log(localStorage.getItem('token'))
        // console.log(this.$route.params.id);
        console.log(this.id);
       await axios.get('http://127.0.0.1:8000/api/get-single-user/'+this.id,{
           params:{
               token:localStorage.getItem('token')
           }
       }).then((response)=>{
          console.log(response.data.data)
            this.userInfo=response.data.data
            this.firstName=this.userInfo.first_name
            this.lastName=this.userInfo.last_name
            this.email=this.userInfo.email
            this.phone=this.userInfo.phone;
            this.dob=this.userInfo.dob;
            this.gender=this.userInfo.gender;
            this .address=this.userInfo.address;

        })

    },
    methods:{
        closeForm(){
            this.$emit('close-form',true);
        },
        async editUser(){
           await axios.patch('http://127.0.0.1:8000/api/edit-user/'+this.id,{
                first_name:this.firstName,
                last_name:this.lastName,
                email:this.email,
                password:this.password,
                phone:this.phone,
                dob:this.dob,
                gender:this.gender,
                address:this.address,
            },{
               params:{
                   token:localStorage.getItem('token')
               }
           }).then((response)=>{
                console.log(response);
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
    width:150px;
    color:black;
    border:none;
    padding:15px 20px;
    border-radius:10px;
    font-size:14px;
}
.close-button{
    position:absolute;
    right:0;
    top:-10px;
    cursor:pointer;
    color:red;
}
</style>