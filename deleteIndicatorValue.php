<?php
/**
 *
 * User: Manuel
 * Date: 2/19/2016
 * Time: 5:42 PM
 * Description : Delete an Indicator Value.
 * @param value_id
 */

require('php/connDB.php');
include('php/functions.php');
include('php/session.php');

$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data

// validate the variables
// if any of these variables don't exist, add an error to our $errors array

if (empty($_POST['id'])) {
    $errors['id'] = 'id is required.';
}


if (!empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    $value_id = $_POST['id'];
    $q = "
        DELETE FROM `indicatorvalues`
        WHERE `value_id` = '$value_id';
        ";
    if (mysql_query($q)) {
        // show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
        reportes_action(
            [
                0 => 'Eliminar Indicador',
                1 => 'deleteIndicatorValue',
                2 => "El usuario " . $login_fn . " " . $login_ln . " elimino el valor de indicador con ID: " . $value_id,
            ]);
    } else {

        $errors['db'] = 'db query error';
        $data['success'] = false;
        $data['errors'] = $errors;
        reportes_action(
            [
                0 => 'Error al Eliminar Usuario',
                1 => 'deleteUser',
                2 => "Error al borrar el valor del indicador con id  " . $value_id . " de la base de datos.",
            ]);
    }

}

// return all our data to an AJAX call
echo json_encode($data);
