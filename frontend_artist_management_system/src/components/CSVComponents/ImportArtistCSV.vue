<template>
    <div class="form-div">
        <div @click="closeForm" class="close-button">
            X
        </div>

        <h1>Import Artist CSV</h1>

        <div class="row">
            <p>File</p>
            <input type="file"  accept=".csv" @change="handleFileChange">
        </div>



        <div class="footer-div">
            <button @click="importCSV" class="submit-button">Import</button>
        </div>
    </div>

</template>

<script>
import axios from 'axios'
export default{
    data(){
      return{
          selectedFile:null,
      }
    },

    methods:{
        closeForm(){
            this.$emit('close-import-form',true);
        },
        handleFileChange(event){
            this.selectedFile=event.target.files[0];
            console.log(this.selectedFile);
        },
        async importCSV(){
            const formData=new FormData();
            formData.append('file',this.selectedFile)

            await axios.post('http://127.0.0.1:8000/api/csv-import-artist', formData,{
                headers:{
                    'Content-Type':'multipart/form-data',
                }
            }
               ).then((response)=>{
                console.log(response)
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
    background-color:#80976d;
    border:none;
    padding:10px;
    color:white;
}
.close-button{
    position:absolute;
    right:0;
    top:-10px;
    cursor:pointer;
    color:red;
}
</style>