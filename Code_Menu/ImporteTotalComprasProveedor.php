<?php
	include '../back_code/Mysql.class.php';
  	conectar();
	
 	if(isset($_POST['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_POST['FechaDe'];
	 	$FechaFinal = $_POST['FechaA'];
		$TipoCompra = $_POST['TipoCompra'];
	 	$Total = 0;	
	  	
		$ssql = 'SELECT SUM(IMPORTE) FROM `ave_t_compra` ';
		$ssql .= 'WHERE FECHA between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		switch($TipoCompra){
			case 1: 
				$ssql .= ' And TIPO_COMPRA = 1 ';	
				break;
			case 2:
				$ssql .= ' And TIPO_COMPRA = 2 ';	
				break;
		}
	 	$query = mysql_query($ssql);
				
		if ($query){
			
			while ($resultado = mysql_fetch_row($query)){
				$Total = $resultado[0];
			}
			
			echo '$ '.number_format($Total, 2);
		}
 	}
?>
