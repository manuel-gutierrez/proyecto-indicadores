<?php
/**
 * User: Manuel
 * Date: 2/19/2016
 * Time: 4:01 PM
 * File that allow change the users pasword
 */

require ('php/connDB.php');
include ('php/session.php');
include ('php/functions.php');



    // Session control

    $ses_sql=mysql_query("SELECT * FROM areas", $link);
    if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
        header("Location: index.php"); //Redirige al login.php
     } else {
        // Validate Get parameter
        if ($_GET["id"]) {
            $query_id = $_GET["id"];

            // Fetch Data.
            $q = mysql_query("SELECT * FROM usuarios WHERE id_usuario=$query_id", $link);

            $valores = mysql_fetch_assoc($q);
            $correo = $valores['email'];

            }
        else {
            echo "Error: Parametro id en peticion GET vacio. ";
            // Redirecciona a  la pagina 404.
        }
    }?>
    <!-- Begging of content -->
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Colegio Grancolombiano | Tablero Indicadores</title>

        <link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="pics/apple-touch-icon.png" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="bootstrap/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="php/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="php/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
        <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>

        <![endif]-->
        <style>
            html, body {
                height: 100%;
            }
        </style>
    </head>

    <body class="skin-blue sidebar-mini">
    <div class="wrapper" style="height:100%">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="<?php
            if ($login_usertype == 0) {echo "inicio.php";
            } else {echo "inicio1.php";
            }
            ?>" class="logo">
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
                                        Cargo: <?php echo strtoupper ("$login_occupation"); ?>
                                        <small><?php
                                            if ($login_usertype == 0) {echo "Administrador";
                                            } else {echo "";
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
                    <?php if ($login_usertype==0) {?>
                        <li>
                            <a href="areas.php"><i class="fa fa-sitemap"></i> <span>Áreas clave </span> <i class="fa fa-angle-left pull-right"></i></a>
                        </li>
                        <li>
                            <a href="objetivos.php"><i class="fa fa-server"></i> <span>Objetivos Estratégicos </span> <i class="fa fa-angle-left pull-right"></i></a>
                        </li>
                        <li><a href="users.php"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
                    <?php } ?>
                    <li><a href="tablero.php"><i class="fa fa-bar-chart"></i> <span>Tablero de Indicadores</span></a></li>
                    <?php if ($login_usertype==0) {?>
                        <li><a href="logs.php"><i class="fa fa-shield"></i> <span>Reportes de actividad</span></a></li>
                    <?php } ?>


                    <?php if ($login_usertype !=0) {?>
                        <li><a href="showUser.php?id=
                        <?php echo $id_user?>"><i class="fa fa-user"></i> <span>Mi Perfil</span></a></li>
                    <?php }?>

                </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <h3 class="box-title">Cambiar Clave</h3>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Usuarios</li>
            <li class="active"><?php echo $login_ln;?></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
         <div class="box-header with-border">
             <div class="box-info">

                 <!-- Process form-->
                 <?php
                 if($_SERVER['REQUEST_METHOD']=='POST'){

                     //Data Validation
                     if(!empty($_POST['password'])){
                         // Parse data
                         $userId = trim($_GET["id"]," ");
                         $updated_password = $_POST['password'];
                         $updated_password = SHA1($updated_password);

                         $sql = "";

                         $sql = "UPDATE `usuarios`
                        SET
                        `contrasena` =  '$updated_password'
                        WHERE `id_usuario` =  '$userId'";

                         if (mysql_query($sql)) {
                             // Success Message
                             echo '
                            <!-- Success Message            -->
                            <div id = "success-message" class="message-pading col-lg-12 " >
                                <div class="box box-solid box-success" >
                                    <div class="box-header" >
                                        <h3 class="box-title" > Processo exitoso . </h3 >
                                        </div ><!-- /.box - header-->
                                        <div class="box-body" >
                                            La clave a sido cambiada.
                                        </div ><!-- /.box - body-->
                                    </div >
                                </div >
                            ';
                             // Log in Database
                             reportes_action(
                                 [
                                     0 => 'editar usuario',
                                     1 => 'changePassword',
                                     2 => "El usuario ".$login_fn." ".$login_ln." editó el password del usuario con ID: ".$userId,
                                 ]);

                         } else {
                             // Error message
                             echo '
                                <!-- Error Message      -->
                                <div id="error-message" class="message-pading col-md-12 ">
                                    <div class="box box-solid box-warning">
                                        <div class="box-header">
                                            <h3 class="box-title">Error.  </h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            El usuario no pudo ser modificado. Por favor contactarse con el equipo de TI.
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                                ';
                             //Log in Database
                             reportes_action(
                                 [
                                     0 => 'editar usuario',
                                     1 => 'editUser',
                                     2 => "Ocurrio un error al editar el usuario : ".$userId." con el siguiente error:". mysql_error,
                                 ]);
                         }
                     } else{
                         // Warning Message.
                         echo '<!-- Warning  Message      -->
                            <div id="warning-message" class="message-pading col-md-12 " >
                                <div class="box box-solid box-warning">
                                    <div class="box-header">
                                        <h3 class="box-title">Error.  </h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        Por favor ingrese su nueva contraseña, y vuelva a intentarlo de nuevo..
                                    </div><!-- /.box-body -->
                                </div>
                            </div>
                            ';
                     }?>
                 <?php }?>
             </div><!-- /.box-info -->

         </div><!-- /.box-header -->

        <div class="box-body">

            <form role="form" action="changePassword.php?id=<?php echo $_GET['id'];?>" method="post">

                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" class="form-control" placeholder="   " required/>
                </div>



        </div><!-- /.box-body -->

        <div class="box-footer">
            <a  class="btn btn-primary pull-left" onclick="javascript:history.go(-1)">Volver</a>
            <span class="margin-2 pull-right">
                    <button  type="submit" class="btn btn-success " href="./changePassword.php"><i class="fa fa-fw fa-save"></i> Guardar</button>
            </span>

        </div><!-- /.box-footer -->
        </form>


        </div><!-- /.box-body -->



        </div><!-- /.box -->
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
    </body>
    </html>
    <!-- End of content   -->
