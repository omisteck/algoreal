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
                            <h4>Edit Developer Record</h4>
                            <p>Please Fill all form input to create details.</p>
                            <div class="m-t-25" style="max-width: 700px">
                                <form method="post" enctype="multipart/form-data">
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

                                    <button type="button" class="btn btn-primary" @click="update" >Update</button>
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
       props : {
        data : {}
    },
    data () 
    {
        return {
            developer : {
                id : '',
                first_name : '',
                last_name : '',
                email : '',
                phone : '',
                address : ''
            },
            record : '',
            loading : true,
        }
    },

    methods :
    {
        
            update(){
               
                axios.put('/developer/'+this.developer.id,  this.developer)
                .then(response => {
                   this.toaster('Developer Details Edited successfully', "success");
                    this.loading = false;
                })
                .catch(err=>{
                    this.toaster(err.response.data.message, "error");
                    this.loading = false;
            })
            }

    },
    mounted (){
        // console.log(this.)
         this.loading = false;
         this.developer = this.data
    }
}
</script>
<style scoped>

</style>