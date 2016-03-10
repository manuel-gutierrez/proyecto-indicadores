<?php
/**
 * User: Manuel
 * Date: 2/18/2016
 * Time: 8:57 PM
 * Description: Form to edit a current user of the system.
 */

require ('php/connDB.php');
include ('php/functions.php');
include ('php/session.php');
include ('php/importVal.php');




// Session control

$ses_sql=mysql_query("SELECT * FROM areas", $link);
if ($_SESSION["uid"] != '$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}') {
    header("Location: index.php"); //Redirige al login.php
} else {
    // Validate Get parameter
    if( $_GET["id"] ) {
        $query_id = $_GET["id"];

        /*
         *  Fetch Data.
         * - fetch stored user information.
         * - fetch the associated indicators for the user. from ImportInd.php
         *
         */


        // User Data/
        $q = mysql_query("SELECT * FROM usuarios WHERE id_usuario=$query_id",$link);

        $valores = mysql_fetch_assoc($q);
        $nombre = $valores['first_name'];
        $apellido = $valores['last_name'];
        $ocupacion = $valores['occupation'];
        $ocupacion = $valores['occupation'];
        $correo = $valores['email'];
        $ciclo = $valores['cycle'];
        $jornada = $valores['labour_time'];
        $documento = $valores['document_number'];
        $tipo_de_usuario = $valores['user_type'];
        $indicators = $valores['linked_indicators'];
        $area_id = $valores['area_id'];

        //  Area Academica.
        $academic_field_id = $valores['academic_field'];




        if(!empty($academic_field_id)){
            $q2 = mysql_query("SELECT * FROM academic_fields WHERE academic_field_id=".$academic_field_id,$link);
            $q2_value = mysql_fetch_assoc($q2);
            $area_academica= $q2_value['name'];
        }
        else{
            $area_academica = "0";
        }

        // Key Area data
        $area_clave_id = $valores['area_id'];

        if(!empty($academic_field_id)){
            $q3 = mysql_query("SELECT * FROM areas WHERE area_id=".$area_clave_id,$link);
            $q3_value = mysql_fetch_assoc($q3);
            $area_clave= $q3_value['area_name'];
        }
        else{
            $area_clave = "No aplica";
            $area_clave_id = "0";
        }

        // -----------------------Indicators ----------------------------------------------


            $q = mysql_query("SELECT indicator_id, indicator_cod, equation_id, area_id, objective_id, indicator_name, indicator_goal , indicator_type, chart_type \n"
                . "FROM (SELECT id_ao, objective_id, area_id FROM areas_objectives WHERE area_id=$area_id) AS id_ao\n"
                . "INNER JOIN indicators\n"
                . "USING (id_ao)", $link);


        // If there is some results.
        if ($q){
            $result = mysql_fetch_array($q);

            $index = 0;
            while ($result = mysql_fetch_array($q)) {
                $assoc_indicators[$index] = $result['indicator_cod'];
                $index++;
            }

            $userIndicators = json_encode($assoc_indicators);
        }
        // Set the user indicators empty.
        else{
            $userIndicators ="";
        }



    }
    else {
        echo "Error: Parametro id en peticion GET vacio. ";
        // Redirecciona a  la pagina 404.
    }
    ?>
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
                    <h3 class="box-title">Perfil del Usuario</h3>
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
                        <div class="box-info">

                            <!-- Process form-->
                            <?php
                            if($_SERVER['REQUEST_METHOD']=='POST'){

                                //Data Validation
                                if ($login_usertype == 0) {

                                    $post_check = !empty($_POST['fn'])
                                        && !empty($_POST['ln'])
                                        && !empty($_POST['email'])
                                        && !empty($_POST['academic_field'])
                                        && !empty($_POST['areaId'])
                                        && ($_POST['user_type'] != "blank");
                                } else {
                                        $post_check = !empty($_POST['fn'])
                                        && !empty($_POST['ln'])
                                        && !empty($_POST['document_number'])
                                        && !empty($_POST['email']);

                                }
                                if($post_check ) {
                                    // Parse data
                                    // case administrator
                                    if ($login_usertype == 0) {

                                        // Fetch Data
                                        $userId = trim($_GET["id"], " ");
                                        $updated_fn = $_POST['fn'];
                                        $updated_ln = $_POST['ln'];
                                        $updated_email = $_POST['email'];
                                        $updated_occup = $_POST['occupation'];
                                        $updated_area = $_POST['areaId'];
                                        $updated_ut = $_POST['user_type'];
                                        $updated_academic_field = $_POST['academic_field'];
                                        $updated_cycle = $_POST['cycle'];
                                        $updated_labour_time = $_POST['labour_time'];
                                        $updated_document_number = $_POST['document_number'];
                                        $updated_indicators = $_POST['indicators'];

                                        // Update Data

                                        $sql = "";
                                        $sql = "UPDATE `usuarios`
                                                SET
                                                `first_name` = '$updated_fn',
                                                `last_name` = '$updated_ln',
                                                `email` = '$updated_email',
                                                `occupation` = '$updated_occup',
                                                `area_id` = '$updated_area',
                                                `user_type` = '$updated_ut',
                                                `cycle` = '$updated_cycle',
                                                `labour_time` = '$updated_labour_time',
                                                `document_number` = '$updated_document_number',
                                                `academic_field` = '$updated_academic_field',
                                                `linked_indicators` = '$updated_indicators'
                                                WHERE `id_usuario` = '$userId'";
                                    } else {

                                            // Case empleado and recopilador
                                            // Fetch Data
                                            $userId = trim($_GET["id"], " ");
                                            $updated_fn = $_POST['fn'];
                                            $updated_ln = $_POST['ln'];
                                            $updated_email = $_POST['email'];
                                            $updated_document_number = $_POST['document_number'];

                                            // Update data.
                                            $sql = "";
                                            $sql = "UPDATE `usuarios`
                                            SET
                                            `first_name` = '$updated_fn',
                                            `last_name` = '$updated_ln',
                                            `email` = '$updated_email',
                                            `document_number` = '$updated_document_number'
                                            WHERE `id_usuario` = '$userId'";
                                    }

                                        if (mysql_query($sql)) {
                                            $location = "location.replace('showUser.php?id=".trim($_GET["id"])."')";
                                            // Success Message
                                            echo '
                                                <!-- Success Message            -->
                                            <div id = "success-message" class="message-pading col-lg-12 " >
                                                <div class="box box-solid box-success" >
                                                <div class="box-header" >
                                                    <h3 class="box-title" > Processo exitoso . </h3 >
                                                        </div ><!-- /.box - header-->
                                                        <div class="box-body" >
                                                         El usuario ha sido modificado .

                                                         <button class="btn btn-sm btn-primary pull-right" onclick="'.$location.'"  />Volver
                                                        </div ><!-- /.box - body-->

                                               </div >
                                            </div >

                                            ';
                                            // Log in Database
                                            reportes_action(
                                                [
                                                    0 => 'editar usuario',
                                                    1 => 'editUser',
                                                    2 => "El usuario ".$login_fn." ".$login_ln." editó el usuario con ID: ".$userId,
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
                                }
                                else{
                                    // Warning Message.
                                    echo '<!-- Warning  Message      -->
                                <div id="warning-message" class="message-pading col-md-12 " >
                                    <div class="box box-solid box-warning">
                                        <div class="box-header">
                                            <h3 class="box-title">Error.  </h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            Algunos de los datos obligatorios no ha sido ingresado. Revise que la información en el formulario se haya ingresado correctamente
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                              ';
                                }

                            }
                            ?>

                        </div><!-- /.box-info -->
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <form role="form" action="editUser.php?id=<?php echo $_GET['id'];?>" method="post">

                            <div class="row">
                                <!--  Col  1    -->
                                <div class="col-md-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <input type="text" value="<?php echo $nombre ?>" name="fn" class="form-control" placeholder="" required/>
                                    </div>

                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <input type="text" value="<?php echo $apellido ?>" name="ln"class="form-control" placeholder="" required/>
                                    </div>

                                    <div class="form-group">
                                        <label> Número de documento:</label>
                                        <input type="text" value="<?php echo $documento ?>" name="document_number" class="form-control" placeholder="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Correo electrónico:</label>
                                        <input type="email" name="email" value="<?php echo $correo ?>" class="form-control" placeholder="" required/>
                                    </div>

                                    <?php if ($login_usertype == 0){ ?>
                                    <div class="form-group">
                                         <?php if ($tipo_de_usuario != 0 ){
                                         $value = trim($userIndicators,'[]');
                                         $value = str_replace("\"","", $value);
                                         }?>
                                        <label> Ingrese el código de los indicadores asociados a esta persona separados por comas.</label>
                                        <input type="text" id="indicators" name="indicators" value="<?php echo $value; ?>" class="form-control" placeholder="Escriba el nombre del indicador" required/>
                                        <a href="./tablero.php" target="" onclick="openHelpTable()" >Ver lista de Indicadores</a>
                                        <script>
                                            function openHelpTable(){
                                                event.preventDefault();
                                                window.open("/granC/tablero.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=900, left=500, width=600, height=800");
                                            }
                                        </script>
                                    </div>
                                </div>


                                <!--  Col   2    -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="areaId"> Área Clave: </label>
                                        <select id="cmbArea" name="areaId" class="form-control">
                                            <option value="<?php echo $area_clave_id ?>" selected><?php echo $area_clave ?> </option>
                                            <?php  if ($area_clave_id != "0") {
                                                ?>  <option value="0">No aplica</option>
                                            <?php } ?>

                                            <!--  Fetch Areas    -->
                                            <?php
                                            while($row = mysql_fetch_assoc($ses_sql)){
                                                $idArea = $row["area_id"];
                                                $nameArea = $row["area_name"];
                                                if ($idArea == $area_clave_id){
                                                    continue;
                                                }

                                                ?>
                                                <!--  / Fetch Areas   -->

                                                <option value= "<?php echo $idArea ?>" > <?php echo $nameArea ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_type"> Tipo de Usuario: </label>

                                        <select id="cmbType" name="user_type" class="form-control">

                                            <?php if ($tipo_de_usuario == 0){ ?>
                                                <?php if($login_usertype == 0 ){ echo"
                                                <option value='0' selected>Administrador</option> ";}?>
                                                <option value="1" >Recopilador</option>
                                                <option value="2" >Empleado</option>
                                            <?php  }
                                            elseif ($tipo_de_usuario == 1){ ?>
                                                <?php if($login_usertype == 0 ){ echo"
                                                <option value='0' >Administrador</option> ";}?>
                                                <option value="1" selected>Recopilador</option>
                                                <option value="2">Empleado</option>
                                            <?php  }
                                            elseif ($tipo_de_usuario == 2){?>
                                                <?php if($login_usertype == 0 ){ echo"
                                                    <option value='0' >Administrador</option> ";}?>
                                                <?php if($login_usertype == "1" || $login_usertype == "0" ){ echo"
                                                <option value='1' >Recopilador</option> ";}?>
                                                <option value="2" selected>Empleado</option>
                                            <?php  }?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Cargo:</label>
                                        <select id="cmbType" name="occupation" class="form-control">

                                            <?php
                                            var_dump($usertype);
                                            if ($ocupacion == "Docente"){ ?>
                                                <option value="Docente" selected>Docente</option>
                                                <option value="Orientador" >Orientador</option>
                                                <option value="Administrativo">Administrativo</option>
                                            <?php  }
                                            elseif ($ocupacion == "Orientador"){ ?>
                                                <option value="Docente" >Docente</option>
                                                <option value="Orientador" selected>Orientador</option>
                                                <option value="Administrativo">Administrativo</option>
                                            <?php  }
                                            elseif($ocupacion == "Administrativo"){ ?>

                                                <option value="Docente" >Docente</option>
                                                <option value="Orientador" >Orientador</option>
                                                <option value="Administrativo" selected>Administrativo</option>
                                            <?php  }
                                            else {?>
                                                <option value="Docente" >Docente</option>
                                                <option value="Orientador" >Orientador</option>
                                                <option value="Administrativo" selected>Administrativo</option>
                                            <?php  };?>


                                        </select>


                                    </div>

                                    <div class="form-group">
                                        <label>Área académica</label>
                                        <select id="cmbType" name="academic_field" class="form-control">
                                            <?php if ($area_academica != "0") {?>
                                            <option value="<?php echo $academic_field_id ?>" selected><?php echo $area_academica ?> </option>
                                            <?php }
                                            else{?>
                                                <option value="0" selected>Seleccione un Área Academica</option>
                                            <?php }?>
                                            <!-- Fetch data -->
                                            <?php
                                            $ac_fields=mysql_query("SELECT * FROM academic_fields", $link);
                                            while($rows=mysql_fetch_assoc($ac_fields)){
                                                if ($academic_field_id == $rows['academic_field_id']){continue;}
                                                ?>

                                                <option value= "<?php echo $rows['academic_field_id'] ?>" > <?php echo $rows['name'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ciclo</label>


                                        <?php
                                        $cycle_values = array
                                        (
                                            array("1","Ciclo 1"),
                                            array("2","Ciclo 2"),
                                            array("3","Ciclo 3"),
                                            array("4","Ciclo 4"),
                                            array("5","Ciclo 5"),
                                            array("40x40","40x40"),
                                            array("ARTI","ARTI"),
                                            array("SDL","SDL"),
                                            array("SDC","SDC"),
                                            array("Inicial","Inicial"),

                                        );
                                        if (empty($ciclo)) {
                                            $ciclo = "No Aplica";
                                        }

                                        ?>
                                        <select id="cmbType" name="cycle" class="form-control" required="required">
                                            <option value="<?php echo $ciclo; ?>" selected><?php echo $ciclo;?></option>

                                            <?php
                                            foreach ($cycle_values as $v) {
                                                if ($v[0] == $ciclo) {
                                                    continue;
                                                }
                                                else{
                                                    echo "<option value=".$v[0].">".$v[1]."</option>";
                                                }

                                            }?>


                                            <?php

                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Jornada</label>
                                        <select id="cmbType" name="labour_time" class="form-control" required>
                                            <?php if ($jornada == "manana"){ ?>
                                                <option value="manana" selected>Mañana</option>
                                                <option value="tarde">Tarde</option>
                                                <option value="completa">Completa</option>
                                            <?php }
                                            elseif($jornada == "tarde"){ ?>
                                                <option value="manana" >Mañana</option>
                                                <option value="tarde"selected>Tarde</option>
                                                <option value="completa">Completa</option>
                                            <?php }
                                            elseif ($jornada == "completa"){ ?>
                                                <option value="manana" >Mañana</option>
                                                <option value="tarde">Tarde</option>
                                                <option value="completa" selected>Completa</option>
                                            <?php }
                                            else{ ?>
                                            <option value="manana" >Mañana</option>
                                            <option value="tarde">Tarde</option>
                                            <option value="completa" selected>Completa</option>
                                           <?php } ?>
                                        </select>
                                    </div>


                                    <?php }?>
                                </div>

                            </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a  class="btn btn-primary pull-left" onclick="javascript:history.go(-1)">Volver</a>
                        <span class="margin-2 pull-right">
                                <button  type="submit" class="btn btn-success " href="./editUser.php"><i class="fa fa-fw fa-save"></i> Guardar</button>
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
    </html>
    <!-- End of content   -->


<?php }?>