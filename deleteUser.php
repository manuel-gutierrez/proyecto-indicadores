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
include('php/session.php');

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

        $user_id = trim($_POST['id']);
        // Verify that the user doesn't have any records in the indicatorvalue table.
        $check = "SELECT * FROM `indicatorvalues` WHERE `user_id` = '$user_id' ";

        // Delete values from indicator values.

        if (!mysql_query($check)) {

            // Delete user from the table
            $q1="
            DELETE FROM `usuarios`
            WHERE `id_usuario` = '$user_id';
            ";
            if (mysql_query($q1))
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

                $errors['db'] = 'The query to delete the database failed.';
                $data['success'] = false;
                $data['errors']  = $errors;
                reportes_action(
                    [
                        0 => 'Error al Eliminar Usuario',
                        1 => 'deleteUser',
                        2 => "Error al borrar el usuario ".$user_id." de la base de datos.",
                    ]);
            }
        } else {
            $errors['associated_data'] = 'The user have data associated so it could not be deleted.';
            $data['success'] = false;
            $data['errors'] = $errors;
            reportes_action(
                [
                    0 => 'Error al Eliminar Usuario',
                    1 => 'deleteUser',
                    2 => "Error al borrar el usuario " . $user_id . " de la base de datos.",
                ]);
        }
    }

    // return all our data to an AJAX call
    echo json_encode($data);
