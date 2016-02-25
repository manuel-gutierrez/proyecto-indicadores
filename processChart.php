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

    if ( ! empty($errors)) {
        // No GET parameter .
        $data['success'] = false;
        $data['errors']  = "At least one parameter is empty";
    } else {

        $indicator_id = $_POST['indicatorId'];
        $indicator_type = $_POST['indicatorType'];
        $chart_type = $_POST['chartType'];

        /*
         * Crear modelo que traiga datos segun tipo de indicador
         * For global indicator
         */

        // Global indicator data : fetch the data from the current year
            $current_year = date("Y");
            $last_year = date("Y")-1;
            // Query.

            $q='SELECT DATE(value_date) AS value_date, value_ind, value_id FROM indicatorvalues WHERE `indicator_id`= '.$indicator_id.' ORDER BY value_id DESC LIMIT 4' ;
            $result = mysql_query($q ,$link);


        if ($result)
        {
            // fetch data
            $index= 0;
            $pointLabels =  array();
            $pointValues = array();

            while($result_data = mysql_fetch_array($result, MYSQL_ASSOC)) {

                    $pointLabels[$index] = $result_data['value_date'];
                    $pointValues[$index]  = $result_data['value_ind'];
                    $index ++;
            }

            $indicator_data = array('pointLabels'=> $pointLabels, 'values'=> $pointValues, 'yLabel' => 'Tendencia del Indicador', 'chartType' => $chart_type);
            // if the result of the query is empty.
            if (empty($indicator_data)){
                $errors['empty_result'] = "No hay resultados para este indicador";
                $data['success'] = false;
                $data['errors']  = $errors;
            }else{
                // format data

//                var_dump($indicator_data);
                // Create success array.
                $data['success'] = true;
                $data['message'] = $indicator_data;
            }
        }
        else{
            // DB exception
            $errors['db'] = 'No hay acceso a la base de datos por lo tanto no es posible consultar la información';
            $data['success'] = false;
            $data['errors']  = $errors;
        }

    }

    // return all our data to an AJAX call
    echo json_encode($data);



