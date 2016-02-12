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
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
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
        <a href="inicio.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>GC</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Indicadores</b>CGC</span>
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
            <li><a href="procesos.html"><i class="fa fa-link"></i> <span>Planeación Estratégica</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Áreas clave </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                 <li><a href="#">Área 1</a></li>
                <li><a href="#">Área 2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Objetivos Estratégicos </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">Objetivo 1</a></li>
                <li><a href="#">Objetivo 2</a></li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Tablero de Indicadores</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Reportes de actividad</span></a></li>            
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
                  <h3 class="box-title">Tendencia del indicador</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<div class="row">
					<div class="chart">
                    	<canvas id="canvas" height="250" width="500"></canvas>
                  	</div>
                  	</div>
                  </div><!-- /.box-body -->
			  </div>
              <div class="box">
                <div class="box-header">
                    <a href="addValue.php?id=<?php echo $query_id; ?>" class="btn btn-info pull-right">Agregar</a>
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
	                    <td><a target="_blank" class="btn btn-block btn-primary" href="editValue.php?id=
                        	<?php echo $v['value_id']; ?>" style="width: 100px">Editar</a></td>
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
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <script src="plugins/chartjs/Chart.js" type="text/javascript"></script>
    <!-- Page script -->
	<script>
		<?php 
		$q = mysql_query("SELECT DATE(value_date) AS value_date, value_ind FROM indicatorvalues WHERE indicator_id=$query_id LIMIT 6", $link); 
		$num_v=mysql_numrows($q);
		?>
		var rows= <?php echo $num_v;?>;
		var myData= [
		<?php
		while ($info = mysql_fetch_assoc($q)) { echo $info['value_ind'] . ','; }
   		?>];
    	<?php 
    	$q = mysql_query("SELECT DATE(value_date) AS value_date, value_ind FROM indicatorvalues WHERE indicator_id=$query_id LIMIT 6", $link); 
    	?>
 	   	var myLabels= 
 	   	[<?php
		while ($info = mysql_fetch_assoc($q)) { echo '"' . $info['value_date'] . '",'; }
		?>];
		var myBase=[0,0];
		for (i=0; i<rows; i++) {
			myBase[i]=0;
		}
		var myGoal=[0,0];
		for (i=0; i<rows; i++) {
			myGoal[i]=<?php echo $meta;?>;
		}

		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : myLabels,
			datasets : [
								{
	              label: "Meta",
				  fillColor: "rgba(249,206,13,0.01)",
	              strokeColor: "rgba(249,206,13,0.8)",
	              pointColor: "rgba(249,206,13,0.01)",
	              pointStrokeColor: "rgba(249,206,13,0.01)",
	              pointHighlightFill: "rgba(249,206,13,0.8)",
	              pointHighlightStroke: "rgba(249,206,13,0.8)",              	
	              data: myGoal
				},
				{
	              label: "Indicador",
				  fillColor: "rgba(60,141,188,0.01)",
	              strokeColor: "rgba(60,141,188,0.8)",
	              pointColor: "#3b8bba",
	              pointStrokeColor: "rgba(60,141,188,1)",
	              pointHighlightFill: "#fff",
	              pointHighlightStroke: "rgba(60,141,188,1)",              
	              data: myData
				}

			]

		}

	var barChartData = {
		labels : myLabels,
		datasets : [
			{
				fillColor : "rgba(75,204,38,0.7)",
				strokeColor : "rgba(75,204,38,0.9)",
				highlightFill: "rgba(60,102,76,0.75)",
				highlightStroke: "rgba(60,102,76,1)",
				data : myData
			}

		]

	}

			var doughnutData = [
				{
					value: 90,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Red"
				},
				{
					value: 50,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Green"
				}
/*				{
					value: 100,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Yellow"
				},
				{
					value: 40,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "Grey"
				},
				{
					value: 120,
					color: "#4D5360",
					highlight: "#616774",
					label: "Dark Grey"
				} */

			];

        var areaChartData = {
          labels: myLabels,
          datasets: [
            {
              label: "Indicador",
			  fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",              
              data: myData
            },
          ] };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

	window.onload = function(){
		var variable = <?php echo $grafico; ?>;
		var ctx;
		switch (variable) {
			case(3):
			ctx = document.getElementById("canvas").getContext("2d");
			window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true });
			break;
			case(2):
			ctx = document.getElementById("canvas").getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
			break;
			case(4):
			ctx = document.getElementById("canvas").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true });
			break;
			}
	}

	</script>
  </body>
</html>
<?php } ?>