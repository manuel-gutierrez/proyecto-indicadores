<?php
require ('php/connDB.php');
include ('php/session.php');
include 'php/functions.php';

/*
Query's
*/
$ses_sql=mysql_query("SELECT * FROM areas", $link);
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
} else {
    /*
     * Fetch all the the indicators names, for the indicators auto complete.
     */
    // -----------------------Indicators ----------------------------------------------


    $q = mysql_query("SELECT indicator_cod FROM indicators", $link);

    // If there is some results.
    if ($q) {
        $result = mysql_fetch_array($q);

        $index = 0;
        while ($result = mysql_fetch_array($q)) {
            $assoc_indicators[$index] = $result['indicator_cod'];
            $index++;
        }
        $userIndicators = json_encode($assoc_indicators);
    } // Set the user indicators empty.
    else {
        $userIndicators = "";
    }



    ?>

    <!--
    Begining of the HTML Document.
    -->
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar Usuarios</title>
        <link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="pics/apple-touch-icon.png" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script href="bootstrap/js/bootstrap.min.js" rel="script" ></script>
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="php/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="bootstrap/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link href="php/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <![endif]-->
    </head>

    <!---
     Begining of the Body
     Three sections: Heaer, left sidebar and main wrapper
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

        <!-- Left side column. -->
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
        <!-- Content Wrapper -->
        <div class="wrapper">

            <div class="content-wrapper">

                <section class="content-header">
                    <h1>
                        Usuarios registrados
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
                        <li >Usuarios</li>
                        <li class="active">Nuevo Usuario</li>
                    </ol>
                </section>


                <section class="content">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="row">
                                <?php
                                if($_SERVER['REQUEST_METHOD']=='POST'){

                                    //Data Validation
                                    if(
                                        isset($_POST['fn'])
                                        && isset($_POST['ln'])
                                        && isset($_POST['email'])
                                        && isset($_POST['password'])
                                        && isset($_POST['academic_field'])
                                        && isset($_POST['areaId'])
                                        && ($_POST['user_type']!= "blank")
                                    )
                                    {

                                        $new_email = $_POST['email'];
                                        $new_fn = $_POST['fn'];
                                        $new_ln = $_POST['ln'];
                                        $new_occup = $_POST['occupation'];
                                        $new_area = $_POST['areaId'];
                                        $new_ut = $_POST['user_type'];
                                        $new_pw = $_POST['password'];
                                        $new_academic_field = $_POST['academic_field'];
                                        $new_cycle = $_POST['cycle'];
                                        $new_labour_time  = $_POST['labour_time'];
                                        $new_document_number  = $_POST['document_number'];
                                        $new_linked_indicators  = $_POST['indicators'];

                                        $q = mysql_query("SELECT * FROM usuarios WHERE email='$new_email'",$link);
                                        $rows = mysql_num_rows($q);

                                        if ($rows == 0) {

                                            $q = mysql_query("
                                          INSERT INTO usuarios (
                                              `first_name`,
                                              `last_name`,
                                              `email`,
                                              `contrasena`,
                                              `occupation`,
                                              `area_id`,
                                              `user_type`,
                                              `academic_field`,
                                              `cycle`,
                                              `labour_time`,
                                              `document_number`,
                                              `linked_indicators`
                                          )
                                          VALUES (
                                              '$new_fn',
                                              '$new_ln',
                                              '$new_email',
                                              SHA1('$new_pw'),
                                              '$new_occup',
                                              '$new_area',
                                              '$new_ut',
                                              '$new_academic_field',
                                              '$new_cycle',
                                              '$new_labour_time',
                                              '$new_document_number',
                                              '$new_linked_indicators'
                                          )",
                                                $link
                                            );

                                            if ($q) {
                                                reportes_action(
                                                    [0 => 'registrar usuario', 1 => 'addUser', 2 => 'Se creó el usuario '.$new_email.', en el sistema.']);
                                                ?>
                                                <!-- Success Message            -->
                                                <div class="message-pading col-lg-12">
                                                    <div class="box box-solid box-success">
                                                        <div class="box-header">
                                                            <h3 class="box-title"> Processo exitoso. </h3>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            El usuario ha sido creado.
                                                        </div><!-- /.box-body -->
                                                    </div>
                                                </div>

                                            <?php 	}
                                        } else {
                                            ?>
                                            <div class="message-pading col-md-12 ">
                                                <div class="box box-solid box-warning">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Error.  </h3>
                                                    </div><!-- /.box-header -->
                                                    <div class="box-body">
                                                        El usuario ya existe.
                                                    </div><!-- /.box-body -->
                                                </div>
                                            </div>
                                        <?php 	}

                                    } else {?>
                                        <div class="message-pading col-lg-12">
                                            <div class="box box-solid box-warning">
                                                <div class="box-header">
                                                    <h3 class="box-title"> Revise el formulario </h3>
                                                </div><!-- /.box-header -->
                                                <div class="box-body">
                                                    Algún campo obligatorio no fue ingresado correctamente, verifique el formulario e intente nuevamente.
                                                </div><!-- /.box-body -->
                                            </div>
                                        </div>
                                        <?php
                                        $new_email = NULL;
                                        $new_fn = NULL;
                                        $new_ln = NULL;
                                        $new_occup = NULL;
                                        $new_area = NULL;
                                        $new_ut = NULL;
                                    }
                                }
                                ?>
                                <!-- /.row-->
                            </div><!-- /.box -->
                            <h3 class="box-title">Crear un nuevo usuario</h3>

                        </div><!-- /.box-header -->

                        <!-- form start -->
                        <div class="box-body">
                            <form role="form" action="addUser.php" method="post">

                                <div class="row">
                                    <!--  Col  1    -->
                                    <div class="col-md-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Nombres:</label>
                                            <input type="text" name="fn" class="form-control" placeholder="" required/>
                                        </div>

                                        <div class="form-group">
                                            <label>Apellidos:</label>
                                            <input type="text" name="ln"class="form-control" placeholder="" required/>
                                        </div>

                                        <div class="form-group">
                                            <label> Número de documento:</label>
                                            <input type="text" name="document_number" class="form-control" placeholder="" />
                                        </div>

                                        <div class="form-group">
                                            <label>Correo electrónico:</label>
                                            <input type="email" name="email" class="form-control" placeholder="" required/>
                                        </div>

                                        <div class="form-group">
                                            <label>Contraseña:</label>
                                            <input type="password" name="password" class="form-control" placeholder="" required/>
                                        </div>
                                        <div class="form-group">
                                            <label> Ingrese el código de los indicadores asociados a esta persona separados por comas.</label>
                                            <input type="text" name="indicators" id="indicators" class="form-control" placeholder="ejemplo : SII-EG-2,SII-CC-2,SII-CC-4" required/>
                                            <a href="./tablero.php" target="" onclick="openHelpTable()" >Ver lista de Indicadores</a>
                                            <script>
                                                function openHelpTable(){
                                                    event.preventDefault();
                                                    window.open("./tablero.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=900, left=500, width=600, height=800");
                                                }
                                            </script>
                                        </div>
                                    </div>


                                    <!--  Col   2    -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="area"> Área Clave: </label>
                                            <select id="cmbArea" name="areaId" class="form-control">
                                                <option value="blank" selected>Seleccione un Área Clave</option>
                                                <option value="0">No aplica</option>
                                                <!--  Fetch Areas    -->
                                                <?php
                                                while($row = mysql_fetch_assoc($ses_sql)){
                                                    // $id=$row["id_expense"];
                                                    $idArea = $row["area_id"];
                                                    $nameArea = $row["area_name"];
                                                    ?>
                                                    <!--  / Fetch Areas   -->
                                                    <option value= "<?php echo $idArea ?>" > <?php echo $nameArea ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_type"> Tipo de Usuario: </label>
                                            <select id="cmbType" name="user_type" class="form-control">
                                                <option value="blank" selected>Seleccione el tipo de usuario</option>
                                                <option value="0">Administrador</option>
                                                <option value="1" >Recopilador</option>
                                                <option value="2">Empleado</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cargo:</label>
                                            <select id="cmbType" name="occupation" class="form-control">
                                                <option value="0" selected>Seleccione el tipo de cargo</option>
                                                <option value="Docente">Docente</option>
                                                <option value="Orientador" >Orientador</option>
                                                <option value="Administrativo">Administrativo</option>
                                            </select>


                                        </div>

                                        <div class="form-group">
                                            <label>Área académica</label>
                                            <select id="cmbType" name="academic_field" class="form-control">
                                                <option value="0" selected>Seleccione un Área Academica</option>
                                                <!-- Fetch data -->
                                                <?php
                                                $ac_fields=mysql_query("SELECT * FROM academic_fields", $link);
                                                while($rows=mysql_fetch_assoc($ac_fields)){
                                                    ?>

                                                    <option value= "<?php echo $rows['academic_field_id'] ?>" > <?php echo $rows['name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ciclo</label>
                                            <select id="cmbType" name="cycle" class="form-control" required="required">
                                                <option value="0" selected>Seleccione un Ciclo</option>
                                                <option value="1">Ciclo 1</option>
                                                <option value="2">Ciclo 2</option>
                                                <option value="3">Ciclo 3</option>
                                                <option value="4">Ciclo 4</option>
                                                <option value="5">Ciclo 5</option>
                                                <option value="40x40">40x40</option>
                                                <option value="ARTI">ARTI</option>
                                                <option value="SDL">SDL</option>
                                                <option value="SDC">SDC</option>
                                                <option value="Inicial">Inicial</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Jornada</label>
                                            <select id="cmbType" name="labour_time" class="form-control" required>
                                                <option value="0" selected>Seleccione una jornada</option>
                                                <option value="manana">Mañana</option>
                                                <option value="tarde">Tarde</option>
                                                <option value="completa">Completa</option>
                                            </select>
                                        </div>



                                    </div>

                                </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <a href="javascript:javascript:history.go(-1)"class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-info pull-right">Agregar</button>
                        </div><!-- /.box-footer -->
                    </div>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right
                <div class="pull-right hidden-xs">
                Anything you want
                </div> -->
                <!-- Default to the left -->
                <strong>Copyright &copy; 2015 <a href="http://www.gygsistemas.org/gc/gc_j/index.php" target="_blank">Colegio Grancolombiano</a>.</strong> Todos los derechos reservados.
            </footer>


        </div>
        <!--  End of wrapper -->

        <!--  SCRIPTS -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(document).ready(function () {
                $(function () {
                    var availableTags = <?php echo $userIndicators; ?>

                        function split(val) {
                            return val.split(/,\s*/);
                        }

                    function extractLast(term) {
                        return split(term).pop();
                    }

                    $("#indicators")
                        // don't navigate away from the field on tab when selecting an item
                        .bind("keydown", function (event) {
                            if (event.keyCode === $.ui.keyCode.TAB &&
                                $(this).autocomplete("instance").menu.active) {
                                event.preventDefault();
                            }
                        })
                        .autocomplete({
                            minLength: 0,
                            source: function (request, response) {
                                // delegate back to autocomplete, but extract the last term
                                response($.ui.autocomplete.filter(
                                    availableTags, extractLast(request.term)));
                            },
                            focus: function () {
                                // prevent value inserted on focus
                                return false;
                            },
                            select: function (event, ui) {
                                var terms = split(this.value);
                                // remove the current input
                                terms.pop();
                                // add the selected item
                                terms.push(ui.item.value);
                                // add placeholder to get the comma-and-space at the end
                                terms.push("");
                                this.value = terms.join(", ");
                                return false;
                            }
                        });
                });
            });
        </script>
    </body>
    </html>
<?php } ?>