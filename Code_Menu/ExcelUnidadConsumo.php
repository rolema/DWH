<?php

  require_once '../Clases/PHPExcel-develop/Classes/PHPExcel.php';
  include '../back_code/Mysql.class.php';
  conectar();
 
  if (isset($_REQUEST['dtDe'])){
	 //Obtiene valores enviados por la variable POST
	 $FechaInicial = $_REQUEST['dtDe'];
	 $FechaFinal = $_REQUEST['dtA'];
	 $Ind = 2;
	 
	 //Se crea un objeto de Exel
	 $objPHPExcel = new PHPExcel();

	 //Propiedades que tendra nuestro Hoja de Excel
	 $objPHPExcel-> getProperties()
		->setCreator("AveTransportes")
		->setLastModifiedBy("TEDnologia.com")
		->setTitle("PRODUCTOS CON MAYOR CONSUMO")
		->setSubject("Documento de prueba")
		->setDescription("Documento generado con PHPExcel")
		->setKeywords("usuarios phpexcel")
		->setCategory("reportes");
  	 
	 //Se pone nombre a ls Columnas
	 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'TIPO UNIDAD')
            ->setCellValue('B1', 'UNIDAD')
			->setCellValue('C1', 'IMPORTE');
	 
	 $ssql = 'SELECT DISTINCT(id_unidad), TIPO_UNIDAD, ECONOMICO, SUM(importe) FROM `ave_t_mantenimiento_producto` WHERE ';
	 //$ssql .= 'FECHA_RECIBE Between "2014/01/01" And "2014/03/31" ';
	 $ssql .= 'FECHA_RECIBE Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
	 $ssql .= ' GROUP BY ID_UNIDAD, TIPO_UNIDAD, ECONOMICO ORDER BY 4 DESC';
	
	$query = mysql_query($ssql);
	 if ($query){
		while ($resultado = mysql_fetch_row($query)){
			//Se asignan valores a las columnas
			$objPHPExcel ->setActiveSheetIndex(0)
				-> setCellValue('A'.$Ind, $resultado[1])
				-> setCellValue('B'.$Ind, $resultado[2])
            	-> setCellValue('C'.$Ind, $resultado[3]);
			
			$Ind += 1;
		}
		
		//Se asigna un Titulo a la ventana de Usuarios
		$objPHPExcel->getActiveSheet()->setTitle('Unidad Consumo');
		$objPHPExcel->setActiveSheetIndex(0);

		//Se limpia el Buffer
		ob_clean();
		
		//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
		header('Content-Type: application/vnd.ms-excel; charset = UTF-8');
		header('Content-Disposition: attachment;filename="UnidadConsumo.xls"'); //attachment
		header('Cache-Control: max-age=0');

		//Escribimos el archivo de Excel
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

		exit;
	}
 }
?>


