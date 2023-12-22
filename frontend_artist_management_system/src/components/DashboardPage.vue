<template>
    <div class="main-container">

            <div class="sidebar">
                <p style="color:white;">= </p>

               <div class="sidebar-button-div">
                   <button class="sidebar-button" @click="goToHome">Home</button>
               </div>

                <div class="tab-div">
                <div class="tab-button" :class="{'active-tab':isUserTab}" @click="showUserTab">User</div>
                <div class="tab-button" :class="{'active-tab':isArtistTab}" @click="showArtistTab">Artist</div>
                </div>

                <div class="sidebar-button-div">
                    <button class="sidebar-button" title="Logout" @click="makeLogout">Logout</button>
                </div>

            </div>
           

            <div class="content-div">
<!--                <UserTab v-if="isUserTab"/>-->
<!--                <ArtistTab v-if="isArtistTab"/>-->
                <h1 v-if="$route.path === '/dashboard'">Welcome to dashboard</h1>
                <router-view></router-view>
            </div>
    </div>   
</template>

<script>
export default{
    data(){
        return{
            isUserTab:false,
            isArtistTab:false,
            showDashboardMessage:false,
            routePath:''
        }
    },
    methods:{
        goToHome(){
            this.$router.push('/dashboard');
        },
        showUserTab(){
            this.isUserTab=true;
            this.isArtistTab=false;

            this.$router.push('/dashboard/user');
            
        },
        showArtistTab(){
            this.isArtistTab=true;
            this.isUserTab=false;
            this.$router.push('/dashboard/artist');
        },
        makeLogout(){
            localStorage.removeItem('token');
            this.$router.push('/');
            console.log(localStorage.getItem('token'))
        }
    },

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

.tab-div{
    display:flex;
    gap:20px;
    justify-content:center;
    flex-direction:column;
    //background-color:rgb(237, 213, 217);
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
.sidebar:hover .tab-button{
    display:block;
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

.sidebar-button-div{
    position:absolute;
    right:0;
}
.sidebar-button{
    //background-color:#80976d;
    color:black;
    border:none;
    padding:10px;
    border-radius:9px;
    cursor:pointer;
    display:none;
}
.sidebar:hover .sidebar-button{
    display:block;
}
</style>