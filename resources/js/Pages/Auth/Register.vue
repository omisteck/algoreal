<template>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                        <h2 class="m-b-0">Register</h2>
                                    </div>
                                    <vue-element-loading :active="loading" spinner="bar-fade-scale"/>
                                    <form method="post">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Name:</label>
                                            <input type="text" class="form-control" v-model="form.name" placeholder="Fullname">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <input type="email" class="form-control" v-model="form.email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <input type="password" class="form-control" v-model="form.password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                            <input type="password" class="form-control" v-model="form.password_confirmation" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between p-t-15">
                                                <div class="checkbox">
                                                    <input id="checkbox" type="checkbox" v-model="form.accept">
                                                    <label for="checkbox"><span>I have read the <a href="">agreement</a></span></label>
                                                </div>
                                                <button class="btn btn-primary" :disabled="!form.accept"  @click="register()" type="button">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2020 Algoreal</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import VueElementLoading from 'vue-element-loading'
export default {
    components : {
        VueElementLoading
    },
    data () 
    {
        return {
            form : {
                name : '',
                email: '',
                password: '',
                password_confirmation: '',
                accept: ''
            },
            loading : true,
        }
    },

    methods :
    {
        register(){
             this.loading = true;
            axios.post('/register',this.form)
            .then( res => {
                this.toaster('Authenticated', "success");
                this.$inertia.visit('/home');
                 this.loading = false;
            } ).catch(err=>{
                this.toaster(err.response.data.message, "error");
                 this.loading = false;
            })
        }
    },
    mounted (){
         this.loading = false;
    }
}
</script>
<style>

</style>