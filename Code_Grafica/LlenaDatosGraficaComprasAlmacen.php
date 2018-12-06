<?php

include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_GET['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_GET['FechaDe'];
		$FechaFinal = $_GET['FechaA'];
		$TipoConsultaCompra = $_GET['TipoConsultaCompra'];
		$json = "vacio";
		$NoIngreso = 1;
	
		switch ($TipoConsultaCompra)
		{
    	case 0:
        	$ssql = 'select distinct(ACP.ID_CUENTA), sum(ACP.IMPORTE), ACP.CUENTA ';
			$ssql .=	'from ave_t_compra AC join ave_t_compra_producto ACP ';
			$ssql .= 	'on (ACP.ID_COMPRA = AC.ID_COMPRA) ';
			$ssql .=	'where AC.FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"  ';
			$ssql .=	'group by 1 ';
			$ssql .= 	'union  ';
        	$ssql .= 	'select 3, sum(ACLL.IMPORTE), "ALMACEN DE LLANTAS"  ';
			$ssql .=	'from ave_t_compra AC join ave_t_compra_llanta ACLL ';
			$ssql .=	'on (ACLL.ID_COMPRA = AC.ID_COMPRA) ';
			$ssql .=	'where AC.FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'" ';
			$ssql .=	'group by 1 order by 2 desc';
        	
		break;
    
		case 1:
        	$ssql = 'select distinct(ACP.ID_CUENTA), sum(ACP.IMPORTE), ACP.CUENTA ';
			$ssql .=	'from ave_t_compra AC join ave_t_compra_producto ACP ';
			$ssql .=	'on (ACP.ID_COMPRA = AC.ID_COMPRA) ';
			$ssql .=	'where AC.FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"  ';
			$ssql .=	'group by 1 order by 2 desc';
        break;
    
		case 2:
        	$ssql = 'select 3, sum(ACLL.IMPORTE), "ALMACEN DE LLANTAS" ';
			$ssql .=	'from ave_t_compra AC join ave_t_compra_llanta ACLL ';
			$ssql .=	'on (ACLL.ID_COMPRA = AC.ID_COMPRA) ';
			$ssql .=	'where AC.FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'" ';
			$ssql .=	'group by 1 order by 2 desc';
        break;
    	
		}
		
		$query = mysql_query($ssql);
		
		
		if ($query){
			while ($resultado = mysql_fetch_row($query)){
				
				if ($NoIngreso == 1){ //Se define el array si tiene datos la consulta
					//Se definen las columnas
					//Se definen las columnas
					$results = array('cols' => array (
        					       			   array ('label' => 'Cuenta', 'type' => 'string'),
								   			   array ('label' => 'Importe', 'type' => 'number')),
    				     			 'rows' => array());
					$NoIngreso++;
				}
				
				$results['rows'][] = array('c' => array(
        							 array('v' => $resultado[2]),
									 array('v' => $resultado[1])));
				

			}
			if($NoIngreso > 1){
				$json = json_encode($results, JSON_NUMERIC_CHECK);}
		}
		echo $json;
	
	}
?>