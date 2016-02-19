<?php
require ('php/connDB.php');
include ('php/session.php');
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al index.php 
} else {
    ?>
    <!DOCTYPE html>
    <!--
    Pagina principal de indicadores del CGC.
    V 1.0 Fecha creación: Julio 03/15
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Colegio Grancolombiano | Indicadores de Gestión</title>
            <link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
            <link rel="apple-touch-icon" href="pics/apple-touch-icon.png" />

            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.4 -->
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <!-- Font Awesome Icons -->
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <!-- Ionicons -->
            <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
            <!-- Theme style -->
            <link href="php/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
            <link href="php/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        </head>
        <!--
        BODY TAG OPTIONS:
        =================
        Apply one or more of the following classes to get the
        desired effect
        |---------------------------------------------------------|
        | SKINS         | skin-blue                               |
        |               | skin-black                              |
        |               | skin-purple                             |
        |               | skin-yellow                             |
        |               | skin-red                                |
        |               | skin-green                              |
        |---------------------------------------------------------|
        |LAYOUT OPTIONS | fixed                                   |
        |               | layout-boxed                            |
        |               | layout-top-nav                          |
        |               | sidebar-collapse                        |
        |               | sidebar-mini                            |
        |---------------------------------------------------------|
        -->
        <body class="skin-blue sidebar-mini">
            <div class="wrapper">

                <!-- Main Header -->
                <header class="main-header">

                    <!-- Logo -->
                    <a href="inicio1.php" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><img src="pics/logo.png" height="50px" alt="Grancolombiano"/> /></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><img src="pics/logo2.png" height="50px" alt="Grancolombiano"/></span>
                    </a>

                    <!-- Header Navbar -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="php/dist/img/unknown.gif" class="user-image" alt="User Image" />
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs"><?php echo $login_fn . " " . $login_ln; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <img src="php/dist/img/unknown.gif" class="img-circle" alt="User Image" />
                                            <p>
                                                <?php echo $login_fn . " " . $login_ln; ?>
                                                <br>Cargo: <?php echo "$login_occupation"; ?>
                                                <small><?php
                                            if ($login_usertype == 0) {
                                                echo "Administrador";
                                            } else {
                                                echo "";
                                            }
                                                ?></small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="php/logout.php" class="btn btn-default btn-flat">Salir</a>
                                            </div>
                                        </li>
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

                        <!-- Sidebar user panel (optional) -->
                        <div class="user-panel">
                            <div class="pull-left image">
                                <img src="php/dist/img/unknown.gif" class="img-circle" alt="User Image" />
                            </div>
                            <div class="pull-left info">
                                <p><?php echo $login_fn; ?></p>
                                <!-- Status -->
                                <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
                            </div>
                        </div>

                        <!-- Sidebar Menu -->
                        <ul class="sidebar-menu">
                            <li class="header"><b>MENÚ PRINCIPAL</b></li>
                            <!-- Optionally, you can add icons to the links -->
                            <li><a href="procesos.php"><i class="fa fa-line-chart"></i> <span>Planeación Estratégica</span></a></li>
                            <li><a href="tablero.php"><i class="fa fa-bar-chart"></i> <span>Tablero de Indicadores</span></a></li>
                            <li><a href="showUser.php?id=
                        	<?php echo $id_user?>"><i class="fa fa-user"></i> <span>Mi Perfil</span></a></li>
                        </ul><!-- /.sidebar-menu -->
                    </section>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            Bienvenido, <?php echo $login_fn . " " . $login_ln; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active"><i class="fa fa-dashboard"></i> Inicio</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-lg-6 col-xs-6">
                                <div class="box box-solid box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Planeación Estratégica</h3>
                                        <div class="box-tools pull-right">
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                            <!-- Here is a label for example 
                                            <span class="label label-primary">Label</span>-->
                                        </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body" align="middle">
                                        <a href="procesos.php">
                                            <img src="php/dist/img/Planeacion.png" height="220" alt="Process Map"/>
                                        </a>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer" align="center">
                                        Consulte aquí la información de la institución.
                                    </div><!-- box-footer -->
                                </div><!-- /.box -->
                            </div><!-- col 1 -->
                            <div class="col-lg-6 col-xs-6">
                                <div class="box box-solid box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tablero de Indicadores</h3>
                                        <div class="box-tools pull-right">
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                        </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body" align="middle">
                                        <a href="#">
                                            <img  src="php/dist/img/tablero.png" height="220" alt="Indicators report"/>
                                        </a>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer" align="center">
                                        Consulte aquí todos los indicadores de la institución.
                                    </div><!-- box-footer -->
                                </div><!-- /.box -->
                            </div><!-- col 2 -->
                        </div><!-- row -->

                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->

                <!-- Main Footer -->
                <footer class="main-footer">
                    <!-- To the right 
                    <div class="pull-right hidden-xs">
                      Anything you want
                    </div> -->
                    <!-- Default to the left -->
                    <strong>Copyright &copy; 2015 <a href="http://www.gygsistemas.org/gc/gc_j/index.php" target="_blank">Colegio Grancolombiano</a>.</strong> Todos los derechos reservados.
                </footer>

            </div><!-- ./wrapper -->

            <!-- REQUIRED JS SCRIPTS -->

            <!-- jQuery 2.1.4 -->
            <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
            <!-- Bootstrap 3.3.2 JS -->
            <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <!-- AdminLTE App -->
            <script src="php/dist/js/app.min.js" type="text/javascript"></script>

            <!-- Optionally, you can add Slimscroll and FastClick plugins.
                  Both of these plugins are recommended to enhance the
                  user experience. Slimscroll is required when using the
                  fixed layout. -->
        </body>
    </html>
    <?php
}