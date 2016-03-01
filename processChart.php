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
        $chart_data_users = explode(",",$_POST['chartData_users']);
        $chart_data_cycle = explode(",",$_POST['chartData_cycle']);
        $chart_data_jornada = explode(",",$_POST['chartData_jornada']);
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
                    $pointLabels = array();
                    $pointValues = array();


                    foreach ($chart_data_users as $k => $v) {

                        $q = 'SELECT value_ind from indicatorvalues where user_id in (' . $v . ') and `indicator_id`= ' . $indicator_id . ' order by  value_date DESC limit 4';

                        $result = mysql_query($q, $link);
                        $result_data = mysql_fetch_array($result, MYSQL_ASSOC);
                        if ($result_data) {
                            $data_sum = 0;
                            while ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)){
                                $data_sum = $result_data['value_ind'] + $data_sum ;
                            }
                            $result_avg = $data_sum / 4;
                            $pointValues[$k] = $result_avg;
                        }
                    }

                    // if the result of the query is empty.
                    if (empty($pointValues)) {
                        $errors['empty_result'] = "Aún no hay resultados para este indicador";
                        $data['success'] = false;
                        $data['errors'] = $errors;
                    } else {
                        // format data
                        $pointLabels[0] = " Media global de las ulitmas 4 mediciones";
                        $avg[0] = array_sum($pointValues) / count($pointValues);
                        // Create success array.
                        $indicator_data = array('pointLabels' => $pointLabels, 'values' => $avg , 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);                            $data['success'] = true;
                        $data['message'] = $indicator_data;
                    }
                    break;

                case "ciclo":
                    $pointLabels = array();
                    $pointValues = array();
                    $result_array = array();
                    $avg = array();



                    foreach ($chart_data_cycle as $k => $v) {
                        $index = 0;
                        $q = 'SELECT value_ind from indicatorvalues where user_id in (' . $chart_data_users[$k] . ') and `indicator_id`= ' . $indicator_id . ' order by  value_date DESC limit 4';
                        $result = mysql_query($q, $link);

                        if ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {
                            $data_sum = 0;
                            $data_sum = $result_data['value_ind'];
                            $index = $index+1;
                            while ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)){
                               $data_sum = $result_data['value_ind'] + $data_sum ;
                                $index = $index+1;
                            }

                            $result_avg = $data_sum / $index ;


                            if (!isset($result_array[$v])){
                                $result_array[$v][$index] = $result_avg;
                            } else {
                                $offset = count($result_array[$v]);
                                $index = $index + $offset;
                                $result_array[$v][$index] = $result_avg;

                            }
                        }
                    }


                    // if the result of the query
                    // is empty.
                    if (empty($result_array)) {
                        $errors['empty_result'] = "Aún no hay resultados para este indicador";
                        $data['success'] = false;
                        $data['errors'] = $errors;
                    } else {
                        // format data
                        $index = 0;
                        foreach ($result_array as $cycle => $users_avg) {
                            $pointValues[$index] =array_sum($users_avg) / count($users_avg);
                            $pointLabels[$index] = 'Ciclo : '.$cycle;
                            $index++;
                        }

                        // Create success array.
                        $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                        $data['success'] = true;
                        $data['message'] = $indicator_data;
                    }

                       break;

                    case "jornada":

                        $pointLabels = array();
                        $pointValues = array();
                        $result_array = array();
                        $avg = array();



                        foreach ($chart_data_jornada as $k => $v) {
                            $index = 0;
                            $q = 'SELECT value_ind from indicatorvalues where user_id in (' . $chart_data_users[$k] . ') and `indicator_id`= ' . $indicator_id . ' order by  value_date DESC limit 4';
                            $result = mysql_query($q, $link);

                            if ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                $data_sum = 0;
                                $data_sum = $result_data['value_ind'];
                                $index = $index+1;
                                while ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)){
                                    $data_sum = $result_data['value_ind'] + $data_sum ;
                                    $index = $index+1;
                                }

                                $result_avg = $data_sum / $index ;


                                if (!isset($result_array[$v])){
                                    $result_array[$v][$index] = $result_avg;
                                } else {
                                    $offset = count($result_array[$v]);
                                    $index = $index + $offset;
                                    $result_array[$v][$index] = $result_avg;

                                }
                            }
                        }


                        // if the result of the query
                        // is empty.
                        if (empty($result_array)) {
                            $errors['empty_result'] = "Aún no hay resultados para este indicador";
                            $data['success'] = false;
                            $data['errors'] = $errors;
                        } else {
                            // format data
                            $index = 0;
                            foreach ($result_array as $jornada => $users_avg) {
                                $pointValues[$index] =array_sum($users_avg) / count($users_avg);
                                $pointLabels[$index] = 'Jornada : '.$jornada;
                                $index++;
                            }

                            // Create success array.
                            $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                            $data['success'] = true;
                            $data['message'] = $indicator_data;
                        }
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



