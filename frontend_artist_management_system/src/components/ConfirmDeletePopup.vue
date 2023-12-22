<template>
    <div class="container">
        <div class="delete-content">
            <h3>Are you Sure you want to delete {{value}} ?</h3>
            <div class="button-div">
                <button @click="closeDeletePopup('yes')">Yes</button>
                <button @click="closeDeletePopup('no')">No</button>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['value'],
    methods:{
        closeDeletePopup(value){
            this.$emit('close-delete-form',value);

        }
    }
}
</script>

<style scoped>
.container{
    display:flex;
    justify-content:center;
}
.delete-content{
    display:flex;
    flex-direction:column;
}
.button-div{
    display:flex;
    justify-content:center;
    gap:20px;
}
</style>
