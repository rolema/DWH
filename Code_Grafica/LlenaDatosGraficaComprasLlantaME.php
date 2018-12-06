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
		
		if ($TipoCompra == 0){
			$ssql = 'Select distinct(CLL.id_marca), CLL.marca, count(*), sum(cll.importe) ';
			$ssql .= 'From ave_t_compra C join ave_t_compra_llanta CLL on(CLL.id_compra = C.id_compra) ';
            $ssql .= 'Where c.FECHA between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
			$ssql .= 'Group by CLL.id_marca, CLL.marca Order by 4 desc ';		
		}
		
		if ($TipoCompra == 1){
			$ssql = 'Select distinct(CLL.id_estatus), CLL.estatus, count(*), sum(cll.importe) ';
			$ssql .= 'From ave_t_compra C join ave_t_compra_llanta CLL on(CLL.id_compra = C.id_compra) ';
            $ssql .= 'Where c.FECHA between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
			$ssql .= 'Group by CLL.id_estatus, CLL.estatus Order by 4 desc ';		
		}
		if($TipoConsulta == 0){
			$ssql.='limit 0,10'; }
		if($TipoConsulta == 1){
			$ssql.='limit 0,20';}
		
		$query = mysql_query($ssql);
		if ($query){
			while ($resultado = mysql_fetch_row($query)){
				
				if ($NoIngreso == 1){ //Se define el array si tiene datos la consulta
					//Se definen las columnas
					if ($TipoCompra == 0){
						$results = array('cols' => array (
												   array ('label' => 'Marca', 'type' => 'string'),
												   array ('label' => 'Cantidad', 'type' => 'number'),
												   array ('label' => 'Importe', 'type' => 'number')),
										 'rows' => array());
					}
					if ($TipoCompra == 1){
						$results = array('cols' => array (
												   array ('label' => 'Estatus', 'type' => 'string'),
												   array ('label' => 'Cantidad', 'type' => 'number'),
												   array ('label' => 'Importe', 'type' => 'number')),
										 'rows' => array());
					}
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