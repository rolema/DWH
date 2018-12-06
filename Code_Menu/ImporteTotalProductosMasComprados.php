<?php
	include '../back_code/Mysql.class.php';
  	conectar();
	
 	if(isset($_POST['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_POST['FechaDe'];
	 	$FechaFinal = $_POST['FechaA'];
	 	$Total = 0;	
	  	
		$ssql = 'SELECT SUM(ACP.importe) FROM `ave_t_compra` AC join ave_t_compra_producto ACP ';
		$ssql .= 'on (ACP.ID_COMPRA = AC.ID_COMPRA) '; 
	 	$ssql .= 'WHERE AC.FECHA between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 	$query = mysql_query($ssql);
				
		if ($query){
			
			while ($resultado = mysql_fetch_row($query)){
				$Total = $resultado[0];
			}
			
			echo '$ '.number_format($Total, 2);
		}
 	}
?>
