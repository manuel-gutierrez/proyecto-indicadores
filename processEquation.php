<?php
/**
 * Created by PhpStorm.
 * User: Manuel
 * Date: 2/24/2016
 * Time: 10:58 PM
 * @param formData and ecuationID
 */

require ('php/connDB.php');
include ('php/functions.php');

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data


// Validate request
if (!isset($_POST)){

    $errors['invalid_parameters'] = 'Empty Request';
}
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
}else{
    /*
    * Equation Cases
    */
    if (!empty($_POST['formulaId'])){
        $formulaId = $_POST['formulaId'];
        $date = ($_POST['date']);
        switch ($formulaId) {

            case 1:
                //Calculo de satisfaccion
                $check = (isset($_POST['n_e']) or isset($_POST['n_b']) or isset($_POST['n_r']) or isset($_POST['n_m']) or isset($_POST['n_mm']));

                if (!$check){
                    $errors['data_error'] = 'At least one data of the formula is empty';
                    $data['success'] = false;
                    $data['errors']  = $errors;
                    echo ('error');
                }else{


                    // Numero de excelentes
                    $n_e = $_POST['n_e'];
                    // Numero de Buenos
                    $n_b= $_POST['n_b'];
                    // Numero regulares
                    $n_r=$_POST['n_r'];
                    // Numero de Malos
                    $n_m= $_POST['n_m'];
                    // Numero de Muy Malos
                    $n_mm=$_POST['n_mm'];
                    // Tamaño de la muestra
                    $n = $n_e + $n_b + $n_r + $n_m + $n_mm;

                    // Calculate equation

                    $output = ( (($n_e * 4) + ($n_b * 3) + ($n_r * 2) + ($n_m * 1) +($n_mm * 0)) /($n*4)) * 100 ;
                    $output= round($output , 2);

                    $value=array(['date' => $date, 'value' => $output]);
                    $data['success'] = true;
                    $data['message'] = $value;
                }

                break;
            case 2:
                // Calculo de eficiencia
                if (empty($_POST['numero-actividades-realizadas']) or empty($_POST['numero-actividades-programadas'])){
                    $errors['data_error'] = 'Formula data is empty';
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $numero_de_actividades_realizadas = (int)($_POST['numero-actividades-realizadas']);
                    $numero_de_actividades_programadas = (int)($_POST['numero-actividades-programadas']);


                    //formula calculation
                    $output = ($numero_de_actividades_realizadas /$numero_de_actividades_programadas) * 100;
                    $output= round($output , 2);
                    // Set Data
                    $value=array(['date' => $date, 'value' => $output]);
                    $data['success'] = true;
                    $data['message'] = $value;
                }

                break;
            case 3:
                //Escala Analogica

                $output = $_POST['satisfacionScale'];
                $value=array(['date' => $date, 'value' => $output]);
                $data['success'] = true;
                $data['message'] = $value;
                break;
            case 4:
                // Calculo de calidad
                $check = (empty($_POST['n_o']) or empty($_POST['n_p']) or empty($_POST['n_c']) or empty($_POST['t_o']) or empty($_POST['t_p']) or empty($_POST['t_c']));
                if ($check){
                    $errors['data_error'] = 'At least one data of the formula is empty';
                    $data['success'] = false;
                    $data['errors']  = $errors;

                }else{
                    // Catch data


                    // Numeros
                    $n_o = $_POST['n_o'];
                    $n_p= $_POST['n_p'];
                    $n_c=$_POST['n_c'];

                    //Totales
                    $t_o = $_POST['t_o'];
                    $t_p= $_POST['t_p'];
                    $t_c=$_POST['t_c'];


                    // Calculate equation

                     $output = ( ($n_o + $n_p + $n_c) /($t_o + $t_p + $t_c)) *100 ;
                     $output= round($output , 2);
                    $value=array(['date' => $date, 'value' => $output]);
                    $data['success'] = true;
                    $data['message'] = $value;
                }

                break;
            case 5:
                // Promedio de calificaciones // to do
                // numero de estudiantes;
                $n_e = $_POST['n_e'];
                $sum = 0;
                for ($i = 1; $i <= $n_e; $i++) {
                    $index = "e_".$i;
                    $sum = $sum + $_POST[$index];
                }
                $output = ($sum/$n_e) * 10 ;
                $value=array(['date' => $date, 'value' => $output]);
                $data['success'] = true;
                $data['message'] = $value;

                break;
            case 6:
                // Calculo de eficiencia inventarios
                if (!isset($_POST['inventarios-disponibles-actualizados']) || !isset($_POST['total-inventarios'])){
                    $errors['data_error'] = 'Formula data is empty';
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $inventarios_disponibles_actualizados = (int)($_POST['inventarios-disponibles-actualizados']);
                    $total_inventarios = (int)($_POST['total-inventarios']);


                    //formula calculation
                    $output = ($inventarios_disponibles_actualizados /$total_inventarios) * 100;
                    $output= round($output , 2);
                    // Set Data
                    $value=array(['date' => $date, 'value' => $output]);
                    $data['success'] = true;
                    $data['message'] = $value;
                }
        }
    }else{
        $errors['data_error'] = 'Empty formula Id';
        $data['success'] = false;
        $data['errors']  = $errors;
    }


    /*
    * Return Data
    */
}

// return all our data to an AJAX call
echo json_encode($data);