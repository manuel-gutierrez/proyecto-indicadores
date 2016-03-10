<?php
/**
 *
 * User: Manuel
 * Date: 2/19/2016
 * Time: 5:42 PM
 * Description : Delete users view.
 * @param user_id
 */

require ('php/connDB.php');
include ('php/functions.php');

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

    // validate the variables
    // if any of these variables don't exist, add an error to our $errors array

    if (empty($_POST['id'])){
        $errors['id'] = 'id is required.';
    }


    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

        $user_id = $_POST['id'];
        $q="
        DELETE FROM `usuarios`
        WHERE `id_usuario` = '$user_id';
        ";
        if (mysql_query($q))
        {
            // show a message of success and provide a true success variable
            $data['success'] = true;
            $data['message'] = 'Success!';
            reportes_action(
                [
                    0 => 'Eliminar Usuario',
                    1 => 'deleteUser',
                    2 => "El usuario ".$login_fn." ".$login_ln." borro el usuario con ID: ".$userId,
                ]);
        }
        else{

            $errors['db'] = 'db query error';
            $data['success'] = false;
            $data['errors']  = $errors;
            reportes_action(
                [
                    0 => 'Error al Eliminar Usuario',
                    1 => 'deleteUser',
                    2 => "Error al borrar el usuario ".$user_id." de la base de datos.",
                ]);
        }

    }

    // return all our data to an AJAX call
    echo json_encode($data);
