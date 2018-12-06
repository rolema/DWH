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

		$ssql = 'SELECT distinct(ID_MARCA),MARCA,sum(COSTO) as Costo, count(*) as Cantidad ';
		$ssql .= 'FROM `ave_t_mantenimiento_llanta` WHERE ';
		$ssql .= 'FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		$ssql .= 'Group by ID_MARCA, MARCA ';
		if($TipoConsulta == 0){
			$ssql.='ORDER BY 3 DESC limit 0,9'; }
		if($TipoConsulta == 1){
			$ssql.='ORDER BY 3 DESC limit 0,19';}
		if($TipoConsulta == 2){
			$ssql.='ORDER BY 3 DESC';}	
		$query = mysql_query($ssql);

	 	if ($query){
			while ($resultado = mysql_fetch_array($query)){
				
				if ($NoIngreso == 1){ //Se define el array si tiene datos la consulta
					//Se definen las columnas
					//Se definen las columnas
					$results = array('cols' => array (
        					       			   array ('label' => 'Marca', 'type' => 'string'),
								   			   array ('label' => 'Cantidad', 'type' => 'number'),
								   			   array ('label' => 'Costo', 'type' => 'number')),
    				     			 'rows' => array());
					$NoIngreso++;
				}
				
				$results['rows'][] = array('c' => array(
        							 array('v' => $resultado[1]),
									 array('v' => $resultado[3]),
        							 array('v' => $resultado[2])));
				

			}
			if($NoIngreso > 1){
				$json = json_encode($results, JSON_NUMERIC_CHECK);}
		}
		echo $json;
	}
?>