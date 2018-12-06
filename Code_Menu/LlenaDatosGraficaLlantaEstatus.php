<?php
	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_GET['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_GET['FechaDe'];
		$FechaFinal = $_GET['FechaA'];
		$string='';
		
		$string = '{"cols": [ {"id":"","label":"Estatus","pattern":"","type":"string"},
							  {"id":"","label":"Cantidad","pattern":"","type":"number"}],'.
				  '"rows": [';
	//{"id":"","label":"Importe","pattern":"","type":"number"}],'.
		
		$ssql = 'SELECT distinct(ID_ESTATUS),ESTATUS,sum(COSTO), count(*) ';
		$ssql .= 'FROM `ave_t_mantenimiento_llanta` WHERE ';
		$ssql .= 'FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		$ssql .= 'Group by ID_ESTATUS, ESTATUS order by 3 desc ';
		
	 
		$query = mysql_query($ssql);

	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
				$string.='{"c":[{"v":"'.$resultado[1].'","f":null},{"v":'.$resultado[2].',"f":null}]}]}';
			}
			echo $string;
		}
	
	}
?>