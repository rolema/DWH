<?php
	include '../back_code/Mysql.class.php';
  	conectar();
	
	$ssql =	'select EN_USO, SIN_DESECHAR, ';
	
	$ssql .= 'case '; 
	
	$ssql .= 'when(EN_USO = 0 and SIN_DESECHAR = 0) then "DISPONIBLES" ';
	$ssql .= 'when(EN_USO = 1 and SIN_DESECHAR = 0) then "UBICADAS" ';
	
	//////prueba/////////////////////////////////////////////////////
	//$ssql .= 'when(EN_USO = 1 and SIN_DESECHAR = 1) then "1" ';///
	//$ssql .= 'when(EN_USO = 1 and SIN_DESECHAR = 2) then "2" ';///
	////////////////////////////////////////////////////////////////
	
	$ssql .= 'when(EN_USO = 0 and SIN_DESECHAR = 1) then "LISTAS PARA RENOVACION" ';
	$ssql .= 'when(EN_USO = 0 and SIN_DESECHAR = 2) then "EN RENOVACION" ';
	$ssql .= 'when(EN_USO = 2 and SIN_DESECHAR = 0) then "DESECHADAS" ';

	$ssql .= 'end, ';
	$ssql .= 'sum(COSTO), count(*) ';

	$ssql .= 'from ave_t_llanta group by EN_USO, SIN_DESECHAR Order by 4 desc';
	//echo $ssql;
	
	$results = array('cols' => array (
        	   array ('label' => 'Estatus', 'type' => 'string'),
			   array ('label' => 'Costo', 'type' => 'number'),
			   array ('label' => 'Cantidad', 'type' => 'number')),
    			'rows' => array());
	
	$query = mysql_query($ssql);

	 if ($query){
		while ($resultado = mysql_fetch_array($query)){

			$results['rows'][] = array('c' => array(
       							 array('v' => $resultado[2]),
								 array('v' => $resultado[3]),
       							 array('v' => $resultado[4])));
		}
		
		$json = json_encode($results, JSON_NUMERIC_CHECK/*no olvides poner este*/);
	}
			
	echo $json;
	
?>
