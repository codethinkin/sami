<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <?php $setting = setting_all();?>

  <link rel="icon" href="<?php echo base_url((setting_all('favicon'))?'assets/images/'.setting_all('favicon'):'assets/images/favicon.ico');?>">
  <title><?php echo (setting_all('website'))?setting_all('website'):'Dasboard';?></title>

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
  <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <!--<link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-black-light.min.css');?>">-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-black-light.css');?>">
    <!--  <link rel="stylesheet" href="<?php echo base_url('assets/css/blue.css');?>">-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.dataTables.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/daterangepicker.css'); ?>" />
<link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet"/>

  <link rel="stylesheet" href="<?php echo base_url('assets/alertifyjs/css/alertify.min.css');?>">
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>
    <body class="hold-transition skin-black-light sidebar-mini" data-base-url="<?php echo base_url(); ?>">
        <div class="wrapper">

          <header class="main-header">
            <a href="<?php echo base_url(); ?>" class="logo">
             <?php $logo =  (setting_all('logo'))?setting_all('logo'):'logo.png'; ?>
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><img src="<?php echo base_url().'assets/images/'.$logo; ?>" id="logo"></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><img src="<?php echo base_url().'assets/images/'.$logo; ?>" id="logo"></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Control Sidebar Toggle Button -->
                        <!-- <li>
                          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li> -->
                        <!-- User Account: style can be found in dropdown.less -->

                        <li class="dropdown user user-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <?php
                 $profile_pic =  'user.png';
                 if(isset($this->session->userdata('user_details')[0]->profile_pic) && file_exists('assets/images/'.$this->session->userdata('user_details')[0]->profile_pic))
                              {
                                 $profile_pic = $this->session->userdata('user_details')[0]->profile_pic;
                              }?>
                              <img src="<?php echo base_url().'assets/images/'.$profile_pic;?>"  class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo isset($this->session->userdata('user_details')[0]->name)?$this->session->userdata('user_details')[0]->name:'';?></span>
                          </a>
                          <ul class="dropdown-menu" role="menu" style="width: 164px;">
                              <li><a href="<?php echo base_url('user/profile');?>"><i class="fa fa-user mr10"></i>Mi Cuenta</a></li>
                              <li class="divider"></li>
                              <li><a href="<?php echo base_url('user/logout');?>"><i class="fa fa-power-off mr10"></i> Cerrar Sección</a></li>
                          </ul>
                        </li>
                    </ul>
                </div>
            </nav>
          </header>
          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

              <div class="user-panel">
                <div class="pull-left image">
                  <img src="<?php echo base_url().'assets/images/'.$profile_pic;?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                  <p><?php echo isset($this->session->userdata('user_details')[0]->name)?$this->session->userdata('user_details')[0]->name:'';?></p>
                  <a href="#"><i class="fa fa-circle text-red"></i> En Linea</a>
                </div>
              </div>

              <ul class="sidebar-menu">
                <li class="header"><!-- MAIN NAVIGATION --></li>
                <?php //echo '<pre>';print_r($this->router); die; ?>

                <?php $this->load->view("include/menu");?>


               <?php if(CheckPermission("user", "own_read")){ ?>


                   <li class="<?=($this->router->class==="dashboard")?"active":"not-active"?>">
                     <a href="<?php echo base_url();?>dashboard"> <i class="fa fa-users"></i> <span>Tablero</span></a>
                  </li>

                    <li class="<?=($this->router->method==="userTable")?"active":"not-active"?>">
                        <a href="<?php echo base_url();?>user/userTable"> <i class="fa fa-users"></i> <span>Usuarios</span></a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-table"></i> <span>Ordenes de Trabajo</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>

                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>activity"><i class="fa fa-circle-o"></i> Actividades</a></li>
                        <li class="<?=($this->router->class==="activity")?"active":"not-active"?>">
                        <li><a href="<?php echo base_url();?>frequency"><i class="fa fa-circle-o"></i> Frecuencias</a></li>
                        <li class="<?=($this->router->class==="frequency")?"active":"not-active"?>">
                          <a href="<?php echo base_url();?>activityfrequency"> <i class="fa fa-circle-o"></i> <span>Actividad_Frecuencia</span></a>
                       </li>
                            <li><a href="<?php echo base_url();?>order"><i class="fa fa-circle-o"></i> Orden de Trabajo</a></li>
                        <li><a href="<?php echo base_url('ventas'); ?> "><i class="fa fa-circle-o"></i> Consumos</a></li>

                        <li><a href="<?php echo base_url('shopping'); ?>"><i class="fa fa-circle-o"></i> Compras</a></li>
                        <!--<li class="treeview">
                          <a href="#">
                            <i class="fa fa-table"></i> <span>Reportes</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>ventas/reporte"><i class="fa fa-circle-o"></i>Reporte Consumos</a></li>
                            <li class="<?=($this->router->class==="ventas")?"active":"not-active"?>">
                            <li><a href="<?php echo base_url();?>ordencompra/reporte"><i class="fa fa-circle-o"></i>Reporte Compras</a></li>

                          </ul>-->

                        </li>
</ul>
            </li>

                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-table"></i> <span>Almacen</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>loans"><i class="fa fa-circle-o"></i> Prestamos</a></li>
                        <li class="<?=($this->router->class==="loans")?"active":"not-active"?>">
                        <li><a href="<?php echo base_url();?>product"><i class="fa fa-circle-o"></i> Productos</a></li>
                        <li class="<?=($this->router->class==="category")?"active":"not-active"?>">
                          <a href="<?php echo base_url();?>category"> <i class="fa fa-circle-o"></i> <span>Categorias</span></a>
                       </li>
                       <li class="<?=($this->router->class==="centros")?"active":"not-active"?>">
                         <a href="<?php echo base_url();?>centros"> <i class="fa fa-circle-o"></i> <span>Centros de Costos</span></a>
                      </li>
                            <li><a href="<?php echo base_url();?>subcategory"><i class="fa fa-circle-o"></i> Sub-Categorias</a></li>
                        <li><a href="<?php echo base_url('ventas'); ?> "><i class="fa fa-circle-o"></i> Consumos</a></li>
<li><a href="<?php echo base_url('report'); ?> "><i class="fa fa-circle-o"></i> Reporte Consumos</a></li>
                        <li><a href="<?php echo base_url('shopping'); ?>"><i class="fa fa-circle-o"></i> Compras</a></li>
<li><a href="<?php echo base_url('rcompras'); ?> "><i class="fa fa-circle-o"></i> Reporte Compras</a></li>
                        <!--<li class="treeview">
                          <a href="#">
                            <i class="fa fa-table"></i> <span>Reportes</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>ventas/reporte"><i class="fa fa-circle-o"></i>Reporte Consumos</a></li>
                            <li class="<?=($this->router->class==="ventas")?"active":"not-active"?>">
                            <li><a href="<?php echo base_url();?>ordencompra/reporte"><i class="fa fa-circle-o"></i>Reporte Compras</a></li>

                          </ul>-->
                        </li>
    </li>

                      </ul>
                    </li>
</li>


                    <li class="<?=($this->router->method==="customers")?"active":"not-active"?>">
                        <a href="<?php echo base_url("customers");?>"> <i class="fa fa-users"></i> <span>Clientes</span></a>
                    </li>


                    <li class="<?=($this->router->method==="equipment")?"active":"not-active"?>">
                        <a href="<?php echo base_url("equipment");?>"> <i class="fa fa-users"></i> <span>Equipos</span></a>
                    </li>
                    <li class="<?=($this->router->method==="prividers")?"active":"not-active"?>">
                        <a href="<?php echo base_url();?>provider"> <i class="fa fa-users"></i> <span>Proveedores</span></a>
                    </li>

                    <li class="<?=($this->router->method==="employee")?"active":"not-active"?>">
                        <a href="<?php echo base_url();?>employee"> <i class="fa fa-users"></i> <span>Técnicos</span></a>
                    </li>

                    <li class="<?=($this->router->class==="engine")?"active":"not-active"?>">
                        <a href="<?php echo base_url("engine"); ?>"><i class="fa fa-cogs"></i> <span>Configuración Equipos</span></a>
                    </li>
                <?php }  if(isset($this->session->userdata('user_details')[0]->user_type) && $this->session->userdata('user_details')[0]->user_type == 'admin'){ ?>
                    <li class="<?=($this->router->class==="setting")?"active":"not-active"?>">
                        <a href="<?php echo base_url("setting"); ?>"><i class="fa fa-cogs"></i> <span>Configuración</span></a>
                    </li>

                    <!-- <li class="<?php //echo ($this->router->class==="Templates")?"active":"not-active"?>">
                        <a href="<?php //echo base_url("Templates"); ?>"><i class="fa fa-cubes"></i> <span>Templates</span></a>
                    </li> -->
                  <?php }  /*if(CheckPermission("invoice", "own_read")){ ?>
                    <li class="<?=($this->router->class==="invoice")?"active":"not-active"?>">
                        <a href="<?php echo base_url("invoice/view"); ?>"><i class="fa fa-list-alt"></i> <span>Invoice</span></a>
                    </li>

               <?php  }*/ ?>
               <li class="<?=($this->router->method==="profile")?"active":"not-active"?>">
               <a href="<?php echo base_url('user/profile');?>"> <i class="fa fa-user"></i> <span>Mi Cuenta</span></a>
               </li>

                  <li class="<?=($this->router->class==="about")?"active":"not-active"?>">
                        <a href="<?php echo base_url("about"); ?>"><i class="fa fa-info-circle"></i> <span>Acerca de </span></a>
                    </li>


              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>
