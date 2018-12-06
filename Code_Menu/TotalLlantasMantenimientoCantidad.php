<?php 
	include '../back_code/Mysql.class.php';
  	conectar();	
	//Totales//////////
	
	////////////Total cantidad de llantas
	$ssqllantacantidad = 'SELECT COUNT(*) FROM ave_t_llanta';
	$queryllantacantidad = mysql_query($ssqllantacantidad);
	$LlantaTotalcantidad = mysql_fetch_row($queryllantacantidad);
	$TotalCantidad = $LlantaTotalcantidad[0];
	echo $TotalCantidad;
	
?>