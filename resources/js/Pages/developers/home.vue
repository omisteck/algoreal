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
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <div class="d-md-flex align-items-center">
                                            <div class="text-center text-sm-left ">
                                                <div class="avatar avatar-image" style="width: 150px; height:150px">
                                                    <img :src="'https://ui-avatars.com/api/?name='+encodeURIComponent('Omiwale Rasheed')" alt="">
                                                </div>
                                            </div>
                                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                                <h2 class="m-b-5">Omiwale Rasheed</h2>
                                                <p class="text-opacity font-size-13">@Omisteck on Github</p>
                                                <p class="text-dark m-b-20">Apply For the role of: Laravel Developer</p>
                                                <a  href="mailto:talk2omis@gmail.com" class="btn btn-success btn-tone">Contact</a>
                                                <inertia-link href="/developer/create" class="btn btn-primary btn-tone btn-lg">Create Developer</inertia-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="d-md-block d-none border-left col-1"></div>
                                            <div class="col">
                                                <ul class="list-unstyled m-t-10">
                                                    <li class="row">
                                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                            <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                                            <span>Email: </span> 
                                                        </p>
                                                        <p class="col font-weight-semibold"> talk2omis@gmail.com</p>
                                                    </li>
                                                    <li class="row">
                                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                            <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                                            <span>Phone: </span> 
                                                        </p>
                                                        <p class="col font-weight-semibold"> +234-906-462-9981</p>
                                                    </li>
                                                    <li class="row">
                                                        <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                                            <span>Location: </span> 
                                                        </p>
                                                        <p class="col font-weight-semibold"> Lagos, Nigeria</p>
                                                    </li>
                                                </ul>
                                                <div class="d-flex font-size-22 m-t-15">
                                                    <a href="https://www.linkedin.com/in/omisteck" class="text-gray p-r-20">
                                                        <i class="anticon anticon-linkedin"></i>
                                                    </a>        
                                                    <a href="" class="text-gray p-r-20">    
                                                        <i class="anticon anticon-dribbble"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <vue-element-loading :active="loading" spinner="bar-fade-scale"/>
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
import laravelVuePagination from 'laravel-vue-pagination'
export default {
  components: { 
      Layout,
      VueElementLoading,
      laravelVuePagination
       },
    props : {
        data : {}
    }
    ,
    data () 
    {
        return {
            form : {
                email : '',
                password: '',
            },
            record : {},
            loading : true,
        }
    },

    methods :
    {
        getResults(page = 1) {
			axios.get('paginatedDeveloper?page=' + page)
				.then(response => {
                    // console.log()
					this.record = response.data.data;
				});
        },
        confirmDelete(data){
            var conf = window.confirm('Are You sure you want to delete');
            if(conf){
                axios.delete('developer/' + data.id)
                .then(response => {
                   this.toaster(response.data.message, "success");
                    this.loading = false;
				}).catch(err=>{
                        this.toaster(err.response.data.message, "error");
                    this.loading = false;
            });
            }
        }
    },
    mounted (){
         this.loading = false;
        this.record = this.data
    }
}
</script>
<style scoped>

</style>