<?php
  require_once '../Clases/PHPExcel-develop/Classes/PHPExcel.php';
  include '../back_code/Mysql.class.php';
  conectar();
 
  if (isset($_REQUEST['TipoUnidad'])){
	 //Obtiene valores enviados por la variable POST
	 $TipoUnidad = $_REQUEST['TipoUnidad'];
	 $Unidad = $_REQUEST['Unidad'];
	 $FechaInicial = $_REQUEST['dtDe'];
	 $FechaFinal = $_REQUEST['dtA'];
	 $IdOrdenTrabajoAnterior = 0;
	 $Ind = 2;
	 
	 //Se crea un objeto de Exel
	 $objPHPExcel = new PHPExcel();

	 //Propiedades que tendra nuestro Hoja de Excel
	 $objPHPExcel->getProperties()
		->setCreator("AveTransportes")
		->setLastModifiedBy("AveTransportes.com")
		->setTitle("ORDEN TRABAJO PRODUCTOS")
		->setSubject("Documento de prueba")
		->setDescription("Documento generado con PHPExcel")
		->setKeywords("usuarios phpexcel")
		->setCategory("reportes");
  	 
	 //Se pone nombre a ls Columnas
	 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'OrdenTrabajo')
            ->setCellValue('B1', 'Folio')
			->setCellValue('C1', 'Fecha')
            ->setCellValue('D1', 'Operador')
			->setCellValue('E1', 'Tipo Unidad')
            ->setCellValue('F1', 'Economico')
			->setCellValue('G1', 'Cantidad')
            ->setCellValue('H1', 'Unidad')
			->setCellValue('I1', 'Producto')
			->setCellValue('J1', 'Costo')
			->setCellValue('K1', 'Importe');
	 
	 $ssql = 'SELECT ID_ORDEN_TRABAJO, FOLIO, FECHA_RECIBE, OPERADOR, TIPO_UNIDAD, ECONOMICO, CANTIDAD, UNIDAD_DESCRIPCION, PRODUCTO, COSTO_PROMEDIO, IMPORTE FROM ave_t_mantenimiento_producto WHERE ';
	 //Si se Seleciono Tipo de Unidad, se incluira en el Where
	 if($TipoUnidad > 0){ 
	 	$ssql .= 'ID_TIPO_UNIDAD = '.$TipoUnidad.' And ';}
	 //Si selecciono Unidad, la incluira en el Where
	 if($Unidad > 0){
	 	$ssql .= 'ID_UNIDAD = '.$Unidad.' And ';} 	

	 $ssql .= 'FECHA_RECIBE Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 if($Unidad > 0){
	   $ssql .= ' Order by 3,1,9'; //Order por: FECHA_RECIBE, ID_ORDEN_TRABAJO, PRODUCTO
	 }else{
	   $ssql .= ' Order by 5,1,2'; } //Order por: TIPO_UNIDAD, ECONOMICO, ID_ORDEN_TRABAJO
	
	 
	 $query = mysql_query($ssql);
	 if ($query){
		while ($resultado = mysql_fetch_row($query)){
			
			
			if($IdOrdenTrabajoAnterior <> $resultado[0]){
				
			  //Se asignan valores a las columnas
			  $objPHPExcel ->setActiveSheetIndex(0)
				-> setCellValue('A'.$Ind, $resultado[0])
            	-> setCellValue('B'.$Ind, $resultado[1])
				-> setCellValue('C'.$Ind, date("d-m-Y", strtotime($resultado[2])))
            	-> setCellValue('D'.$Ind, $resultado[3])
				-> setCellValue('E'.$Ind, $resultado[4])
            	-> setCellValue('F'.$Ind, $resultado[5]);
			}else{
		      $objPHPExcel ->setActiveSheetIndex(0)
				-> setCellValue('A'.$Ind, '') //Id Orden Trabajo
            	-> setCellValue('B'.$Ind, '') //Folio
				-> setCellValue('C'.$Ind, '') //Fecha Recibe
            	-> setCellValue('D'.$Ind, '') //Operador
				-> setCellValue('E'.$Ind, '') //Tipo Unidad
            	-> setCellValue('F'.$Ind, '');//Economico	
			}
		
			
			$objPHPExcel ->setActiveSheetIndex(0)
				-> setCellValue('G'.$Ind, $resultado[6])
            	-> setCellValue('H'.$Ind, $resultado[7])
				-> setCellValue('I'.$Ind, $resultado[8])
            	-> setCellValue('J'.$Ind, $resultado[9])
				-> setCellValue('K'.$Ind, $resultado[10]);
            	
			$IdOrdenTrabajoAnterior = $resultado[0];
			$Ind += 1;
		}
		//Se asigna un Titulo a la ventana de Usuarios
		$objPHPExcel->getActiveSheet()->setTitle('Orden Trabajo Productos');
		$objPHPExcel->setActiveSheetIndex(0);

		//Se limpia el Buffer
		ob_clean();

		//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
		header('Content-Encoding: UTF-8');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment;filename="OrdenTrabajoProductos.xls"'); 
		header('Cache-Control: max-age=0');

		//Escribimos el archivo de Excel
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

		exit;
	}
 } 
?>