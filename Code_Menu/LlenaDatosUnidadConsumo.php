<?php
  include '../back_code/Mysql.class.php';
  conectar();
 
 	if (isset($_POST['FechaDe'])){
		//Obtiene valores enviados por la variable POST
	 	$FechaInicial = $_POST['FechaDe'];
	 	$FechaFinal = $_POST['FechaA'];
	 	$options='';
	 
	 	$ssql = 'SELECT DISTINCT(id_unidad), TIPO_UNIDAD, ECONOMICO, SUM(importe) FROM `ave_t_mantenimiento_producto` WHERE ';
	 	$ssql .= 'FECHA_RECIBE Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 	$ssql .= ' GROUP BY ID_UNIDAD, TIPO_UNIDAD, ECONOMICO ORDER BY 4 DESC';
	
	 	$options = '<tr><td>TIPO UNIDAD</td> <td>UNIDAD</td> <td>IMPORTE</td></tr>';	
	
	 	$query = mysql_query($ssql);
	 	if ($query){
	 		while ($resultado = mysql_fetch_row($query)){
			
				$options .= '<tr><td><p align="center">'.$resultado[1].'</p></td>'; //Tipo Unidad
				$options .= '<td><p align="center">'.$resultado[2].'</p></td>'; //Tipo Unidad
				$options .= '<td> <p align="right">$ '.number_format($resultado[3], 2).'</p></td></tr>'; //Importe
			}
			echo $options;
		}
 	}
?>