<?php 
	include '../back_code/Mysql.class.php';
  	conectar();	
	//Totales//////////
	
	/////////////Total Costo LLanta
	$ssqllantaimporte = 'SELECT SUM(COSTO) FROM ave_t_llanta';
	$queryllantaimporte = mysql_query($ssqllantaimporte);
	$LlantaTotalImporte = mysql_fetch_row($queryllantaimporte);
	$TotalImporte = $LlantaTotalImporte[0];
	echo '$'.number_format($TotalImporte, 2);

?>