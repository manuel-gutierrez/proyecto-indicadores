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

            $q1= 'SELECT EXTRACT(YEAR FROM value_date) AS s_year FROM indicatorvalues WHERE `indicator_id` = '.$indicator_id.' ORDER BY value_date DESC LIMIT 1 ';

            $result = mysql_query($q1, $link);
            if ($result) {
                $year_to_search = mysql_fetch_array($result, MYSQL_ASSOC);
                $q2= 'SELECT DATE(value_date) AS value_date, value_ind, value_id FROM indicatorvalues WHERE `indicator_id` = '.$indicator_id.' and value_date LIKE "%' .trim($year_to_search["s_year"], " ") . '%" ORDER BY value_id DESC LIMIT 4';
                $result = mysql_query($q2, $link);

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

            } else {
                $errors['empty_result'] = "Aún no hay resultados para este indicador";
                $data['success'] = false;
                $data['errors'] = $errors;
            }



            break;
        case 1:  // Individual indicator

            switch($summaryType) {
                case "global":

                    /*@Description:
                    * Return the the averge for the last year of all the users associated to this indicator".
                    *
                    * @Logic:
                    *  - Search last entry and fetch the year.
                    *  - For each user linked to this indicator  fetch the  last entry of the user for the resulting year
                    *  - Average the results
                    */
                    $pointLabels = array();
                    $pointValues = array();

                    $q1= 'SELECT EXTRACT(YEAR FROM value_date) AS s_year FROM indicatorvalues WHERE `indicator_id` = '.$indicator_id.' ORDER BY value_date DESC LIMIT 1 ';
                    $result = mysql_query($q1, $link);

                    if ($result) {
                        $year_to_search = mysql_fetch_array($result, MYSQL_ASSOC);

                        foreach ($chart_data_users as $k => $v) {

                            $q = 'SELECT value_ind from indicatorvalues where user_id in (' . $v . ') and `indicator_id`= ' . $indicator_id . ' and value_date LIKE "%' .trim($year_to_search["s_year"], " ") . '%" order by  value_date DESC limit 1';
                            $result = mysql_query($q, $link);
                            $result_data = mysql_fetch_array($result, MYSQL_ASSOC);

                            if ($result_data) {
                                $pointValues[$k] = $result_data["value_ind"];
                            }

                        }

                        // if the result of the query is empty.
                        if (empty($pointValues)) {
                            $errors['empty_result'] = "Aún no hay resultados para este indicador";
                            $data['success'] = false;
                            $data['errors'] = $errors;
                        } else {
                            // format data
                            $pointLabels[0] = "Promedio del indicador para el ultimo año";
                            $avg[0] = array_sum($pointValues) / count($pointValues);
                            // Create success array.
                            $indicator_data = array('pointLabels' => $pointLabels, 'values' => $avg, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                            $data['success'] = true;
                            $data['message'] = $indicator_data;
                        }
                    }
                    else {

                            $errors['empty_result'] = "Aún no hay resultados para este indicador";
                            $data['success'] = false;
                            $data['errors'] = $errors;
                    }


                    break;

                case "ciclo":

                    /*@Description:
                    * Return the the averge for the last year discriminated by "ciclo".
                    * @Logic:
                    *  - Search last entry and fetch the year.
                    *  - For each cycle and user linked to this indicator  fetch the  last entry of the user for the resulting year
                    *  - Average the results
                    */

                    $pointLabels = array();
                    $pointValues = array();
                    $cycle_data = array();


                    $q1= 'SELECT EXTRACT(YEAR FROM value_date) AS s_year FROM indicatorvalues WHERE `indicator_id` = '.$indicator_id.' ORDER BY value_date DESC LIMIT 1 ';
                    $result = mysql_query($q1, $link);
                    $year_to_search = mysql_fetch_array($result, MYSQL_ASSOC);
                    if ($result) {
                        foreach ($chart_data_cycle as $k => $v) {



                            $q = 'SELECT value_ind from indicatorvalues where user_id =' . $chart_data_users[$k] . ' and `indicator_id`= ' . $indicator_id . '  and value_date LIKE "%' .trim($year_to_search["s_year"], " ") . '%" order by  value_date DESC limit 1';
                            $result = mysql_query($q, $link);

                            if ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {

                                // array format [cycle_name][key] = user in this cycle last indicator value.
                                $cycle_data[$v][$k] = $result_data['value_ind'];

                            }
                        }

                        // if there is no data
                        if (empty($cycle_data)) {
                            $errors['empty_result'] = "Aún no hay resultados para este indicador";
                            $data['success'] = false;
                            $data['errors'] = $errors;
                        } else {
                            // parse data.
                            $i = 0;
                            foreach ( $cycle_data as $k => $v) {
                                $pointValues[$i] = array_sum ($cycle_data[$k] ) / count($cycle_data[$k]);
                                $pointLabels[$i] = 'Ciclo : '.$k;
                                $i = $i +1;
                            }

                            // Create success array.
                            $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                            $data['success'] = true;
                            $data['message'] = $indicator_data;
                        }


                    } else {
                        // no year data.
                        $errors['empty_result'] = "Aún no hay resultados para este indicador";
                        $data['success'] = false;
                        $data['errors'] = $errors;
                    }



                       break;

                case "jornada":

                    /*@Description:
                    * Return the the averge for the last year discriminated by "Jornada".
                    *
                    * @Logic:
                    *
                    *  - Search last entry and fetch the year.
                    *  - For each "jornada" and user linked to this indicator  fetch the  last entry of the user for the resulting year
                    *  - Average the results
                    */

                    $pointLabels = array();
                    $pointValues = array();
                    $jornada_data = array();


                    $q1= 'SELECT EXTRACT(YEAR FROM value_date) AS s_year FROM indicatorvalues WHERE `indicator_id` = '.$indicator_id.' ORDER BY value_date DESC LIMIT 1 ';
                    $result = mysql_query($q1, $link);
                    $year_to_search = mysql_fetch_array($result, MYSQL_ASSOC);
                    if ($result) {
                        foreach ($chart_data_jornada as $k => $v) {



                            $q = 'SELECT value_ind from indicatorvalues where user_id =' . $chart_data_users[$k] . ' and `indicator_id`= ' . $indicator_id . '  and value_date LIKE "%' .trim($year_to_search["s_year"], " ") . '%" order by  value_date DESC limit 1';
                            $result = mysql_query($q, $link);

                            if ($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {

                                // array format [cycle_name][key] = user in this cycle last indicator value.
                                $jornada_data[$v][$k] = $result_data['value_ind'];

                            }
                        }

                        // if there is no data
                        if (empty($jornada_data)) {
                            $errors['empty_result'] = "Aún no hay resultados para este indicador";
                            $data['success'] = false;
                            $data['errors'] = $errors;
                        } else {
                            // parse data.
                            $i = 0;
                            foreach ( $jornada_data as $k => $v) {
                                $pointValues[$i] = array_sum ($jornada_data[$k] ) / count($jornada_data[$k]);
                                $pointLabels[$i] = 'Jornada : '.$k;
                                $i = $i +1;
                            }

                            // Create success array.
                            $indicator_data = array('pointLabels' => $pointLabels, 'values' => $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
                            $data['success'] = true;
                            $data['message'] = $indicator_data;
                        }


                    } else {
                        // no year data.
                        $errors['empty_result'] = "Aún no hay resultados para este indicador";
                        $data['success'] = false;
                        $data['errors'] = $errors;
                    }



                    break;

                    /*
                     * @Description:
                     * Return the last 4 entries of an indicator of a particular user.
                     *
                     * @Logic:
                     * -Search for the last 4 entries filtering by user id and indicator id.
                     * -Return the last 4 entries.
                     *
                     */
                    case "individual":

                        $q = 'SELECT DATE(value_date) AS value_date, value_ind, value_id FROM indicatorvalues WHERE `indicator_id`= ' . $indicator_id . ' and `user_id`='.$user_id.' ORDER BY value_id DESC LIMIT 4';

                        $result = mysql_query($q, $link);
                        if ($result) {
                            // fetch data
                            $index = 0;
                            $pointLabels = array();
                            $pointValues = array();

                            while ($result_data[$index] = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                $pointLabels[$index] = $result_data[$index]['value_date'];
                                $pointValues[$index] = $result_data[$index]['value_ind'];
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



