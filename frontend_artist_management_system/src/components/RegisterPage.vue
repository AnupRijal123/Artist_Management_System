<template>
    <div class="form-div">
        <div class="message-div" v-if="error">
            <p class="close-button" @click="closeMessage">close</p>
            <p>{{ error }}</p>
        </div>

        <h1>REGISTER FORM</h1>

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
            <input type="email" v-model="email">
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
        <button @click="makeRegistration" class="submit-button">Submit</button>
        <p>Already have account?</p> <router-link to="/login" >Click here to Login</router-link>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
export default{
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
            error:''
        }
    },
    methods:{
       async makeRegistration(){

           await axios.post('http://127.0.0.1:8000/api/auth/register-user',{
              first_name:this.firstName,
              last_name:this.lastName,
              email:this.email,
              password:this.password,
              phone:this.phone,
              dob:this.dob,
              gender:this.gender,
              address:this.address,
            }).then((response)=>{
                console.log(response);
                if(response.data.status==='error'){
                    console.log(response.data.message)
                    this.error=response.data.message;
                }else{
                    console.log(response.data.message);
                    this.error=response.data.message;
                }

            }).catch(function(error){
                if(error.response.status===500){
                    console.log('empty');
                }
               }
           )

        },
        closeMessage(){
           this.error=false;
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
.message-div{
    background-color: #94db94;
    display:flex;
    justify-content:center;
    padding:10px;
    opacity:70%;
    position:relative;
    color:red;
}
.close-button{
    position:absolute;
    right:0;
    top:-10px;
    cursor:pointer;
    color:red;
}
</style>