<?php

	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_GET['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_GET['FechaDe'];
		$FechaFinal = $_GET['FechaA'];
		$TipoConsulta = $_GET['TipoConsulta'];
		$json = "vacio";
		$NoIngreso = 1;
		
		$ssql = 'SELECT DISTINCT(id_unidad), TIPO_UNIDAD, ECONOMICO, SUM(importe) FROM `ave_t_mantenimiento_producto` WHERE ';
	 	$ssql .= 'FECHA_RECIBE Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 	$ssql .= ' GROUP BY ID_UNIDAD, TIPO_UNIDAD, ECONOMICO ';
		if($TipoConsulta == 0){
			$ssql.='ORDER BY 4 DESC limit 0,9'; }
		if($TipoConsulta == 1){
			$ssql.='ORDER BY 4 DESC limit 0,19';}
		if($TipoConsulta == 2){
			$ssql.='ORDER BY 4 DESC';}		
		$query = mysql_query($ssql);
		
	 	if ($query){
			while ($resultado = mysql_fetch_array($query)){
				
				if ($NoIngreso == 1){ //Se define el array si tiene datos la consulta
					//Se definen las columnas
					$results = array('cols' => array (
        								       array ('label' => 'Tipo de unidad', 'type' => 'string'),
											   array ('label' => 'Unidad', 'type' => 'string'),
        					       			   array ('label' => 'Importe', 'type' => 'number')),
    				     			 'rows' => array());
					$NoIngreso++;
				}
				
				$results['rows'][] = array('c' => array(
        							 array('v' => $resultado[1]),
									 array('v' => $resultado[2]),
        							 array('v' => $resultado[3])));
			}
			if($NoIngreso > 1){
				$json = json_encode($results, JSON_NUMERIC_CHECK);}
		}
		echo $json;
	}
?>