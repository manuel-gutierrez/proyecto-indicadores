<?php
/*
* User: Manuel
* Date: 07/05/2016
* Time: 8:31 PM
* Description:
* This will retur the array of the associated indicators of an "area clave"
@param areaclaveId
*/
require ('php/connDB.php');

// Process request 
if($_SERVER['REQUEST_METHOD']=='POST')
{
// Check empty request
	if(!isset($_POST['area_id'])) {
		$errors['invalid_parameters'] = 'The Id parameter is empty';
	}
// Process Response.
	if ( !empty($errors)) {
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {
// do query
		$query= 'SELECT indicator_cod FROM indicators JOIN areas_objectives ON indicators.id_ao =areas_objectives.id_ao AND areas_objectives.area_id ='.$_POST['area_id'].';';	
		$result = mysql_query($query, $link);

		if ($result) {	
			$index = 0;
			while ( $indicator = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$values[$index] = $indicator['indicator_cod'];
			$index++;
			}

			if (empty($values)) {
				$errors['invalid_parameters'] = 'The query return an empty result';
				$data['success'] = false;
				$data['errors']  = $errors;
			} else {
				$data['success'] = true;
				$data['values']  = $values;
			}
		}
		else {
			$errors['invalid_parameters'] = 'Db error';
			$data['success'] = false;
			$data['errors']  = $errors;   
		}

	}
// Do Response 
	echo json_encode($data);
}


