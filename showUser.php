<?php
require ('php/connDB.php');
include ('php/session.php');

if( $_GET["id"] ) {

	$query_id = $_GET["id"]; 
//	echo "$query_id";
}
else {
	echo "error en el get_id";
 // Redirecciona a  la pagina 404. 
}
$q = mysql_query("SELECT * FROM usuarios WHERE id_usuario=$query_id",$link);
$valores = mysql_fetch_assoc($q);
$area = $valores['area_id'];
$nombre = $valores['first_name'];
$apellido = $valores['last_name'];
$ocupacion = $valores['occupation'];
$correo = $valores['email'];

$ses_sql=mysql_query("SELECT * FROM areas", $link);
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
} else {

?>
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
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

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
            Usuario: <?php echo "$nombre"." "."$apellido";?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Usuarios</li>
            <li class="active"><?php echo $apellido;?></li>

          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Perfil del Usuario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="userEdit.php" method="post">
     	            <div class="row">
     	            <div class="col-md-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Nombres:</label>
                      <input type="text" name="fn" class="form-control" placeholder="<?php echo "$nombre";?>" />
                    </div>
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" name="ln"class="form-control" placeholder="<?php echo "$apellido";?>" />
                    </div>
                    <div class="form-group">
                      <label>Correo electrónico:</label>
                      <input type="text" name="email" class="form-control" placeholder="<?php echo "$correo";?>" />
                    </div>
                    </div>
     	            <div class="col-md-6">
                    <div class="form-group">
                      <label for="area"> Área: </label>
                      <select id="cmbArea" name="area" class="form-control">
                        <option value="0">Seleccione</option>
                        <?php
         					while($row = mysql_fetch_assoc($ses_sql)){
            				// $id=$row["id_expense"];  
            				$idArea = $row["area_id"];
							$nameArea = $row["area_name"];
        				?>
                        <option value= <?php echo $idArea; if ($area == $idArea) {?> selected="selected"<?php ;} ?>> <?php echo  $nameArea; ?> </option>
        				<?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Ocupación:</label>
                      <input type="text" class="form-control" placeholder="<?php echo "$ocupacion";?>" />
                    </div>
                    <div class="form-group">
                      <label>Contraseña:</label>
                      <input type="password" class="form-control" placeholder="********" />
                    </div>
                    </div>
                    </div>
                  </form>
                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="self.close()">Volver</button>
                    <a class="btn btn-primary" href="popup1.php?id=
                    <?php echo $query_id ?>" onclick="return popitup('popup1.php?id=<?php echo $query_id ?>')"
						>Guardar</a>
                    <a class="btn btn-info" href="popup2.php?id=
                    <?php echo $query_id ?>" onclick="return popitup('popup2.php?id=<?php echo $query_id ?>')"
						>Eliminar</a>

                  </div><!-- /.box-footer -->
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
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function popitup(url) {
	newwindow=window.open(url,'name','height=150,width=300');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>
</body>
</html>
<?php } ?>