<template>
  <div>
    <nav
      class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
    >
      <div class="container-fluid d-flex flex-column p-0">
        <a
          class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
          href="#"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
        </a>
        <hr class="sidebar-divider my-0" />
        <ul class="navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item">
            <router-link to="dashboard">
              <a class="nav-link active"
                ><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a
              ></router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="manage_super_admin">
              <a class="nav-link"
                ><i class="fas fa-user"></i><span>Manage Super Admins</span></a
              >
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="manage_stores">
              <a class="nav-link"
                ><i class="fas fa-user"></i><span>Manage Stores</span></a
              >
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="manage_store_admins">
              <a class="nav-link"
                ><i class="fas fa-user"></i><span>Manage Store Admins</span></a
              >
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="manage_products">
              <a class="nav-link"
                ><i class="fas fa-user"></i><span>Manage Products</span></a
              >
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="profile">
              <a class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a>
            </router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="table.html"
              ><i class="fas fa-table"></i><span>Table</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout"
              ><i class="far fa-user-circle"></i><span>Logout</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.html"
              ><i class="fas fa-user-circle"></i><span>Register</span></a
            >
          </li>
        </ul>
        <div class="text-center d-none d-md-inline">
          <button
            class="btn rounded-circle border-0"
            id="sidebarToggle"
            type="button"
          ></button>
        </div>
      </div>
    </nav>
  </div>
</template>
