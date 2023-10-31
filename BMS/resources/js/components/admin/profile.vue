<template>
    <div>
        <div id="wrapper">
        <Sidebar />
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <Navbar />
               <div class="container-fluid">
                    <h1 class="text-center">Profile</h1>
               </div>
            </div>
            <Footer />
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    </div>
</template>

<script>
import Sidebar from './incs/sidebar.vue';
import Navbar from './incs/navbar.vue';
import Footer from './incs/footer.vue';
export default {
    components: {
        Sidebar,
        Navbar,
        Footer,
    }
}
</script>