<?php
require ('php/connDB.php');
include ('php/session.php');
include ('php/importVal.php');
include 'php/functions.php';

if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
} else {

    if (isset($_GET['userId'])){
        $userId = $_GET['userId'];
        $indicator_type= $_GET['indicatorType'];
        $users_chart_data = ['user_id' => 0 ,'cycle'  => 0 ,'jornada' => 0];

    }else{
        $userId = "";
        $indicator_type= $_GET['indicatorType'];
        $users_chart_data = ['user_id' => 0 ,'cycle'  => 0 ,'jornada' => 0];
    }?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Colegio Grancolombiano | Indicadores</title>
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
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- Select2 -->
        <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="php/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <!--    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />-->
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
                        <li><a href="tablero.php"><i class="fa fa-bar-chart"></i>
                            <span>Tablero de Indicadores</span></a>
                    <?php } else { ?>
                        <li><a href="tablero.php"><i class="fa fa-bar-chart"></i>
                                <span>Tablero de Indicadores</span></a>
                        <li><a href="showUser.php?id=<?php echo $id_user ?>"><i class="fa fa-user"></i>
                                <span>Mi Perfil</span></a></li>
                    <?php } ?>

                    </li>
                    <?php if ($login_usertype == 0) { ?>
                        <li><a href="logs.php"><i class="fa fa-shield"></i> <span>Reportes de actividad</span></a></li>
                    <?php } ?>
                </ul>
                <!-- /.sidebar-menu -->
                <!-- Sidebar Menu -->

            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php
                    if (!empty($userId)){
                        $nq = "select `first_name`, `last_name` from usuarios where id_usuario=".$userId;
                        $r = mysql_fetch_assoc(mysql_query($nq,$link));
                        echo "Indicador ".$codigo." :".$r['first_name']." ".$r['last_name'];
                    } else {
                        echo "Indicador".$codigo.":".$nombre;
                    }
                    ?>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li><a href="#">Tablero</a></li>
                    <li class="active"><a href="#"><?php echo $codigo; ?></a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default color-palette-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Descripción</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo $descrip; ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.column -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <row>
                                    <h3 class=" col-lg-9 box-title" style="padding-top:2%;text-align: center; ">Tendencia del indicador</h3>
                                    <div class="col-lg-3 ">
                                        <div class="info-box" style="min-height: 50px;">
                                            <span class="info-box-icon bg-green" style="
                                  height: 55px;
                                  width: 55px;
                                  font-size: 2em;
                                  line-height: 55px;
                            "><i class="fa fa-flag-o"></i></span>
                                            <div class="info-box-content" style="margin-left: 50px;">
                                                <span class="info-box-text">Meta del Indicador</span>
                                            <span class="info-box-number"><?php
                                                if (isset($_GET['indicatorGoal'])){
                                                    echo $_GET['indicatorGoal'];
                                                } else{
                                                    echo "No hay meta definida para este indicador";
                                                }
                                                ?>
                                            </span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div>
                                </row>
                                <row>
                                    <span class="info-box col-sm-12-offset-2 "><?php
                                        if ($indicator_type == '1' and !isset($_GET['userId'])){?>
                                           <div class="pull-right">
                                               <label for="chartSummaryType"> Calcular por: </label>
                                               <select id="chartSummaryType" >
                                                   <option value="global" selected >Global</option>
                                                   <option value="ciclo" >Ciclo</option>
                                                   <option value="jornada">Jornada</option>
                                               </select>
                                           </div>

                                        <?php }
                                        ?>
                                    </span>
                                </row>

                            </div><!-- /.box-header -->
                            <div class="box-body">

                                <div class="row">
                                    <div class="chart" id="chart-container">
                                        <canvas id="canvas" height="250" width="400"></canvas>
                                    </div>
                                </div>
                                <div id = "warning-message-user" class="message-pading col-lg-12 " hidden>
                                    <div class="box box-solid box-warning" >
                                        <div class="box-header" >
                                            <h3 class="box-title" > Datos Insuficientes </h3 >
                                        </div ><!-- /.box - header-->
                                        <div class="box-body" >
                                            Aún no hay datos asociados a este usuario.
                                        </div ><!-- /.box - body-->
                                    </div >
                                </div >
                                <div id = "warning-message-global" class="message-pading col-lg-12 " hidden>
                                    <div class="box box-solid box-warning" >
                                        <div class="box-header" >
                                            <h3 class="box-title" > Datos Insuficientes </h3 >
                                        </div ><!-- /.box - header-->
                                        <div class="box-body" >
                                            Aún no hay datos asociados a este indicador.
                                        </div ><!-- /.box - body-->
                                    </div >
                                </div >
                                <div id = "warning-message-db" class="message-pading col-lg-12 " hidden>
                                    <div class="box box-solid box-danger" >
                                        <div class="box-header" >
                                            <h3 class="box-title" > Error </h3 >
                                        </div ><!-- /.box - header-->
                                        <div class="box-body" >
                                            No hay accesso a la base de datos.
                                            Por favor, intente de nuevo ingresando desde la tabla de indicadores.
                                        </div ><!-- /.box - body-->
                                    </div >
                                </div >
                            </div><!-- /.box-body -->
                        </div>
                        <div class="box">
                            <?php if ($indicator_type == 0){?>
                            <div class="box-header">
                                <a href="addValue.php?id=<?php echo $_GET['id']; ?>&indicatorType=<?php echo $indicator_type; ?>&formulaId=<?php echo $_GET['formulaId']; ?>" class="btn btn-info pull-right">Agregar</a>
                            </div> <!-- /.box-header -->
                            <?php } ?>
                            <?php if ($indicator_type == "1" and !empty($userId) ){?>
                                <div class="box-header">
                                    <a href="addValue.php?id=<?php echo $_GET['id']; ?>&indicatorType=<?php echo $indicator_type; ?>&formulaId=<?php echo $_GET['formulaId']; ?>&userId=<?php echo $userId; ?>" class="btn btn-info pull-right">Agregar</a>
                                </div> <!-- /.box-header -->
                            <?php } ?>

                            <div class="box-body">
                                <?php
                                    if($indicator_type == "1"){
                                     // Indicator type 1, general view
                                    // fetch all the users for this indicator and show them in a table.
                                        if(!isset($_GET['userId'])){
                                            $query = 'SELECT * FROM usuarios WHERE linked_indicators like "%'.$valores['indicator_cod'].'%"';
                                            $result = mysql_query($query , $link);
                                            if ($result) { ?>
                                                <table id="tablaInd" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nombre</th>
                                                        <th>Cargo</th>

                                                        <?php	if ($login_usertype == 0) {?>
                                                            <th>Ver Indicador del usuario</th> <?php } ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i = 1; while($linked_users = mysql_fetch_array($result)){


                                                        if ( empty($users_chart_data['user_id']) and empty($users_chart_data['cycle'])  and empty($users_chart_data['jornada'])){
                                                            if(empty($linked_users['id_usuario'])){$linked_users['id_usuario'] = "NULL";}
                                                            if(empty($linked_users['cycle'])){$linked_users['cycle'] = "NULL";}
                                                            if(empty($linked_users['labour_time'])){$linked_users['labour_time'] = "NULL";}

                                                            $users_chart_data ['user_id'] = $linked_users['id_usuario'];
                                                            $users_chart_data ['cycle'] = $linked_users ['cycle'];
                                                            $users_chart_data ['jornada'] = $linked_users ['labour_time'];
                                                        }else{
                                                            if(empty($linked_users['id_usuario'])){$linked_users['id_usuario'] = "NULL";}
                                                            if(empty($linked_users['cycle'])){$linked_users['cycle'] = "NULL";}
                                                            if(empty($linked_users['labour_time'])){$linked_users['labour_time'] = "NULL";}

                                                            $users_chart_data ['user_id'] = $users_chart_data ['user_id'].", ".$linked_users['id_usuario'];
                                                            $users_chart_data ['cycle'] = $users_chart_data ['cycle'].", ".$linked_users['cycle'];
                                                            $users_chart_data ['jornada'] =$users_chart_data ['jornada'].", ".$linked_users ['labour_time'];
                                                        }

                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $linked_users['first_name']." ".$linked_users['last_name']; ?></td>
                                                            <td><?php echo $linked_users['occupation']; ?></td>
                                                            <?php	if ($login_usertype != 2 ){
                                                                $qs=$_SERVER['QUERY_STRING'];
                                                                $qs =  $qs.'&userId='.$linked_users['id_usuario'];
                                                            ?>
                                                                <td><a target="_blank" class="btn  btn-primary" href="./showInd.php?<?php echo $qs; ?>"> Ver Usuario</a></td>
                                                            <?php } $i++;
                                                            ?>
                                                        </tr>
                                                    <?php } ?>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nombre</th>
                                                        <th>Cargo</th>
                                                        <?php	if ($login_usertype == 0) {?>
                                                            <th>Ver Indicador del usuario</th> <?php } ?>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            <?php } else { ?>
                                                <h3 class="box-title">No hay Usuarios asociados a este indicador.</h3>
                                           <?php } ?>
                                        <?php
                                        }else {
                                            // Indicator type 1, individual view
                                            $query = 'select * from indicatorvalues where  indicator_id ="'.$_GET['id'].'" and user_id="'.$userId.'"';
                                            $result = mysql_query($query , $link);
                                        ?>
                                            <table id="tablaInd" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Fecha</th>
                                                    <th>Valor</th>
                                                    <?php	if ($login_usertype == 0) {?>
                                                        <th>Eliminar valor</th> <?php } ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1; while($v = mysql_fetch_assoc($result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $v['value_date']; ?></td>
                                                        <td><?php echo $v['value_ind']; ?></td>
                                                        <?php	if ($login_usertype == 0) {?>
                                                        <td>
                                                            <button class="btn btn-md btn-primary delete-button"
                                                                    data-toggle="modal"
                                                                    data-id="<?php echo $v['value_id']; ?>"
                                                                    data-value="<?php echo $v['value_ind']; ?>"
                                                                    >
                                                                <i class="fa fa-trash-o"> Eliminar</i>
                                                            </button>
                                                        </td>
                                                            <?php }
                                                            $i++;
                                                            ?>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Fecha</th>
                                                    <th>Valor</th>
                                                    <?php	if ($login_usertype == 0) {?>
                                                        <th>Eliminar</th> <?php } ?>
                                                </tr>
                                                </tfoot>
                                            </table>

                                    <?php }
                                    } else{
                                        //Indicator type 0, general view
                                        ?>
                                        <table id="tablaInd" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Fecha</th>
                                                <th>Valor</th>
                                                <?php	if ($login_usertype == 0) {?>
                                                    <th>Eliminar valor</th> <?php } ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; while($v = mysql_fetch_assoc($q)){?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $v['value_date']; ?></td>
                                                    <td><?php echo $v['value_ind']; ?></td>
                                                    <?php	if ($login_usertype == 0) {?>
                                                        <td>
                                                            <button class="btn btn-md btn-primary delete-button"
                                                                    data-id="<?php echo $v['value_id']; ?>"
                                                                    data-value="<?php echo $v['value_ind']; ?>"
                                                                    >
                                                                <i class="fa fa-trash-o"> Eliminar</i>
                                                            </button>
                                                        </td>
                                                    <?php } $i++;
                                                    ?>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Fecha</th>
                                                <th>Valor</th>
                                                <?php	if ($login_usertype == 0) {?>
                                                    <th>Eliminar valor</th> <?php } ?>
                                            </tr>
                                            </tfoot>
                                        </table>
                                   <?php }  ?>

                                <!--
                                Indicator deletion Modal
                                 -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                     aria-labelledby="deleteusermodal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar Valor </h4>
                                            </div>
                                            <div class="modal-body">
                                                <h2> ¿ Desea eliminar esta entrada con valor : <b id="indicator-value">   </b>  del sistema
                                                    ?</h2>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-right margin-2"
                                                        data-dismiss="modal">Cancelar
                                                </button>
                                                <button type="submit" id="modal-accept-button" class="btn btn-warning pull-right margin-2">
                                                        confirmar
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="messageModal" tabindex="-1" role="dialog"
                                     aria-labelledby="message delete user modal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar Usuario</h4>
                                            </div>
                                            <div class="modal-body" id="success-message" hidden>
                                                <div class="alert alert-success alert-dismissible">

                                                    <h4><i class="icon fa fa-check"></i></h4>
                                                    El Indicador se ha eliminado correctamente

                                                </div>
                                            </div>
                                            <div class="modal-body" id="error-message" hidden>
                                                <div class="alert alert-warning alert-dismissible">

                                                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                                    Hubo un problema al borrar el valor asociado a este indicador. Por favor comuniquese con el
                                                    equipo de TI.

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                        aria-hidden="true" onclick="location.reload(true)">Cerrrar
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.column -->
                </div><!-- /.row -->
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
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="php/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="php/dist/js/demo.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <script src="plugins/chartjs/Chart.js" type="text/javascript"></script>
    <!-- Page script -->
    <script src="js/renderChart.js" type="text/javascript"></script>


        <script>

        $(document).ready(function() {

            loadChart();
            $("#chartSummaryType").change(function () {
                loadChart();
            });
            $(".delete-button").on("click", function () {
                var id = $(this).data('id');
                var value = $(this).data('value');
                $("#indicator-value").append(value);
                $("#modal-accept-button").attr("onclick", "deleteIndicatorValue("+id+")");
                $("#deleteModal").modal("show");


            });

        });
       // Render Chart function.
        function loadChart(){
            var indicatorType = <?php  echo $indicator_type;?>;
            if (typeof $("#chartSummaryType").val()  != "undefined"){
                var summaryType = $("#chartSummaryType").val();
            }else {
                var summaryType = "individual";
            }

            if (indicatorType == 0){
                var param = {
                    'indicatorId' : "<?php echo $_GET['id']; ?>",
                    'indicatorType' : indicatorType,
                    'chartType' :"<?php echo $_GET['chartType'];?>",
                    'userId' :"<?php echo $userId;?>"
                };
            } else {
                var param = {

                    'indicatorId' : "<?php echo $_GET['id']; ?>",
                    'indicatorType' : indicatorType,
                    'chartType' :"<?php echo $_GET['chartType'];?>",
                    'userId' :"<?php echo $userId;?>",
                    'summaryType': summaryType,
                    'chartData_users':"<?php echo $users_chart_data['user_id'] ;?>",
                    'chartData_cycle':"<?php echo $users_chart_data['cycle'] ;?>",
                    'chartData_jornada':"<?php echo  $users_chart_data['jornada'] ;?>"
                };
            }

            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'processChart.php', //
                data        : param, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
                .done(function(data) {

                    if(data.success){

                        renderChart(data.message);
                    }
                    if (data.errors){

                        if (data.errors.empty_result_user){
                            $("#canvas").hide();
                            $("#warning-message-user").show();
                        }
                        if(data.errors.empty_result) {
                            $("#canvas").hide();
                            $("#warning-message-global").show();
                        }
                        if(data.errors.db) {
                            $("#canvas").hide();
                            console.log(data.errors.db);
                            $("#warning-message-db").show();
                        }
                    }


                });
        }

        // Delete an Indicator Value.
        function deleteIndicatorValue(idValue) {
            console.log(idValue);
            var data = { id : idValue };
            // process the form
            $.ajax({
                type: 'POST',
                url: 'deleteIndicatorValue.php',
                data: data,
                dataType: 'json',
                encode: true
            })

                .done(function (data) {


                    console.log(data);


                    if (!data.success) {

                        if (data.errors.id) {
                            $('#deleteModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#error-message').show();
                        }

                    } else {

                        //all good.

                        $('#deleteModal').modal('hide');
                        $('#messageModal').modal('show');
                        $('#success-message').show();

                    }

                });



    }
    </script>

    </body>
    </html>
<?php } ?>