<template>
    <div class="content-container" :class="{makeBlur:showAddForm===true || showEditForm===true ||showDeleteForm===true}">
       
       <button class="add-button" @click="addUser">Add New User</button>

        <div class="table-div">

            <div class="heading-row"> 
                <div class="table-cell">First Name</div>
                <div class="table-cell">Last Name</div>
                <div class="table-cell">Email</div>
                <div class="table-cell">Phone</div>
                <div class="table-cell">Dob</div>
                <div class="table-cell">Age</div>
                <div class="table-cell">Gender</div>
                <div class="table-cell">Address</div>
                <div class="table-cell"></div>
            </div>

            <div class="table-body-row" v-for="item in usersList" :key="item.id">
                <div class="table-cell">{{ item.first_name }}</div>
                <div class="table-cell">{{ item.last_name }}</div>
                <div class="table-cell">{{item.email}}</div>
                <div class="table-cell">{{item.phone}}</div>
                <div class="table-cell">{{item.dob}}</div>
                <div class="table-cell">{{item.age}}</div>
                <div class="table-cell">{{item.gender}}</div>
                <div class="table-cell">{{item.address}}</div>
                <div class="table-cell action-button-cell">
                    <p @click="editUser(item.id)">edit</p>
                    <p @click="deleteUser(item.id,item.first_name)">delete</p>
                </div>
            </div>

        </div>


    </div>

   <transition>
       <div class="custom-popup">
           <AddUserPage v-if="showAddForm" @closeForm="handleAddForm"/>
           <EditUserPage v-if="showEditForm" :id="userId" @closeForm="handleEditForm"/>
           <ConfirmDeletePopup v-if="showDeleteForm" :value="username" @closeDeleteForm="handleDeleteForm"/>
       </div>
   </transition>

</template>

<script>
import axios from 'axios';
import AddUserPage from '../AddComponents/AddUserPage.vue';
import EditUserPage from '../EditComponents/EditUserPage.vue';
import ConfirmDeletePopup from '../ConfirmDeletePopup.vue';
import {genderConstant} from '../../constants';
export default{
    components:{
        AddUserPage,
        EditUserPage,
        ConfirmDeletePopup
    },
    data(){
        return{
            usersList:[],
            age:null,
            currentYear:'',
            showAddForm:false,
            showEditForm:false,
            showDeleteForm:false,
            userId:'',
            username:'',
            firstNameArray:[],
        }
    },
    async mounted(){

        console.log(genderConstant)
        const userToken=localStorage.getItem('token');
        this.getCurrentDate();

         await axios.get('http://127.0.0.1:8000/api/get-all-users',{
             params:{
                 token:userToken
             }
         }).then((response)=>{
            this.usersList=response.data.data
             console.log(this.usersList)
             for(let i=0;i<this.usersList.length;i++){
                 // console.log(this.usersList[i].dob);

                 ///////////age calculation////////////////
                 const dateFromApi=this.usersList[i].dob;
                 const stringToDate=new Date(dateFromApi);
                 const userDobYear=stringToDate.getFullYear();

                 this.usersList[i].age=this.currentYear-userDobYear;

                 // console.log(this.usersList[i].email);

                 //////////////////////////////////////email encryption/////////////
                 const firstPartEmail=this.usersList[i].email.split('@');
                 // console.log(separatedEmail);

                 const beforeAt=firstPartEmail[0];  // @ agadi ko part
                 const afterAt=firstPartEmail[1];   // @ paxadi ko part

                 const beforeAtBeforeOneCharacter=beforeAt.substring(0,2);
                 const beforeAtAfterOneCharacter=beforeAt.substring(2);
                 // console.log(beforeAtAfterOneCharacter,'asdasdasd')

                 const encrptedBeforeAt= beforeAtBeforeOneCharacter + beforeAtAfterOneCharacter.replace(/./g,'x');
                 // console.log(encrptedBeforeAt);

                 const secondPartEmail=afterAt.split('.')
                 // console.log(secondPartEmail)

                 const beforeDot=secondPartEmail[0];
                 const afterDot=secondPartEmail[1];

                 const encryptedBeforeDot=beforeDot.replace(/./g,'x')
                 // console.log(encryptedBeforeDot)

                 this.usersList[i].email=encrptedBeforeAt+'@'+encryptedBeforeDot+'.'+'com'

                 // console.log(this.usersList);

                 //////////////////////////////////////////////phone encryption
                 console.log(this.usersList[i].phone)

               // console.log(  this.usersList[i].phone.substring(2));
                 const phoneFirstPart=this.usersList[i].phone.substring(0,3);
                 const phoneSecondPart=this.usersList[i].phone.substring(3);

                 // console.log(phoneFirstPart);
                 const encrpytedPhoneSecondPart=phoneSecondPart.replace(/./g,'x')

                 const encryptedPhone=phoneFirstPart+encrpytedPhoneSecondPart;
                 console.log(encryptedPhone);

                 this.usersList[i].phone=encryptedPhone;


                 /////////////////////// gender mapping
                 const genderFromApi=this.usersList[i].gender;
                 console.log(genderConstant[genderFromApi]);
                 this.usersList[i].gender=genderConstant[genderFromApi];



                 console.log(this.usersList[i].first_name);

                this.firstNameArray.push(this.usersList[i].first_name);

                console.log(this.firstNameArray);

                console.log(this.firstNameArray.sort());



             }

        })


    },

    methods:{
        handleDeleteForm(value){
            if(value==='no'){
                this.showDeleteForm=false;
            }
            if(value==='yes'){
                console.log('yes')
                axios.delete('http://127.0.0.1:8000/api/delete-user/'+this.userId,{
                    params:{
                        token:localStorage.getItem('token')
                    }
                }).then((response)=>{
                    console.log(response)
                })
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

        getCurrentDate(){
          console.log('test')
            const currentDate=new Date();
          this.currentYear=currentDate.getFullYear();
          console.log(this.currentYear);

        },
        addUser(){
            console.log('adduser');
            this.showAddForm=true;

        },
        editUser(id){
            console.log(id);
            this.userId=id;
            this.showEditForm=true;
            // this.$router.push('/edit-user/'+id);
        },
        deleteUser(userid,username){
            this.userId=userid
            this.username=username;
            this.showDeleteForm=true
            // console.log(this.userId,this.username)
        }
    }
}

</script>

<style scoped> 


.heading-row{
    display:flex;
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
    border-bottom:1px solid #ccc;
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
    width:150px;
    color:black;
    border:none;
    padding:15px 20px;
    border-radius:10px;
    font-size:14px;
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
</style>