<?php
require ('php/connDB.php');
include ('php/session.php');
include ('php/importVal.php');
include 'php/functions.php';
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
} else {
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
    } else {
        $userId = NULL;
    }  // Catch User ID
    {
    }?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Colegio Grancolombiano | Usuarios</title>
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

        <!--  Date Range Picker       -->


        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />




        <!-- Theme style -->
        <link href="php/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="php/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
    <div class="wrapper">

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
                                        Cargo: <?php echo "$login_occupation"; ?>
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
                    <li><a href="procesos.php"><i class="fa fa-line-chart"></i> <span>Planeación Estratégica</span></a>
                    </li>
                    <?php if ($login_usertype == 0) { ?>
                        <li>
                            <a href="areas.php"><i class="fa fa-sitemap"></i> <span>Áreas clave </span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        </li>
                        <li>
                            <a href="objetivos.php"><i class="fa fa-server"></i> <span>Objetivos Estratégicos </span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        </li>
                        <li><a href="users.php"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
                    <?php } else { ?>
                        <li><a href="showUser.php?id=<?php echo $id_user ?>"><i class="fa fa-user"></i>
                                <span>Mi Perfil</span></a></li>
                    <?php } ?>
                    <li><a href="tablero.php"><i class="fa fa-bar-chart"></i> <span>Tablero de Indicadores</span></a>
                    </li>
                    <?php if ($login_usertype == 0) { ?>
                        <li><a href="logs.php"><i class="fa fa-shield"></i> <span>Reportes de actividad</span></a></li>
                    <?php } ?>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Indicador <?php echo $codigo; ?>: <?php echo $nombre; ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
                    <li >Indicadores</li>
                    <li ><?php echo $codigo; ?></li>
                    <li class="active">Agregar valor</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <row class="col-lg-12">
                            <h3 class="box-title">Agregar valor a indicador</h3> </br> </br>
                        </row>

                        <row class="col-lg-12">
                            <div id = "success-message" class="message-pading col-lg-12 " hidden>
                                <div class="box box-solid box-success" >
                                    <div class="box-header" >
                                        <h3 class="box-title" > Proceso exitoso . </h3 >
                                    </div ><!-- /.box - header-->
                                    <div class="box-body" >
                                        Se ha agregado el valor del indicador satisfactoriamente.
                                    </div ><!-- /.box - body-->
                                </div >
                            </div >
                            <div id = "warning-message" class="message-pading col-lg-12 " hidden>
                                <div class="box box-solid box-warning" >
                                    <div class="box-header" >
                                        <h3 class="box-title" > Error en el proceso . </h3 >
                                    </div ><!-- /.box - header-->
                                    <div class="box-body" >
                                        Alguno de los campos esta vacio o con formato incorrecto.
                                    </div ><!-- /.box - body-->
                                </div >
                            </div >
                            <div id = "error-message" class="message-pading col-lg-12 " hidden>
                                <div class="box box-solid box-warning" >
                                    <div class="box-header" >
                                        <h3 class="box-title" > Error en el proceso . </h3 >
                                    </div ><!-- /.box - header-->
                                    <div class="box-body" >
                                        Hubo un error al agregar el valor del indicador a la base de datos. Comuniquese con el administrador del sistema.
                                    </div ><!-- /.box - body-->
                                </div >
                            </div >
                        </row>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!--  Select type of input Section     -->
                        <section>

                            <div class="row col-lg-12" style=" font-size: medium;">
                                <div class="form-group ">
                                    <label for="formula" class="col-md-12 col-md-offset-1 inline" >Método de Ingreso </label>
                                    <div class="col-md-4 inline" >
                                        <span class="col-md-4 inline"> <input  type="radio"   name="toggle" value="totalValue" checked> Valor Total</span>
                                       <?php if ($_GET['formulaId'] !=0 ) {?>
                                        <span class="col-md-4 inline"> <input  type="radio"   name="toggle" value="formula"> Formula</span>
                                       <?php }?>
                                    </div>
                                </div>
                            </div>

                        </section>

                        <!--  Total  Value  Form Section     -->
                        <section class="section-container" id="totalValueSection">
                            <div class="col-md-12 box box-primary form-container"  >
                                <form class="form-horizontal" action="processIndicatorValue.php" method="post" >
                                    <div >
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="date" class="col-md-2 ">Fecha</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                    echo date('Y-m-d H:i:s');
                                                    ?>" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="value" class="col-md-2 ">Valor</label>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" name="value" id="value" placeholder="Ingrese un valor">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-md-10">
                                        <a href="tablero.php" class="btn btn-default">Volver al tablero</a>
                                        <button type="submit" class="btn btn-info pull-right">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </section>
                        <!--  Dynamic  Value  Form Section     -->
                        <section id="formulaSection" class="section-container" hidden>
                            <div class="col-md-12  box box-primary form-container">
                                <form class="form-horizontal" action="processIndicatorValue.php" method="post"  id="formulaForm" >


                                    <!-- Add indicator by formula-->
                                    <div >
                                        <?php
                                        // Verify Parameter.

                                        if (!isset($_GET['formulaId'])){ echo('<div id = "warning-message" class="message-pading col-lg-12 ">
                <div class="box box-solid box-warning" >
<div class="box-header" >
    <h3 class="box-title" > Advertencia. </h3 >
    </div ><!-- /.box - header-->
    <div class="box-body" >
        Este indicador no tiene ninguna formula asociada
    </div ><!-- /.box - body-->
</div >');
                                        }else{
//All ok, then render form.
                                            $formulaId=$_GET['formulaId'];
                                            ?>
                                            <?php if ($formulaId=="1"){?>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="date" class="col-md-12 ">Fecha :</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                                echo date('Y-m-d H:i:s');
                                                                ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="numero-de-excelentes" class="col-md-12 ">Numero de exelentes: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_e" value="" class="form-control" placeholder="numero de exelentes">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="numero-de-buenos" class="col-md-12 ">Numero de buenos: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_b" value="" class="form-control" placeholder="numero de buenos">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="n_r" class="col-md-12 ">Numero de regulares: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_r" value="" class="form-control" placeholder="numero de regulares">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="n_m" class="col-md-12 ">Numero de malos: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_m" value="" class="form-control" placeholder="numero de malos">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="n_mm" class="col-md-12 ">Numero de exelentes: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_mm" value="" class="form-control" placeholder="numero de muy malos">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">

                                                            <div class="col-md-12">
                                                                <input type="hidden" name="formulaId" value="<?php echo $_GET['formulaId']?>" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php }?>
                                            <?php if ($formulaId=="2"){
                                                // Calculo de Eficiencia
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="date" class="col-md-12 ">Fecha :</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                                echo date('Y-m-d H:i:s');
                                                                ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="numero-actividades-realizadas" class="col-md-12 ">Numero de Actividades Realizadas:</label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="numero-actividades-realizadas" value="" class="form-control" placeholder="numero-actividades-realizadas">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="numero-actividades-programadas" class="col-md-12 ">Numero de Actividades Programadas: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="numero-actividades-programadas" value="" class="form-control" placeholder="numero-actividades-programadas">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">

                                                            <div class="col-md-12">
                                                                <input type="hidden" name="formulaId" value="<?php echo $_GET['formulaId']?>" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            <?php if ($formulaId=="3"){
                                                //Escala visual analógica
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="date" class="col-md-12 ">Fecha :</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                                echo date('Y-m-d H:i:s');
                                                                ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="formulaId" value="<?php echo $_GET['formulaId']?>" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 form-group" style="left: 50px; top: 50px;">
                                                            <i class="fa fa-frown-o fa-3x"></i>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <label for="satisfactionScale">Escala de Satisfacción</label>

                                                            <input type="range" name="satisfacionScale" id="satisfacionScale" min="0" max="100" value="50"  step="10"  oninput="outputUpdate(value)">
                                                            <datalist id="satisfactionSettings">
                                                                <option>0</option>
                                                                <option>10</option>
                                                                <option>20</option>
                                                                <option>30</option>
                                                                <option>40</option>
                                                                <option>50</option>
                                                                <option>60</option>
                                                                <option>70</option>
                                                                <option>80</option>
                                                                <option>90</option>
                                                                <option>100</option>
                                                            </datalist>
                                                        </div>
                                                        <div class="col-md-2 form-group" style="right: 60px; top: 50px;">
                                                            <i class="fa fa-smile-o fa-3x"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            <?php if ($formulaId=="4"){
                                                //Cálculo de calidad
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="date" class="col-md-12 ">Fecha :</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                                echo date('Y-m-d H:i:s');
                                                                ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="n_o" class="col-md-12 ">Número  Oportunidad:</label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_o" value="" class="form-control" placeholder="numero oportunidad ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="t_o" class="col-md-12 ">Total  Oportunidad:</label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="t_o" value="" class="form-control" placeholder="total oportunidad ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="n_p" class="col-md-12 ">Número  Presentacion: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_p" value="" class="form-control" placeholder="numero presentacion">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="t_p" class="col-md-12 ">Total Presentacion: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="t_p" value="" class="form-control" placeholder="total presentacion">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="n_c" class="col-md-12 ">Número  completitud: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="n_c" value="" class="form-control" placeholder="numero completitud">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="t_c" class="col-md-12 ">Total  completitud: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="t_c" value="" class="form-control" placeholder="total completitud">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">

                                                            <div class="col-md-12">
                                                                <input type="hidden" name="formulaId" value="<?php echo $_GET['formulaId']?>" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            <?php if ($formulaId=="5"){

                                                ?>
                                                <div class="col-md-12" id ='form-5-div'>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="date" class="col-md-12 ">Fecha :</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                                echo date('Y-m-d H:i:s');
                                                                ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <h4 class="callout">Por favor, ingrese el número de estudiantes calificados y haga click en aceptar.</h4>

                                                            <div class="col-md-12">
                                                                <span class="col-md-8 inline"><input type="number" min="0" id="number-of-inputs" name="n_e" value="" class="form-control" placeholder="Numero de estudiantes"></span>
                                                                <span class="col-md-4 inline"><a class="btn btn-info pull-right" id="add-input-button" >Aceptar</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 box" id="marks-section-form-5" style="padding-left: 0">

                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">

                                                            <div class="col-md-12">
                                                                <input type="hidden" name="formulaId" value="<?php echo $_GET['formulaId']?>" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            <?php }?>
                                            <?php if ($formulaId=="6"){
                                                // Calculo de Eficiencia
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="date" class="col-md-12 ">Fecha :</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="date" value="<?php setlocale(LC_TIME, 'es_CO');
                                                                echo date('Y-m-d H:i:s');
                                                                ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="inventarios-disponibles-actualizados" class="col-md-12 ">Inventarios disponibles actualizados:</label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="inventarios-disponibles-actualizados" value="" class="form-control" placeholder="Inventarios dsiponibles actualizados">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="total-inventarios" class="col-md-12 ">Total Inventarios: </label>
                                                            <div class="col-md-12">
                                                                <input type="number" name="total-inventarios" value="" class="form-control" placeholder="total Inventarios">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">

                                                            <div class="col-md-12">
                                                                <input type="hidden" name="formulaId" value="<?php echo $_GET['formulaId']?>" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                    <div class="row col-md-12">
                                        <a href="showInd.php?id=<?php echo $query_id; ?>" class="btn btn-default">Cancelar</a>
                                        <button type="submit" class="btn btn-info pull-right">Agregar</button>

                                    </div>
                                </form>
                            </div>
                        </section>

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

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="php/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Date picker   -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript" src="./addValue.js"></script>
    <!-- page script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#add-input-button").click(function () {
                var n = $("#number-of-inputs").val();
                $('#marks-section-form-5').children().remove();
                createFormInputs(n);
            });
            //  Toggle content on radio buttons selection.

            $("input[name$='toggle']").click(function () {
                var test = $(this).val();
                if (test == "totalValue") {
                    $("#totalValueSection").show();
                    $("#formulaSection").hide();
                } else {
                    $("#totalValueSection").hide();
                    $("#formulaSection").show();
                }
            });

            // Date picker
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var output = d.getFullYear() + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                (day < 10 ? '0' : '') + day;
            <?php
              date_default_timezone_set('America/Bogota');
              $time = date("H:i:s");
            ?>

            $('input[name="date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'+' <?php echo $time;?>'
                },
                startDate: output
            });

            // process form
            $('#totalValueSection').submit(function(event) {

                event.preventDefault();

                var formData = {
                    'id': '<?php echo $_GET['id']?>',
                    'date': $('input[name=date]').val(),
                    'value': $('input[name=value]').val(),
                    'userId' : '<?php if (isset($_GET['userId'])){echo $_GET['userId'];}else { echo null ;}?>',
                    'action': 'add'
                };
                storeValueRequest(formData);
            });

            // Case user choose formula
            $('#formulaForm').submit(function(event) {



                event.preventDefault();
                // Calculate Value
                var formData = $(this).serializeArray();
                calculateValue (formData);

            });


        });

        function storeValueRequest(values){
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'processIndicatorValue.php', // the url where we want to POST
                data        : values,
                dataType    : 'json',
                encode      : true
            })
                // using the done promise callback
                .done(function(data) {

                    // Handle Error

                    if ( ! data.success) {
                        if (data.errors.Invalid_parameters){
                            $("#warning-message").show();
                            $("#success-message").hide();
                            $("#errror-message").hide();
                        }else{
                            $("#errror-message").show();
                            $("#warning-message").hide();
                            $("#success-message").hide();
                        }
                    } else {
                        $("#success-message").show();
                        $("#errror-message").hide();
                        $("#warning-message").hide();
                        //all good show success.
                        console.log(data.success);
                    }
                });

        }
        function calculateValue(formData){

            $.ajax({
                type        : 'POST',
                url         : 'processEquation.php',
                data        : formData,
                dataType    : 'json',
                encode      : true
            })
                // using the done promise callback
                .done(function(data) {
                    console.log(data);
                    // Handle Error
                    if ( data.success == false) {

                        if (data.errors.data_error){
                            $("#warning-message").show();
                            $("#success-message").hide();
                            $("#errror-message").hide();
                        }else{
                            $("#errror-message").show();
                            $("#warning-message").hide();
                            $("#success-message").hide();
                        }
                    } else {
                        console.log(data);
                        //all good , now store the data.

                        var formData = {
                            'id': '<?php echo $_GET['id']?>',
                            'date': data.message[0]['date'],
                            'value': data.message[0]['value'],
                            'userId' : '<?php echo  $userId; ?>',
                            'action': 'add'
                        };

                        storeValueRequest(formData);
                    }
                });
        }

    </script>
    </body>
    </html>
<?php } ?>