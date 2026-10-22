
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
      <nav class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url();?>admin/dashboard">
            <img src="<?php echo base_url();?>assets/template/backend/img/logo.png" alt="" height="25">
            <span>ptppm.id</span>
          </a>
          <button class="navbar-toggler left-sidebar-toggle pull-left visible-xs" type="button">
            <span class="hamburger"></span>
          </button>
          <button class="navbar-toggler pull-right visible-xs-block" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="more"></span>
          </button>
        </div>
        <div class="navbar-collapsible">
          <div id="navbar" class="navbar-collapse collapse">
            <button class="navbar-toggler left-sidebar-collapse pull-left hidden-xs" type="button">
              <span class="hamburger"></span>
            </button>
            <ul class="nav navbar-nav">
              <li class="visible-xs-block">
                <div class="nav-avatar">
                  <img class="img-circle" src="<?php echo base_url();?>assets/template/backend/img/avatars/1.jpg" alt="" width="48" height="48">
                </div>
                <h4 class="navbar-text text-center">Welcome, <?php echo ucwords($name);?>!</h4>
              </li>
            </ul>
           <ul class="nav navbar-nav navbar-right">
              <li class="nav-table dropdown visible-xs-block"> <!-- mobile -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="nav-cell nav-icon">
                    <i class="zmdi zmdi-account-o"></i>
                  </span>
                  <span class="hidden-md-up m-l-15">Account</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php echo base_url();?>logout">Logout</a></li>
                </ul>
              </li>
              
              <li class="nav-table dropdown hidden-sm-down">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="nav-cell p-r-10">
                    <img class="img-circle" src="<?php echo base_url();?>assets/template/backend/img/avatars/1.jpg" alt="" width="32" height="32">
                  </span>
                  <span class="nav-cell"><?php echo ucwords($name);?>
                    <span class="caret"></span>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#">
                      <i class="zmdi zmdi-account-o m-r-10"></i> Profile</a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="<?php echo base_url();?>logout">
                      <i class="zmdi zmdi-power m-r-10"></i> Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>