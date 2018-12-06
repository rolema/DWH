<?php
	include '../back_code/Mysql.class.php';
  	conectar();
	
 	if(isset($_POST['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_POST['FechaDe'];
	 	$FechaFinal = $_POST['FechaA'];
	 	$Total = 0;	
	  	
		$ssql = 'Select sum(CLL.importe) ';
		$ssql .= 'From ave_t_compra C join ave_t_compra_llanta CLL on(CLL.id_compra = C.id_compra) ';
        $ssql .= 'Where c.FECHA between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 	$query = mysql_query($ssql);	
		if ($query){
			
			while ($resultado = mysql_fetch_row($query)){
				$Total = $resultado[0];
			}
			
			echo '$ '.number_format($Total, 2);
		}
 	}
?>