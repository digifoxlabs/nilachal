<body>

<div class="preloader">
  <div class="preloader-body">
    <div class="cssload-container">
      <div class="cssload-speeding-wheel"></div>
    </div>
    <p>Loading...</p>
  </div>
</div>

<div class="page">

<header class="section page-header">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-corporate" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="106px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">

            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-aside-outer">
                <div class="rd-navbar-aside">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <!--Brand--><a class="brand" href="<?= base_url(); ?>"><img src="<?= base_url("assets/frontend/img/logo.png") ?>" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="rd-navbar-aside-right rd-navbar-collapse">
                        <ul class="rd-navbar-corporate-contacts">
                            <li>
                                <div class="unit unit-spacing-xs">
                                    <div class="unit-left"><span class="icon fa fa-clock-o"></span></div>
                                    <div class="unit-body">
                                        <p>09:00<span>am</span> — 09:00<span>pm</span></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="unit unit-spacing-xs">
                                    <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                                    <div class="unit-body">
                                        <a class="link-phone" href="#">+91 60265-00977</a><br>
                                        <a class="link-phone" href="#">+91 76369-55501</a>
                                    
                                    </div>
                                </div>
                            </li>
                        </ul><a class="button button-sm button-default-outline-2" href="<?= base_url('bookings'); ?>">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <div class="rd-navbar-nav-wrap">
                        <ul class="list-inline list-inline-md rd-navbar-corporate-list-social">

                            <li><a class="icon fa fa-facebook" href="#"></a></li>
                            <li><a class="icon fa fa-twitter" href="#"></a></li>
                            <li><a class="icon fa fa-google-plus" href="#"></a></li>
                            <li><a class="icon fa fa-instagram" href="#"></a></li>
                        </ul>
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li class="rd-nav-item active"><a class="rd-nav-link" href="<?= base_url(); ?>">Home</a>
                            </li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="<?= base_url('/about-us'); ?>">About</a>
                            </li>



                            <li class="rd-nav-item"><a class="rd-nav-link" href="<?= base_url('/contact-us'); ?>">Contact Us</a>
                            </li>

  
                            <!-- If Logged In -->
                            <?php   
                            
                            if(session()->get('isLoggedInClient')):
                            ?>
                            <li class="rd-nav-item">
                                <div class="dropdown show">
                                    <a class="rd-nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account
                                    </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                   
                                      <a class="dropdown-item" href="<?= base_url('my-bookings') ?>">My Account</a>                      
                                         <a class="dropdown-item" href="<?= base_url('profile') ?>">My Profile</a>  
                                <a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a>                                      
                                    </div>
                                </div>
                            </li>
                                <?php endif ?>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
