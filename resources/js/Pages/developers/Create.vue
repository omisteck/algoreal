<template>
    <layout>
        <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header __web-inspector-hide-shortcut__">
                        <h2 class="header-title">Welcome</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                                <a class="breadcrumb-item" href="#">User</a>
                                <span class="breadcrumb-item active">Index</span>
                            </nav>
                        </div>
                    </div>
                     <vue-element-loading :active="loading" spinner="bar-fade-scale"/>
                    <div class="container">
                        <div class="card col-md-7">
                        <div class="card-body">
                            <h4>Create Developer Record</h4>
                            <p>Please Fill all form input to create details.</p>
                            <div class="m-t-25" style="max-width: 700px">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="file" class="form-control" v-on:change="onImageChange" >
                                            <label for="customFile">Avatar</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First name</label>
                                            <input type="text" class="form-control" v-model='developer.first_name' placeholder="First name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label >Last name</label>
                                            <input type="text" class="form-control" v-model="developer.last_name" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label >Email</label>
                                            <input type="email" class="form-control" v-model="developer.email" placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label >Phone</label>
                                            <input type="tel" class="form-control" v-model="developer.phone" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label >Address</label>
                                        <input type="text" class="form-control"  v-model="developer.address" placeholder="1234 Main St">
                                    </div>

                                    <button type="button" class="btn btn-primary" @click="save" >Add</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    </div>

                </div>
                <!-- Content Wrapper END -->
    </layout>
   
</template>
<script>
import Layout from '../BaseLayout/Layout.vue'
import axios from 'axios'
import VueElementLoading from 'vue-element-loading'
export default {
  components: { 
      Layout,
      VueElementLoading
       },
    data () 
    {
        return {
            developer : {
                first_name : '',
                last_name : '',
                email : '',
                phone : '',
                address : '',
                avatar : ''
            },
            record : '',
            loading : true,
        }
    },

    methods :
    {
        onImageChange(e) {
                this.developer.avatar = e.target.files[0];
            },
            save(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('avatar', this.developer.avatar);
                formData.append('first_name', this.developer.first_name);
                formData.append('last_name', this.developer.last_name);
                formData.append('email', this.developer.email);
                formData.append('phone', this.developer.phone);
                formData.append('address', this.developer.address);

                axios.post('/developer',formData, config)
                .then(response => {
                   this.toaster('Developer Created', "success");
                   this.developer = {}
                    this.loading = false;
                })
                .catch(err=>{
                    if(err.response.data.errors.email){
                        this.toaster(err.response.data.errors.email, "error");
                    }else{
                        this.toaster(err.response.data.message, "error");
                    }
                    this.loading = false;
            })
            }

    },
    mounted (){
         this.loading = false;
    }
}
</script>
<style scoped>

</style>