<?php
require ('php/connDB.php');
include ('php/session.php');
include ('php/importVal.php');
include 'php/functions.php';
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
} else {

?>
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
                </ul><!-- /.sidebar-menu -->
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
                                            ?></span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div>
                        </row>

                </div><!-- /.box-header -->
                <div class="box-body">

                	<div class="row">
					<div class="chart">
                    	<canvas id="canvas" height="250" width="400"></canvas>
                  	</div>
                  	</div>
                  </div><!-- /.box-body -->
			  </div>
              <div class="box">
                <div class="box-header">
                    <a href="addValue.php?id=<?php echo $_GET['id']; ?>&indicatorType=<?php echo $_GET['indicatorType']; ?>&formulaId=<?php echo $_GET['formulaId']; ?>" class="btn btn-info pull-right">Agregar</a>
                </div> <!-- /.box-header -->
                <div class="box-body">
                  <?php if($num>0) {?>
                  <table id="tablaInd" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Fecha</th>
                        <th>Valor</th>
<?php	if ($login_usertype == 0) {?>
			          <th>Editar valor</th> <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
					<?php $i = 1; while($v = mysql_fetch_assoc($q)){?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $v['value_date']; ?></td>
                        <td><?php echo $v['value_ind']; ?></td>
<?php	if ($login_usertype == 0) {?>
	                    <td><a target="_blank" class="btn btn-block btn-primary" href="editValue.php?valueId=<?php echo $v['value_id']; ?>&indicatorType=<?php echo $_GET['indicatorType']; ?>&indicatorId=<?php echo $_GET['id']; ?>&formulaId=<?php echo $_GET['id']; ?>" style="width: 100px">Editar</a></td>
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
                        <th>Editar valor</th> <?php } ?>
                      </tr>
                    </tfoot>
                  </table>
                      <?php } else { ?>
            				<h3 class="box-title">No hay valores para este indicador.</h3>
                      <?php } ?>   
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
            var param = {
                'indicatorId' : "<?php echo $_GET['id']; ?>",
                'indicatorType' : "<?php  echo $_GET['indicatorType'];?>",
                'chartType' :"<?php echo $_GET['chartType'];?>" };
            var chart_data;

            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'processChart.php', //
                data        : param, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
            .done(function(data) {
                    console.log(data.message);
                    renderChart(data.message);
            });

        });


    </script>

  </body>
</html>
<?php } ?>