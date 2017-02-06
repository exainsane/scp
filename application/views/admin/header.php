<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | UNJ Mengajar</title>

    <script type="text/javascript" src="<?php echo base_url("assets/ckeditor/ckeditor.js") ?>"></script>

    <!-- Bootstrap -->
    <link href="<?php echo base_url("assets/ui/vendors/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url("assets/ui/vendors/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url("assets/ui/vendors/nprogress/nprogress.css") ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url("assets/ui/vendors/iCheck/skins/flat/green.css") ?>" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url("assets/ui/vendors/google-code-prettify/bin/prettify.min.css") ?>" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url("assets/ui/vendors/select2/dist/css/select2.min.css") ?>" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url("assets/ui/vendors/switchery/dist/switchery.min.css") ?>" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url("assets/ui/vendors/starrr/dist/starrr.css") ?>" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url("assets/ui/vendors/bootstrap-daterangepicker/daterangepicker.css") ?>" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url("assets/ui/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/ui/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/ui/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/ui/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/ui/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url("assets/ui/build/css/custom.min.css") ?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-pencil"></i> <span>UNJ Mengajar</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url("assets/images/user.png") ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a></li>
                  <li><a><i class="fa fa-edit"></i> Tambah Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("admin/post/new") ?>">Post Blog</a></li>
                      <li><a href="<?php echo site_url("admin/services/new") ?>">Service</a></li>
                      <li><a href="<?php echo site_url("admin/slider/new") ?>">Slider</a></li>
                      <li><a href="<?php echo site_url("admin/team/new") ?>">Team</a></li>
                      <li><a href="<?php echo site_url("admin/testimoni/new") ?>">Testimoni</a></li>
                    </ul>
                  </li>                  
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("admin/about") ?>">About</a></li>
                      <li><a href="<?php echo site_url("admin/contact") ?>">Contact</a></li>
                      <li><a href="<?php echo site_url("admin/post") ?>">Post Blog</a></li>
                      <li><a href="<?php echo site_url("admin/services") ?>">Service</a></li>
                      <li><a href="<?php echo site_url("admin/slider") ?>">Slider</a></li>
                      <li><a href="<?php echo site_url("admin/team") ?>">Team</a></li>
                      <li><a href="<?php echo site_url("admin/testimoni") ?>">Testimoni</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url("assets/images/user.png") ?>" alt="">Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>