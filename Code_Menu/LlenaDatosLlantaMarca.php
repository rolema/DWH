<?php
	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_POST['FechaDe'])){
		
		//Obtiene valores enviados por la variable POST
		$FechaInicial = $_POST['FechaDe'];
		$FechaFinal = $_POST['FechaA'];
		$options='';
		$IdOrdenTrabajoAnterior = 0;
		
		$ssql = 'SELECT distinct(ID_MARCA),MARCA,sum(COSTO), count(*) ';
		$ssql .= 'FROM `ave_t_mantenimiento_llanta` WHERE ';
		$ssql .= 'FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		$ssql .= 'Group by ID_MARCA, MARCA order by 3 desc ';
		
		$options = '<tr> <td>MARCA</td>  <td>CANTIDAD</td>  <td>IMPORTE</td>  </tr>';	
	 
		$query = mysql_query($ssql);

	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
			
				$options .= '<td><p align="left">'.$resultado[1].'</p></td>'; //Estatus
				$options .= '<td><p align="center">'.$resultado[3].'</p></td>'; //Cantidad
				$options .= '<td> <p align="right">$ '.number_format($resultado[2], 2).'</p></td></tr>'; //Importe
					
			}
			echo $options;
		}
	
	}
?>