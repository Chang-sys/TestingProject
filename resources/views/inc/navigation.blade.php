 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">

         <!-- Messages Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-comments"></i>
                 <span class="badge badge-danger navbar-badge">3</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">

                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 Brad Diesel
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">Call me whenever you can...</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 John Pierce
                                 <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">I got your message bro</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 Nora Silvester
                                 <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">The subject goes here</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
             </div>
         </li>
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                 </a>
                 <div class="dropdown-divider"></div>s
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>

         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link d-flex" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <!-- <img class="img-profile rounded-circle"
                     src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg"> -->
                 @if ($gloData['profile'] && $gloData['profile']->image_path)
                 <img src="{{ asset('storage/images/'.$gloData['profile']->image_path) }}" alt="Profile Image"
                     width="70" class="img-circle elevation-2">
                 @else
                 <img src="{{ asset('storage/images/default_Profile.png') }}" alt="Profile Image" width="70"
                     class="img-circle elevation-2">
                 @endif

             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="profile">
                     <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                     Profile
                 </a>
                 <a class="dropdown-item" href="#">
                     <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                     Settings
                 </a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="{{ route('logout') }}">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                 </a>
             </div>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="/" class="brand-link">
         <img src="{{ asset('adminDashboard_asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">TrovKa</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">

         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <!-- <img src="{{ asset('adminDashboard_asset/dist/img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2" alt="User Image"> -->
                 @if ($gloData['profile'] && $gloData['profile']->image_path)
                 <img src="{{ asset('storage/images/'.$gloData['profile']->image_path) }}" alt="Profile Image"
                     width="70" class="img-circle elevation-2">
                 @else
                 <img src="{{ asset('storage/images/default_Profile.png') }}" alt="Profile Image" width="70"
                     class="img-circle elevation-2">
                 @endif
             </div>
             <div class="info">
                 <a href="profile" class="d-block">{{ auth()->user()->name }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item menu-open">
                     <a href="dashboard" class="nav-link active">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="company" class="nav-link">
                         <i class="nav-icon far fa-circle"></i>
                         <p>
                             Company
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>
                 <!-- <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="far fa-circle nav-icon"></i>
                         <p>
                            Company
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li> -->
                 <li class="nav-item">
                     <a href="maker" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Maker
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="far fa-circle nav-icon"></i>
                         <p>
                             Report
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">Setting</li>
                 <li class="nav-item">
                     <a href="category" class="nav-link">
                         <i class="nav-icon far fa-circle text-danger"></i>
                         <p class="text">Category</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-warning"></i>
                         <p class='text'>List Of Pages <i class="fas fa-angle-left right"></i></p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="productTitle" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Title</p>
                             </a>
                         </li>
                         <!-- <li class="nav-item">
                             <a href="productImage" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Image</p>
                             </a>
                         </li> -->
                         <li class="nav-item">
                             <a href="productColor" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Color</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="productSize" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Size</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="productStorage" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Storage</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="productUsed" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product Used</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="product" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Product</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="brand" class="nav-link">
                         <i class="nav-icon far fa-circle text-info"></i>
                         <p>Brand</p>
                     </a>
                 </li>

                 <!-- Authentication -->
                 <li class="nav-item {{ isActiveMenu(['admin/users', 'roles', 'permission']) ? 'menu-open' : '' }}">
                     <a href="#"
                         class="nav-link {{ isActiveMenu(['admin/users', 'roles', 'permission']) ? 'active' : '' }}">
                         <i class="nav-icon fas fa-users"></i>
                         <p> Authentication <i class="fas fa-angle-left right"></i></p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('users.index') }}"
                                 class="nav-link {{ isActiveMenu(['admin/users']) ? 'active' : '' }}">
                                 <i class="fas fa-users nav-icon"></i>
                                 <p>Users/Staff</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('roles.index') }}"
                                 class="nav-link {{ isActiveMenu(['admin/roles']) ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Role</p>
                             </a>
                         </li>
                     </ul>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>