<template>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="index.html">
                        <img src="/assets/images/logo/logo.png" alt="Logo">
                        <img class="logo-fold" src="/assets/images/logo/logo-fold.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="index.html">
                        <img src="/assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="/assets/images/logo/logo-fold-white.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav-right">
                       
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img :src="'https://ui-avatars.com/api/?name='+encodeURIComponent($page.props.auth.user.name)"  alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img :src="'https://ui-avatars.com/api/?name='+encodeURIComponent($page.props.auth.user.name)" alt="">
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold">{{ $page.props.auth.user.name }}</p>
                                            <p class="m-b-0 opacity-07">Developer</p>
                                        </div>
                                    </div>
                                </div>
                                <inertia-link href="/logout" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </inertia-link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>    
            <!-- Header END -->
            <sidebar />
            <div class="page-container">
                <slot></slot>
                <footer />
            </div>
        </div>
    </div>
</template>
<script>
import Footer from './Footer.vue'
import Header from './Header.vue'
import Sidebar from './Sidebar.vue'
export default {
  components: { Header, Footer, Sidebar },
    
}
</script>
<style scoped>

</style>