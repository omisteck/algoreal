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
                            <vue-element-loading :active="loading" spinner="bar-fade-scale"/>
   <div class="card-body">
      <h4>Developers List</h4>
      <p>This is a paginate record use the nav below to check other record.</p>
      <div class="m-t-25">
         <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
               <div class="col-sm-12">
                   <div class="table-responsive">
                            <table id="" class="table table-sm">
                            <thead>
                                <tr role="row">
                                    <th>Avatar</th>
                                <th >First Name</th>
                                <th>Last Name</th>
                                <th style="width: 137px;">Email</th>
                                <th >Phone</th>
                                <th >Address</th>
                                <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd" v-for="(rec , index) in record.data" :key="index">
                                <td>
                                    <div class="avatar avatar-icon">
                                        <img :src="'/storage/'+rec.avatar" />
                                    </div>
                                    </td>
                                <td class="sorting_1">{{rec.first_name}}</td>
                                <td>{{rec.last_name}}</td>
                                <td>{{rec.email}}</td>
                                <td>{{rec.phone}}</td>
                                <td>{{rec.address}}</td>
                                <td>
                                    <p><button class="btn btn-outline btn-danger btn-sm  mb-3" @click="confirmDelete(rec)" title="Delete">
                                        <i class="fa fa-trash" style="color:white"></i> 
                                        </button></p>

                                        <p><inertia-link :href="'/developer/'+ rec.id + '/edit'" class="btn btn-outline btn-primary  btn-sm">
                                            <i class="fa fa-edit" style="color:white"></i> 
                                        </inertia-link></p>
                                    
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th rowspan="1" colspan="1">Avatar</th>
                                <th rowspan="1" colspan="1">First Name</th>
                                <th rowspan="1" colspan="1">Last Name</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Phone</th>
                                <th rowspan="1" colspan="1">Address</th>
                                <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </tfoot>
                        </table> 
                   </div>
                  
                  <div class="col-sm-12 col-md-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                           <pagination :data="record" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                  
               </div>
            </div>
           
         </div>
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