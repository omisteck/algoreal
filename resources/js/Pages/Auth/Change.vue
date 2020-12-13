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
                                        <h2 class="m-b-0">Password</h2>
                                    </div>
                                    <vue-element-loading :active="loading" spinner="bar-fade-scale"/>

                                    <form method="post">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">New Password:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" v-model="form.password" placeholder="*********">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Retype Password:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" v-model="form.password_confirmation" placeholder="*********">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    Did you have an account? 
                                                    <inertia-link class="small" :href="'/login'"> Login</inertia-link>
                                                </span>
                                                <button class="btn btn-primary" type="button" @click="change">Change</button>
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
    props : {
        request : {

        }
    }
    ,
    data () 
    {
        return {
            form : {
                email : '',
                password_confirmation : '',
                password: '',
                token:'',
                currentUrl : window.location.pathname,
            },
            loading : true,
        }
    },

    methods :
    {
        change(){
             this.loading = true;
             this.form.token = this.form.currentUrl.split('/')[this.form.currentUrl.split('/').length-1]
            axios.post('/reset-password',this.form)
            .then( res => {
                this.toaster('Authenticated', "success");
                this.$inertia.visit('/home');
                 this.loading = false;
            } ).catch(err=>{
                this.toaster(err.response.data.message, "error");
                 this.loading = false;
            })
        },
    },
    mounted (){
         this.loading = false;
         this.form.email = this.request.email;
         console.log(this.form);
    }
}
</script>
<style scoped>

</style>