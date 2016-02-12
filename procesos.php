<?php
require ('php/connDB.php');
include ('php/session.php');
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
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
    <title>Colegio Grancolombiano | Planeación</title>
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
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

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
                  <img src="dist/img/unknown.gif" class="user-image" alt="User Image" />
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $login_fn . " " . $login_ln; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/unknown.gif" class="img-circle" alt="User Image" />
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
              <img src="dist/img/unknown.gif" class="img-circle" alt="User Image" />
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
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Información</li>
          </ol>
        </section>

   <!-- Main content -->
		<section class="content">
			<!-- Info-->
			<h2 class="page-header">Misión y Visión Institucional</h2>			
			<div class="box box-default color-palette-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Misión</h3>
                </div><!-- /.box-header -->
					<div class="box-body">
						Como colegio Distrital de la localidad de Bosa y que ofrece los niveles de preescolar, Básica y Media, Técnica
						articulada con la Educación Superior, en las especialidades de Diseño Gráfico y Mecatrónica,  la institución se propone
						contribuir con su acción a la formación de niños, niñas y jóvenes con calidad humana, entendida ésta como el conjunto
						de actitudes positivas, valores y competencias – personales, básicas, ciudadanas y laborales – que les permitan incidir
						positivamente en su comunidad, participar en procesos democráticos y vincularse al mundo productivo, teniendo como
						referente de sus acciones el respeto a los Derechos Humanos.
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			<div class="box box-default color-palette-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Visión</h3>
                </div><!-- /.box-header -->
					<div class="box-body">
						En el 2020 el Colegio Grancolombiano, posicionado a nivel local como la mejor opción de formación y reconocido por la calidad y
						pertinencia de su formación Básica y Media Técnica, habrá logrado ubicarse en nivel superior en las pruebas externas,
						manteniendo y mejorando  la calidez y oportunidad de la atención a los distintos usuarios, la competencia y calidad de sus
						docentes, la transparencia y calidad de sus procesos organizativos, académicos y de gestión de comunidad, contribuyendo a la
						sociedad con egresados competentes laboralmente y ciudadanos que inciden positivamente en su comunidad, haciendo un adecuado 
						ejercicio de la ética de lo público.
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			<!-- Image-->
			<h2 class="page-header">Mapa de procesos</h2>
			<div class="box box-default color-palette-box">
          	<div class="box-body">
					<div>
						<img src="pics/mapa.jpg" width="100%" alt="Mapa de procesos">
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
			<!-- END Image-->
          <div class="row">
            <div class="col-md-6">
			<h2 class="page-header">Objetivos estratégicos</h2>			
              <div class="box box-solid">
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseO1">
                            Objetivo 1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseO1" class="panel-collapse collapse in">
                        <div class="box-body">
                          Definir e implementar políticas institucionales  enmarcadas dentro de una filosofía de mejoramiento continuo y 
                          servicio de calidad,  que permitan el cumplimiento de la misión y el alcance de la visión.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseO2">
                            Objetivo 2
                          </a>
                        </h4>
                      </div>
                      <div id="collapseO2" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseO3">
                            Objetivo 3
                          </a>
                        </h4>
                      </div>
                      <div id="collapseO3" class="panel-collapse collapse in">
                        <div class="box-body">
                          Adelantar acciones orientadas a la construcción de compromiso, identidad y sentido de pertenencia, dirigidas a los 
                          distintos estamentos de la Comunidad Educativa.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseO4">
                            Objetivo 4
                          </a>
                        </h4>
                      </div>
                      <div id="collapseO4" class="panel-collapse collapse in">
                        <div class="box-body">
                          Contribuir al mejoramiento de procesos, a la construcción de un clima de trabajo armónico, al fortalecimiento de 
                          los valores considerados institucionales.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseO5">
                            Objetivo 5
                          </a>
                        </h4>
                      </div>
                      <div id="collapseO5" class="panel-collapse collapse in">
                        <div class="box-body">
                          Administrar de manera eficiente y transparente los bienes del estado para generar confianza y credibilidad en la 
                          educación pública.
                        </div>
                      </div>
                    </div>

                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
			<h2 class="page-header">Áreas Clave</h2>			
              <div class="box box-solid">
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA1">
                            Área 1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA1" class="panel-collapse collapse in">
                        <div class="box-body">
                          Definir e implementar políticas institucionales  enmarcadas dentro de una filosofía de mejoramiento continuo y 
                          servicio de calidad,  que permitan el cumplimiento de la misión y el alcance de la visión.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA2">
                            Área 2
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA2" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA3">
                            Área 3
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA3" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA4">
                            Área 4
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA4" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA5">
                            Área 5
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA5" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA6">
                            Área 6
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA6" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseA7">
                            Área 7
                          </a>
                        </h4>
                      </div>
                      <div id="collapseA7" class="panel-collapse collapse in">
                        <div class="box-body">
                          Diseñar e implementar un sistema de gestión en coherencia con los sistemas administrativo y de control de la SED 
                          para ofrecer calidad, y transparencia en los procesos que el colegio adelanta.
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
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
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
</html>
<?php } ?>