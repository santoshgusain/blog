<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= ASSESTS_URL ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard')?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/user_listing')?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Manage Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('category/category_listing')?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Manage Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('post/post_listing')?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Manage Posts</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>