<?php

	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_GET['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_GET['FechaDe'];
		$FechaFinal = $_GET['FechaA'];
		$TipoConsulta = $_GET['TipoConsulta'];
		$TipoCompra = $_GET['TipoCompra'];
		$json = "vacio";
		$NoIngreso = 1;
		
		$ssql = 'SELECT ID_PROVEEDOR, PROVEEDOR, SUM(IMPORTE), CASE TIPO_COMPRA When 1 then "PRODUCTOS" when 2 then "LLANTAS" end ';
		$ssql .= 'FROM `ave_t_compra` WHERE FECHA between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		switch($TipoCompra){
			case 1: 
				$ssql .= ' And TIPO_COMPRA = 1 ';	
				break;
			case 2:
				$ssql .= ' And TIPO_COMPRA = 2 ';	
				break;
		}
	 	$ssql .= 'Group by ID_PROVEEDOR ';
		if($TipoConsulta == 0){
			$ssql.='ORDER BY 3 DESC limit 0,10'; }
		if($TipoConsulta == 1){
			$ssql.='ORDER BY 3 DESC limit 0,20';}
		if($TipoConsulta == 2){
			$ssql.='ORDER BY 3 DESC';}		
		$query = mysql_query($ssql);
		
	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
				
				if ($NoIngreso == 1){ //Se define el array si tiene datos la consulta
					//Se definen las columnas
					$results = array('cols' => array (
        								       array ('label' => 'Tipo de Compra', 'type' => 'string'),
											   array ('label' => 'Proveedor', 'type' => 'string'),
        					       			   array ('label' => 'Importe', 'type' => 'number')),
    				     			 'rows' => array());
					$NoIngreso++;
				}
				
				$results['rows'][] = array('c' => array(
        							 array('v' => $resultado[3]),
									 array('v' => $resultado[1]),
        							 array('v' => $resultado[2])));
			}
			if($NoIngreso > 1){
				$json = json_encode($results, JSON_NUMERIC_CHECK);}
		}
		echo $json;
	}


?>