<?php
	require_once '../Clases/PHPExcel-develop/Classes/PHPExcel.php';
	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_REQUEST['dtDe'])){
		
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
			->setTitle("Consumo de Llantas por Estatus")
			->setSubject("Documento de prueba")
			->setDescription("Documento generado con PHPExcel")
			->setKeywords("usuarios phpexcel")
			->setCategory("reportes");
		 
		 //Se pone nombre a ls Columnas
		 $objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'ESTATUS')
				->setCellValue('B1', 'CANTIDAD')
				->setCellValue('C1', 'IMPORTE');
		
		$ssql = 'SELECT distinct(ID_ESTATUS),ESTATUS,sum(COSTO), count(*) ';
		$ssql .= 'FROM `ave_t_mantenimiento_llanta` WHERE ';
		$ssql .= 'FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		$ssql .= 'Group by ID_ESTATUS, ESTATUS order by 3 desc ';
	 
		$query = mysql_query($ssql);

	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
     		  
			  //Se asignan valores a las columnas
			  $objPHPExcel ->setActiveSheetIndex(0)
				-> setCellValue('A'.$Ind, $resultado[1])
            	-> setCellValue('B'.$Ind, $resultado[3])
				-> setCellValue('C'.$Ind, $resultado[2]);
				
			  $Ind += 1;
				
			}
			echo $options;
		}
		//Se asigna un Titulo a la ventana de Usuarios
		$objPHPExcel->getActiveSheet()->setTitle('Consumo de Llanta por Estatus');
		$objPHPExcel->setActiveSheetIndex(0);

		//Se limpia el Buffer
		ob_clean();

		//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
		header('Content-Encoding: UTF-8');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="ConsumoLlantaEstatus.xls"'); 
		header('Cache-Control: max-age=0');

		//Escribimos el archivo de Excel
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//$objWriter->save('ConsumoLlantaEstatus.xls');
		$objWriter->save('php://output');

		exit;
	
	}
?>