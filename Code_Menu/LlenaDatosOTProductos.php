<?php
  include '../back_code/Mysql.class.php';
  conectar();
 
  if (isset($_POST['TipoElegido'])){
	 //Obtiene valores enviados por la variable POST
	 $TipoUnidad = $_POST['TipoElegido'];
	 $Unidad = $_POST['UnidadElegida'];
	 $FechaInicial = $_POST['FechaDe'];
	 $FechaFinal = $_POST['FechaA'];
	 $options='';
	 $IdOrdenTrabajoAnterior = 0;
	 
	 $ssql = 'SELECT ID_ORDEN_TRABAJO, FOLIO, FECHA_RECIBE, OPERADOR, TIPO_UNIDAD, ECONOMICO, CANTIDAD, UNIDAD_DESCRIPCION, PRODUCTO, COSTO_PROMEDIO, IMPORTE ';
	 $ssql .= 'FROM ave_t_mantenimiento_producto WHERE ';
	 if($TipoUnidad > 0){ //Si se Seleciono Tipo de Unidad, se incluira en el Where
	 	$ssql .= 'ID_TIPO_UNIDAD = '.$TipoUnidad.' And ';}
	 if($Unidad > 0){ //Si selecciono Unidad, la incluira en el Where
	 	$ssql .= 'ID_UNIDAD = '.$Unidad.' And ';} 	
	 $ssql .= 'FECHA_RECIBE Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 if($Unidad > 0){
	   $ssql .= ' Order by 3,1,9'; //Order por: FECHA_RECIBE, ID_ORDEN_TRABAJO, PRODUCTO
	 }else{
	   $ssql .= ' Order by 5,1,2'; } //Order por: TIPO_UNIDAD, ECONOMICO, ID_ORDEN_TRABAJO
	
	
	$options = '<tr><td>Orden Trabajo</td>  <td>Folio</td>  <td>Fecha</td>  <td>Operador</td>  <td>Tipo</td>  <td>Economico</td>  <td>Cantidad</td>  <td>Unidad</td>  <td>Producto</td>  <td>Costo</td>  <td>Importe</td>  </tr>';	
	
	 $query = mysql_query($ssql);
	 if ($query){
		while ($resultado = mysql_fetch_row($query)){
			
			if($IdOrdenTrabajoAnterior <> $resultado[0]){
				$options .= '<tr><td><p align="center">'.$resultado[0].'</p></td>'; //Id Orden Trabajo
				$options .= '<td>'.$resultado[1].'</td>'; //Folio
				$options .= '<td>'.date("d-m-Y", strtotime($resultado[2])).'</td>'; //Fecha Recibe
				$options .= '<td>'.$resultado[3].'</td>'; //Operador
				$options .= '<td><p align="center">'.$resultado[4].'</p></td>'; //Tipo Unidad
				$options .= '<td><p align="center">'.$resultado[5].'</p></td>'; //Economico
			}else{
				$options .= '<tr><td></td>'; //Id Orden Trabajo
				$options .= '<td></td>'; //Folio
				$options .= '<td></td>'; //Fecha Recibe
				$options .= '<td></td>'; //Operador
				$options .= '<td></td>'; //Tipo Unidad
				$options .= '<td></td>'; //Economico	
			}
			
			$options .= '<td><p align="center">'.$resultado[6].'</p></td>'; //Cantidad
			$options .= '<td>'.$resultado[7].'</td>'; //Unidad Descripcion
			$options .= '<td>'.$resultado[8].'</td>'; //Producto
			$options .= '<td> <p align="right">$ '.number_format($resultado[9], 2).'</p></td>'; //Costo Promedio
			$options .= '<td> <p align="right">$ '.number_format($resultado[10], 2).'</p></td></tr>'; //Importe
			
			$IdOrdenTrabajoAnterior = $resultado[0];
		}
		echo $options;
	}
 }
  
?>