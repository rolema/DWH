<?php

	include '../back_code/Mysql.class.php';
  	conectar();
	
	
 
  	if (isset($_POST['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_POST['FechaDe'];
		$FechaFinal = $_POST['FechaA'];
		$TipoOrden = $_POST['TipoOrden'];
		$options='';
		
		$ssql = 'select distinct(ACP.PRODUCTO), sum(ACP.CANTIDAD), SUM(ACP.IMPORTE) ';
			$ssql .=	'from ave_t_compra AC join ave_t_compra_producto ACP ';
			$ssql .=	'on (ACP.ID_COMPRA = AC.ID_COMPRA) ';
			$ssql .=	'where AC.FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"  ';
			$ssql .=	'group by ACP.PRODUCTO ';
		
		if($TipoOrden == 1){
				$ssql .= ' order by 3 desc ';	
				}
		if($TipoOrden == 2){
				$ssql .= ' order by 2 desc ';	
						}
		
		$options = '<tr><td><p align="center">Producto</p></td><td><p align="center">Cantidad</p></td><td><p align="center">Importe</p></td></tr>';
		$query = mysql_query($ssql);
			if ($query){
			while ($resultado = mysql_fetch_row($query)){
				
				$options .= '<tr><td><p>'.$resultado[0].'</p></td>'; //Tipo de compra
				$options .= '<td><p align="center">'.$resultado[1].'</p></td>'; //Proveedor
				$options .= '<td><p align="center">$	'.$resultado[2].'</p></td></tr>'; //Importe
			}	
		echo $options;
			
			}
	}
?>