<template>
    <div class="main-container">

        <div class="logout-div">
            <button class="logout-button" @click="makeLogout">Logout</button>
        </div>

            <div class="sidebar">
                <p style="color:white;">= </p>
               
                <div class="tab-div">
                <div class="tab-button" :class="{'active-tab':isUserTab}" @click="showUserTab">User</div>
                <div class="tab-button" :class="{'active-tab':isArtistTab}" @click="showArtistTab">Artist</div>
                </div>
                
            </div>
           

            <div class="content-div">
                <UserTab v-if="isUserTab"/>
                <ArtistTab v-if="isArtistTab"/>
                <h1 v-if="!isUserTab&&!isArtistTab" >Welcome to dashboard</h1>
            </div>
    </div>   
</template>

<script>
import UserTab from '../components/TabComponents/UserTab.vue';
import ArtistTab from '../components/TabComponents/ArtistTab.vue'; 
export default{
    components:{
        UserTab,
        ArtistTab,
    },
    data(){
        return{
            isUserTab:false,
            isArtistTab:false,
        }
    },
    methods:{
        showUserTab(){
            this.isUserTab=true;
            this.isArtistTab=false;
            
        },
        showArtistTab(){
            this.isArtistTab=true;
            this.isUserTab=false;
        },
        makeLogout(){
            this.$router.push('/')
        }
    }

}
</script>




<style scoped>



.content-div{
    display:flex;
    justify-content:center;
    padding-top:150px;
    
}

.sidebar{
    width:20px;
    transition:width 0.2s ease;
    background-color:#1c305c;
    position:fixed;
    height:100vh;
}
.sidebar:hover{
    width:140px;
    height:100vh;

}

.sidebar:hover .tab-button{
    display:block;
}

.tab-div{
    display:flex;
    gap:20px;
    justify-content:center;
    flex-direction:column;
    background-color:rgb(237, 213, 217);
    padding-top:80px;
    align-items:center;
    padding-bottom:80px;
}

.tab-button{
    background-color:white;
    padding:10px; 
    border:2px solid black;
    color:black;
    border-radius:8px;
    min-width:80px;
    width:80px;
    text-align:center;
    cursor:pointer;
    display:none;
}
.tab-button:hover{
    background-color:rgb(208, 206, 206)
}
.active-tab{
    background-color:#80976d;
    border:none;
    color:white;
}
.active-tab:hover{
    background-color:#80976d;
}

.main-container{
    position:relative;
}

.logout-div{
    position:absolute;
    right:0;
}
.logout-button{
    background-color:#80976d;
    color:white;
    border:none;
    padding:10px;
    border-radius:9px;
    cursor:pointer;
}
</style>