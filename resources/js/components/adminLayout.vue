<template>
    <div>
         <!-- Main navigation -->
        <div id="sidebar">
            <div class="navbar-expand-md navbar-dark">
                <header class="d-none d-md-block">
                    <h4>Admin</h4>
                </header>
                <!-- Mobile menu toggle and header -->
                <div class="mobile-header-controls">
                    <a class="navbar-brand d-md-none d-lg-none d-xl-none" href="#"><span>my</span>website</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SidebarContent" aria-controls="SidebarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div id="SidebarContent" class="collapse flex-column navbar-collapse">
                    <!-- Main navigation items -->
                    <nav class="navbar navbar-dark">
                        <div id="mainNavbar">
                            <ul class="flex-column mr-auto">
                                <router-link class="nav-item" exact-active-class="active" to='/admin/user'>
                                    <a class="nav-link">User</a>
                                </router-link>
                                <router-link class="nav-item" exact-active-class="active" to='/admin/review'>
                                    <a class="nav-link">Review</a>
                                </router-link>
                                <router-link class="nav-item" exact-active-class="active" to='/admin/recipe'>
                                    <a class="nav-link">Recipe</a>
                                </router-link>
                                <router-link class="nav-item" exact-active-class="active" to='/admin/cafe'>
                                    <a class="nav-link">Cafe</a>
                                </router-link>
                                <li class="nav-item" style="cursor: pointer;">
                                    <a class="nav-link" @click="logout()">Log Out</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Social icons -->
                     <p class="sidebar-social-icons social-icons">
                        <a href="#"><i class="fa fa-facebook fa-2x"></i></a>
                        <a href="#"><i class="fa fa-twitter fa-2x"></i></a>
                        <a href="#"><i class="fa fa-youtube fa-2x"></i></a>
                        <a href="#"><i class="fa fa-instagram fa-2x"></i></a>
                    </p>
                </div>
            </div>
        </div>
        <div id="content">
            <div id="content-wrapper">
                <div class="jumbotron-wrap">
                    <div class="container-fluid">
                        <div class="jumbotron static-slider">
                            <router-link to="/"><img src="../../../public/logo/fg1.png" width="99%" style="margin-top:-70px; margin-bottom: -50px"></router-link>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="row">
                <!-- Main content -->
				    <main class="container-fluid">
                        <article>
                            <router-view></router-view>
                        </article>
					</main>
				</div>
			</div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        logout(){
            this.$session.destroy();
            this.$router.push({path: '/login'});
        }
    },
    created() {
        if(!this.$session.exists() && !this.$session.has('admin')){
            const message='Silakan Login sebagai Admin terlebih dahulu';
            this.$router.push({name: 'login', params: {msg: message}});
        }
    }
}
</script>

