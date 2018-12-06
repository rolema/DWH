<?php

	include '../back_code/Mysql.class.php';
  	conectar();
	
	
 
  	if (isset($_POST['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_POST['FechaDe'];
		$FechaFinal = $_POST['FechaA'];
		$options='';
		
		$ssql = 'SELECT ID_PROVEEDOR, PROVEEDOR, SUM(IMPORTE), CASE TIPO_COMPRA When 1 then "PRODUCTOS" when 2 then "LLANTAS" end ';
		$ssql .= 'FROM `ave_t_compra` WHERE FECHA between ';
		$ssql .='"'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'" ';
		$ssql .=' Group by 1,2 ORDER BY 3 desc';
				
		
		$options = '<tr><td><p align="center">Tipo de Compra</p></td><td><p align="center">Proveedor</p></td><td><p align="center">Importe</p></td></tr>';
		$query = mysql_query($ssql);
			if ($query){
			while ($resultado = mysql_fetch_row($query)){
				
				$options .= '<tr><td><p align="center">'.$resultado[3].'</p></td>'; //Tipo de compra
				$options .= '<td><p align="center">'.$resultado[1].'</p></td>'; //Proveedor
				$options .= '<td><p align="center">$	'.$resultado[2].'</p></td></tr>'; //Importe
			}	
		echo $options;
			
			}
	}
?>