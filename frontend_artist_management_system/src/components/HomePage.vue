<template>
    <h1>Artist Management System Home Page</h1>
<div class="link-div">
    <router-link to="/login">Login</router-link>
    <router-link to="/register">Register</router-link>
</div>
</template>

<style scoped>
h1{
    text-align:center;
}
.link-div{
    display:flex;
    justify-content:center;
    gap:100px;
    padding-top:50px;
}

</style>