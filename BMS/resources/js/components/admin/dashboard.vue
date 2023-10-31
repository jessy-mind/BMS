<template>
  <div>
    <div id="wrapper">
      <Sidebar />
      <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
          <Navbar />
          <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
              <h3 class="text-dark mb-0">Dashboard</h3>
              <a
                class="btn btn-primary btn-sm d-none d-sm-inline-block"
                role="button"
                href="#"
                ><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate
                Report</a
              >
            </div>
            <Bars />
            <div class="row">
              <div class="col-lg-7 col-xl-8">
                <Graph />
              </div>
              <div class="col-lg-5 col-xl-4">
                <Pie />
              </div>
            </div>
          </div>
        </div>
        <Footer />
      </div>
      <a class="border rounded d-inline scroll-to-top" href="#page-top"
        ><i class="fas fa-angle-up"></i
      ></a>
    </div>
  </div>
</template>

<script>
import Sidebar from "./incs/sidebar.vue";
import Navbar from "./incs/navbar.vue";
import Footer from "./incs/footer.vue";
import Graph from "./incs/charts/graph.vue";
import Pie from "./incs/charts/pie.vue";
import Bars from "./incs/bars.vue";
export default {
  components: { Sidebar, Navbar, Footer, Graph, Pie, Bars },
  data() {
    return {
      isLoggedIn: "",
    };
  },
};
</script>
