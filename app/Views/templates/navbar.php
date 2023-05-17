<style> 
  .tooltip.tooltiptext{
    width: 160px;
    top:100%;
    left:40%;
    margin-left: 80px;
  }
</style>
<!-- partial:partials/_horizontal-navbar.html -->
  <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="<?php echo base_url('sendQuote'); ?>" >
                  <i class="mdi mdi-message-reply-text mx-0" aria-hidden="true" title="Requested Quote"></i>  
                  <!-- <span class="count bg-success">2</span> -->
                </a>
                
              </li>
              <li class="nav-item dropdown">
                 <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="<?php echo base_url('sendMail'); ?>" >  <!--data-bs-toggle="dropdown"> -->
                  <i class="mdi mdi-email mx-0" aria-hidden="true" title="Contacted Customer"></i>  
                  <!-- <span class="count bg-primary">4</span> -->
                </a>
              </li>
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?php echo base_url("dashboard"); ?>"><img src="<?php echo base_url(); ?>/assets/images/logo.png" alt="MYTT" style="height: 70px;"/></a>
                <a class="navbar-brand brand-logo-mini" href="<?php echo base_url("dashboard"); ?>"><img src="<?php echo base_url(); ?>/assets/images/logo-mini.png" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown  d-lg-flex d-none">
                  <!-- <button type="button" class="btn btn-inverse-primary btn-sm">Product </button> -->
                </li>
                
                <li class="nav-item dropdown d-lg-flex d-none">
                  <!-- <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button> -->
                </li>
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Admin</span>
                    <span class="online-status"></span>
                    <img src="<?php echo base_url(); ?>/assets/images/faces/icon.jpg" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>
                      <a class="dropdown-item" href="<?php echo base_url("logout"); ?>">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("dashboard"); ?>">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
             
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-home-modern menu-icon"></i>
                    <span class="menu-title">Our Company</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('home'); ?>">Home Page</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('contactus'); ?>">Contact Us</a></li>
                          <!-- <li class="nav-item"><a class="nav-link" href="<?php //echo base_url('vender'); ?>">Vender</a></li>                       -->
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('about'); ?>">About Us</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('who'); ?>">Who We Are</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('multibranches'); ?>">Multibranches</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('ourstory'); ?>">Our Story</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('ourexpertise'); ?>">Our Expertise</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('vission'); ?>">Vission</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('mission'); ?>">Mission</a></li>
                          <!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url('partners'); ?>">Our Partners</a></li> -->
                              
                      </ul>
                  </div>
              </li>
           
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-wrench menu-icon"></i>
                    <span class="menu-title">Services</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_service'); ?>">Add Service</a></li> 
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('services_content'); ?>">Service Content</a></li> 
                      
                  </div>
              </li>

              <li class="nav-item">
              <a href="#" class="nav-link">
                    <i class="mdi mdi-note-plus menu-icon"></i>
                    <span class="menu-title"  >Projects</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('proj_category'); ?>">Projects Category</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_proj_name'); ?>">Add Projects Names</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('proj_contents'); ?>">Add Projects Contents</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-wrench menu-icon"></i>
                    <span class="menu-title">Solutions</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_solutions'); ?>">Add Solutions</a></li> 
                      <li class="nav-item"><a class="nav-link" href="<?php echo base_url('solutions_content'); ?>">Add Solutions Content</a></li> 
                      
                  </div>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Our Partners</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_partners'); ?>">Add Partners Name</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_partners_content'); ?>">Add Partners Content</a></li>
                       </ul>
                  </div>                 
              </li>
              
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Setting</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('systemsetting'); ?>">SystemSetting</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('socialmedia'); ?>">Social Setting</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('logo'); ?>">Logo and Favicon</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('email'); ?>">Email Setting</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('footersetting'); ?>">Footer Setting</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('seo'); ?>">SEO Setting</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-dropbox menu-icon"></i>
                    <span class="menu-title">Fintech</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_fintech'); ?>">Add Name</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_fintech_content'); ?>">Add Content</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_fintech_features'); ?>">Add Features</a></li>
                       </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-file-document menu-icon"></i>
                    <span class="menu-title">Legal</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('terms'); ?>">Terms and Condition</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('privacy'); ?>">Privacy Policy</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('refund'); ?>">Refund and Cancellation</a></li>
                          
                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-trophy-award menu-icon"></i>
                    <span class="menu-title">Career</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('careerMYTT'); ?>">Careers</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('jobList'); ?>">Job Apply List</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="<?php echo base_url('youthEmpowerment'); ?>" class="nav-link"><i class="mdi mdi-trophy-award menu-icon"></i><span class="menu-title">Youth Empowerment</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>

              <!-- <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-bell menu-icon"></i>
                    <span class="menu-title">Notification</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="<?php //echo base_url('sendQuote'); ?>">Requested Quote</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php //echo base_url('sendMail'); ?>">Contacted Customer</a></li>
                      </ul>
                  </div>
              </li> -->
              
            </ul>
        </div>
      </nav>
    </div>