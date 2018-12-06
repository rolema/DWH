<?php
	include '../back_code/Mysql.class.php';
  	conectar();
 
 	if (isset($_POST['TipoElegido'])){
	 	//Obtiene valores enviados por la variable POST
	 	$TipoUnidad = $_POST['TipoElegido'];
	 	$Unidad = $_POST['UnidadElegida'];
	 	$FechaInicial = $_POST['FechaDe'];
	 	$FechaFinal = $_POST['FechaA'];
	 	$Total = 0;
	 
	 	$ssql = 'SELECT SUM(COSTO) FROM ave_t_mantenimiento_llanta WHERE ';
	 	
		//Si se Seleciono Tipo de Unidad, se incluira en el Where
	 	if($_POST['TipoElegido'] > 0){ 
	 		$ssql .= 'ID_TIPO_UNIDAD = '.$TipoUnidad.' And ';}
			
	 	//Si selecciono Unidad, la incluira en el Where
	 	if($_POST['UnidadElegida'] > 0){
	 		$ssql .= 'ID_UNIDAD = '.$Unidad.' And ';} 	
	 	$ssql .= 'FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 
	 	$query = mysql_query($ssql);
	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
					$Total = $resultado[0];
			}
			echo '$ '.number_format($Total, 2);
		}
 	}
?>