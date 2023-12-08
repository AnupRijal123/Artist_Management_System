<template>
    <div class="form-div">
    <div class="message-div" v-if="error">
        <p @click="closeMessage" class="close-button">close</p>
        {{error}}
    </div>

        <h1>LOGIN FORM</h1>

        <div class="row">
            <p>email</p>
            <input type="email" v-model="email">
        </div>

        <div class="row">
            <p>password</p>
            <input type="password" v-model="password">
        </div>

        <div class="footer-div">
            <button @click="makeLogin" class="submit-button">Submit</button>

        <p>Don't have account?</p> <router-link to="/register" >Click here to Register</router-link>
        </div>
    </div>

</template>

<script>
import axios from 'axios'

export default{
    data(){
      return{
          email:'',
          password:'',
          error:''
      }
    },

    methods:{

        makeLogin(){
            console.log('hwllo')
            axios.post('http://127.0.0.1:8000/api/login',{
                email:this.email,
                password:this.password,
            }).then((response)=>{
                console.log(response);
                   if(response.data.status==='success'){
                       console.log(response.data.message)
                       this.error=response.data.message;
                       this.$router.push('/dashboard');
                   }else{
                       console.log(response.data.message)
                       this.error=response.data.message;
                   }

            }).catch(error=>{
                console.log('error occured',error)
            })
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
    margin-top:200px;
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