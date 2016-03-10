<?php
/**
 * User: Manuel
 * Date: 2/24/2016
 * Time: 4:03 PM
 * @param indicatorId, indicatorType, action, indicatorValue(optional).
 *  Description : This file process the form request of the views addValue and editValue.
 */

require ('php/connDB.php');
include ('php/functions.php');

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

/*
 *  validate request.
 */
if (!isset($_POST['id']) || empty($_POST['date']) || empty($_POST['value']) || empty($_POST['action']) ){

    $errors['Invalid_parameters'] = 'At least one of the parameters is empty.';
}

/*
 * Parameters Logic.
 */
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
}else {
    // Catch request data
    $indicator_id = $_POST['id'];
    $date   = $_POST['date'];
    $value  = $_POST['value'];
    $action   = $_POST['action'];


    if ($_POST['userId'] !=''){

        $userId   = $_POST['userId'];
        $q = "INSERT INTO indicatorvalues (`value_id`, `indicator_id`, `value_date`, `value_ind`, `user_id`)
           VALUES (NULL, '$indicator_id', '$date', '$value','$userId')";

    }else{

        $q = "INSERT INTO indicatorvalues (`value_id`, `indicator_id`, `value_date`, `value_ind`, `user_id`)
           VALUES (NULL, '$indicator_id', '$date', '$value',NULL)";
    }

    //Do query

        if (mysql_query($q))
        {
            // Success
            $data['success'] = true;
            $data['message'] = 'Se agrego el valor del indicador correctamente';
            reportes_action([
                0 => 'registro de Indicador',
                1 => 'addValue',
                2 => 'Se creó un indicador con valor '.$value.', en el sistema.'
            ]);
        }
        else{
            // Fail
            $errors['db'] = 'db query error';
            $data['success'] = false;
            $data['errors']  = $errors;
            reportes_action([
                0 => 'registro de Indicador',
                1 => 'addValue',
                2 => 'Error de acceso a la base de datos al agregar indicador'
            ]);
        }
}

// return all our data to an AJAX call
echo json_encode($data);