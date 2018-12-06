<?php

	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_GET['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_GET['FechaDe'];
		$FechaFinal = $_GET['FechaA'];
		$TipoConsulta = $_GET['TipoConsulta'];
		$TipoOrden = $_GET['TipoOrden'];
		$json = "vacio";
		$NoIngreso = 1;
		
		$ssql = 'select distinct(ACP.PRODUCTO), sum(ACP.CANTIDAD), SUM(ACP.IMPORTE) ';
		$ssql .= 'from ave_t_compra AC join ave_t_compra_producto ACP ';
		$ssql .= 'on (ACP.ID_COMPRA = AC.ID_COMPRA) ';
		$ssql .= 'where AC.FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"  ';
		$ssql .= 'group by ACP.PRODUCTO ';
		
		if($TipoOrden == 1){
				$ssql .= ' order by 3 desc ';	
				}
		if($TipoOrden == 2){
				$ssql .= ' order by 2 desc ';	
						}
						
		if($TipoConsulta == 0){
			$ssql.='limit 0,10'; }
		if($TipoConsulta == 1){
			$ssql.='limit 0,20';}
		if($TipoConsulta == 2){
			$ssql.='limit 0,250';}	
			
		$query = mysql_query($ssql);	
						
	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
				
				if ($NoIngreso == 1){ //Se define el array si tiene datos la consulta
					//Se definen las columnas
					$results = array('cols' => array (
        								       array ('label' => 'Producto', 'type' => 'string'), //0
											   array ('label' => 'Cantidad', 'type' => 'number'), //1
        					       			   array ('label' => 'Importe', 'type' => 'number')), //2
    				     			 'rows' => array());
					$NoIngreso++;
				}
				
				$results['rows'][] = array('c' => array(
        							 array('v' => $resultado[0]),
									 array('v' => $resultado[1]),
        							 array('v' => $resultado[2])));
			}
			if($NoIngreso > 1){
				$json = json_encode($results, JSON_NUMERIC_CHECK);}
		}
		echo $json;
	}


?>