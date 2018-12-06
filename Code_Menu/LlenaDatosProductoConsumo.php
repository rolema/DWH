<?php
  include '../back_code/Mysql.class.php';
  conectar();
 
 	if (isset($_POST['FechaDe'])){
		//Obtiene valores enviados por la variable POST
	 	$FechaInicial = $_POST['FechaDe'];
	 	$FechaFinal = $_POST['FechaA'];
	 	$options='';
	 
	 	$ssql = 'SELECT DISTINCT(id_producto), PRODUCTO, SUM(importe) FROM `ave_t_mantenimiento_producto` WHERE ';
	 	$ssql .= 'FECHA_RECIBE Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 	$ssql .= ' GROUP BY ID_PRODUCTO, PRODUCTO ORDER BY 3 DESC';
	
	 	$options = '<tr><td>Productos</td>  <td>Importe</td></tr>';	
	
	 	$query = mysql_query($ssql);
	 	if ($query){
	 		while ($resultado = mysql_fetch_row($query)){
			
				$options .= '<tr><td><p align="left">'.$resultado[1].'</p></td>'; //Productos
				$options .= '<td> <p align="right">$ '.number_format($resultado[2], 2).'</p></td></tr>'; //Importe
			}
			echo $options;
		}
 	}
?>