<?php
/**
 * User: Manuel
 * Date: 2/22/2016
 * Time: 5:55 PM
 * Description:
 * User select to view an indicator, then data is fetched and organized in order to render the proper chart.
 * @param indicatorType, indicatorId, chartType.
 */
require ('php/connDB.php');

    /*
     * Fetch the indicator type (global or individual ,  Indicator Id  and chartType .
     */

    // if any of these variables don't exist, add an error to our $errors array

    if (($_POST['indicatorId'] == "") or ($_POST['indicatorType']=="") or ($_POST['chartType']=="")){

        $errors['invalid_parameters'] = 'At least one of the Post parameters is empty';
    }

    if ( !empty($errors)) {
        // No GET parameter .
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

        $indicator_id = $_POST['indicatorId'];
        $indicator_type = $_POST['indicatorType'];
        $chart_type = $_POST['chartType'];
        $user_id = $_POST['userId'];
        $summaryType = "0";

        if (isset($_POST['summaryType'])){
            $summaryType = $_POST['summaryType'];
            $chart_data_users = $_POST['chartData_users'];
            $chart_data_cycle = $_POST['chartData_cycle'];
            $chart_data_jornada = $_POST['chartData_jornada'];
        }


        /*
         *
         * For global indicator indicator Type  = 0
         */
        // Individual indicator

        switch ($indicator_type) {
            case 0:  // Global indicator

                $q = 'SELECT DATE(value_date) AS value_date, value_ind, value_id FROM indicatorvalues WHERE `indicator_id`= ' . $indicator_id . ' ORDER BY value_id DESC LIMIT 4';
                $result = mysql_query($q, $link);
                if ($result) {
                    // fetch data
                    $index = 0;
                    $pointLabels = array();
                    $pointValues = array();

                    while ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {

                        $pointLabels[$index] = $result_data['value_date'];
                        $pointValues[$index] = $result_data['value_ind'];
                        $index++;
                    }

                    $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                    // if the result of the query is empty.
                    if (empty($indicator_data)) {
                        $errors['empty_result'] = "Aún no hay resultados para este indicador";
                        $data['success'] = false;
                        $data['errors'] = $errors;
                    } else {
                        // format data
                        // Create success array.
                        $data['success'] = true;
                        $data['message'] = $indicator_data;
                    }
                } else {
                    // DB exception
                    $errors['db'] = 'No hay acceso a la base de datos por lo tanto no es posible consultar la información';
                    $data['success'] = false;
                    $data['errors'] = $errors;
                }
                break;
            case 1:  // Individual indicator

                switch($summaryType) {
                    case "global":
                        $q = 'SELECT avg(value_ind) from indicatorvalues where user_id in ('.$chart_data_users.')';
                        $result = mysql_query($q, $link);
                        if ($result) {
                            // fetch data

                            $pointLabels = array();
                            $pointValues = array();
                            $result_data = mysql_fetch_array($result, MYSQL_ASSOC);

                            $pointLabels[0] = "Media Aritmetica de los Usuarios";
                            $pointValues[0] = $result_data['avg(value_ind)'];
                            $chart_type = "3";


                            $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                            // if the result of the query is empty.
                            if (empty($indicator_data)) {
                                $errors['empty_result'] = "Aún no hay resultados para este indicador";
                                $data['success'] = false;
                                $data['errors'] = $errors;
                            } else {
                                // format data
                                // Create success array.
                                $data['success'] = true;
                                $data['message'] = $indicator_data;
                            }
                        } else {
                            // DB exception
                            $errors['db'] = 'No hay acceso a la base de datos por lo tanto no es posible consultar la información';
                            $data['success'] = false;
                            $data['errors'] = $errors;
                        }

                        break;

                    case "ciclo":
                        echo "ciclo";
                        break;

                    case "jornada":
                        echo "jornada";
                        break;

                    case "0":
                        $q = 'SELECT DATE(value_date) AS value_date, value_ind, value_id FROM indicatorvalues WHERE `indicator_id`= ' . $indicator_id . ' and `user_id`='.$user_id.' ORDER BY value_id DESC LIMIT 4';
                        $result = mysql_query($q, $link);
                        if ($result) {
                            // fetch data
                            $index = 0;
                            $pointLabels = array();
                            $pointValues = array();
                            $result_data = mysql_fetch_array($result, MYSQL_ASSOC);

                            while ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                $pointLabels[$index] = $result_data['value_date'];
                                $pointValues[$index] = $result_data['value_ind'];
                                $index++;
                            }


                            $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                            // if the result of the query is empty.
                            if (empty($pointValues)) {
                                $errors['empty_result'] = "Aún no hay resultados para este indicador";
                                $data['success'] = false;
                                $data['errors'] = $errors;
                            } else {
                                // format data
                                // Create success array.
                                $data['success'] = true;
                                $data['message'] = $indicator_data;
                            }
                        } else {
                            // DB exception
                            $errors['db'] = 'No hay acceso a la base de datos por lo tanto no es posible consultar la información';
                            $data['success'] = false;
                            $data['errors'] = $errors;
                        }
                        break;
                }
                break;

        }
    }

    // return all our data to an AJAX call
   echo json_encode($data);



