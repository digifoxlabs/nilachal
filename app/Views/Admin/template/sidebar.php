<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-lock"></i>
        </div>
        <div class="sidebar-brand-text mx-3">NILACHAL Admin <sup>1.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Bookings
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-bed"></i>
          <span>Hotel Bookings</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Bookings:</h6>
            <a class="collapse-item" href="new_bookings.php">New Bookings</a>
            <a class="collapse-item" href="current_bookings.php">Active Bookings</a>
            <a class="collapse-item" href="pending_webbookings.php">Pending Bookings</a>
            <a class="collapse-item" href="completed_bookings.php">Completed Bookings</a>
            <a class="collapse-item" href="all_bookings.php">All Bookings</a>    
                    
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-car"></i>
          <span>Tour &amp; Travel Booking</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tour &amp; Travel:</h6>
            <a class="collapse-item" href="#">Tour Booking</a>
            <a class="collapse-item" href="#">Car Booking</a>
            
          </div>
        </div>
      </li>
        
      <li class="nav-item">
        <a class="nav-link" href="transactions.php">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>All Transactions</span></a>
      </li>     
               
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>        
       
    <li class="nav-item">
        <a class="nav-link" href="rooms.php">
          <i class="fas fa-fw fa-building"></i>
          <span>Manage Rooms</span></a>
      </li>
         
    <li class="nav-item">
        <a class="nav-link" href="settings.php">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Settings</span></a>
      </li>
            
    <!-- Manage Rooms-->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->