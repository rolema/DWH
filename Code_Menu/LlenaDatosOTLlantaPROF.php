<?php
  include '../back_code/Mysql.class.php';
  conectar();
 
  if (isset($_POST['TipoElegido'])){
	 //Obtiene valores enviados por la variable POST
	 $TipoUnidad = $_POST['TipoElegido'];
	 $Unidad = $_POST['UnidadElegida'];
	 $options='';
	 $IdUnidad = 0;
	 
	 $ssql = 'SELECT FOLIO, SERIE, TIPO_UNIDAD, UNIDAD, POSICION, FOLIO_INVENTARIO, MARCA, MEDIDA, MATRICULA, MILIMETROS, FECHA_HORA, ID_UNIDAD FROM ave_t_llanta_profundidad ';
	 //Si se Seleciono Tipo de Unidad, se incluira en el Where
	 if($_POST['TipoElegido'] > 0){ 
	 	$ssql .= 'WHERE ID_TIPO_UNIDAD = '.$TipoUnidad;}
	 //Si selecciono Unidad, la incluira en el Where
	 if($_POST['UnidadElegida'] > 0){
	 	$ssql .= ' AND ID_UNIDAD = '.$Unidad;} 	
	 $ssql .= ' Order by 1,2,3,5'; //Order por: TIPO_UNIDAD, UNIDAD, FOLIO_INVENTARIO
	
	$options = '<tr><td>Folio</td>
                    <td>Serie</td>
					<td>Tipo</td>
                    <td>Unidad</td>
                    <td>Posicion</td>
                    <td>Folio Inventario</td>
                    <td>Marca</td>
                    <td>Medida</td>
                    <td>Matricula</td>
                    <td>Profundidad</td>
                    <td>Fecha</td></tr>';	
	
	 $query = mysql_query($ssql);
	 if ($query){
		while ($resultado = mysql_fetch_row($query)){
			
			if($IdUnidad <> $resultado[11]){
				$options .= '<tr><td>'.$resultado[0].'</td>';//SERIE
				$options .= '<td><p align="center">'.$resultado[1].'</p></td>'; //FOLIO
				$options .= '<td>'.$resultado[2].'</td>';//TIPO_UNIDAD
				$options .= '<td><p align="center">'.$resultado[3].'</p></td>'; //UNIDAD
				
			}else{
				$options .= '<tr><td></td>';//FOLIO
				$options .= '<td></td>'; //SERIE
				$options .= '<td></td>'; //TIPO_UNIDAD
				$options .= '<td></td>'; //UNIDAD		
			}
			$options .= '<td><p align="center">'.$resultado[4].'</p></td>'; //POSICION
			$options .= '<td><p align="center">'.$resultado[5].'</p></td>'; //FOLIO INVENTARIO
			$options .= '<td><p align="center">'.$resultado[6].'</p></td>'; //MARCA
			$options .= '<td><p align="center">'.$resultado[7].'</p></td>'; //MEDIDA
			$options .= '<td><p align="center">'.$resultado[8].'</p></td>'; //MATRICULA
			$options .= '<td><p align="center">'.$resultado[9].'</p></td>'; //PROFUNDIDAD
			$options .= '<td><p align="center">'.date("d-m-Y H:i:s", strtotime($resultado[10])).'</p></td></tr>'; //FECHA
			$IdUnidad = $resultado[11];
		}
		echo $options;
	}
	
	
 }
  
?>