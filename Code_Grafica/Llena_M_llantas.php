<?php 
 include '../back_code/Mysql.class.php';
  conectar();
  
  $E_LLANTAS_M = $_GET['variable']; 
	$options='';
  
  
  $ssql =	'select distinct(MARCA), sum(COSTO), count(*)  ';
 
  $ssql .= 'FROM ave_t_llanta WHERE ';
	
	if($E_LLANTAS_M == "DISPONIBLES")
  		{
  		$ssql .=' EN_USO = 0 and SIN_DESECHAR = 0';
		}
  	
	if($E_LLANTAS_M == "UBICADAS")
  		{
  		$ssql .=' EN_USO = 1 and SIN_DESECHAR = 0';
		}
  
  	
	if($E_LLANTAS_M == "LISTAS PARA RENOVACION")
  		{
  		$ssql .=' EN_USO = 0 and SIN_DESECHAR = 1';
		}
	
	if($E_LLANTAS_M == "EN RENOVACION")
  	{
  		$ssql .=' EN_USO = 0 and SIN_DESECHAR = 2';
	}
	
	if($E_LLANTAS_M == "DESECHADAS")
  	{
  		$ssql .=' EN_USO = 2 and SIN_DESECHAR = 0';
	}
	
	$ssql .=' group by `MARCA` order by 2 desc';
	
	$options = ' <div id="tabla_llantas_grafica" class="ConsultarLlantasGrafica" >
				 <table  border="1" id="tbConsulta" name="tbConsulta">
                    <tr>
                        <td>Marca</td>
						<td>cantidad</td>
                        <td>Costo</td>
                     </tr>';
	
	$query = mysql_query( $ssql);
	
	 if ($query){
		while ($resultado = mysql_fetch_row($query)){
			//if($resultado[0]){
				$options .= '<tr><td><p align="center">'.$resultado[0].'</p></td>'; //Marca
				$options .= '<td><p align="center">'.$resultado[2].'</p></td>'; //Marca
				$options .= '<td><p align="center">$'.number_format($resultado[1], 2).'</td></tr>'; //Costo
				
				//}
				
			}
			$options .= '</table></div>';
			echo $options;
		}
	
?>