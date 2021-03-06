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
		->setTitle("MARCA CON MAYOR CONSUMO")
		->setSubject("Documento de prueba")
		->setDescription("Documento generado con PHPExcel")
		->setKeywords("usuarios phpexcel")
		->setCategory("reportes");
  	 
	 //Se pone nombre a ls Columnas
	 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'MARCA')
            ->setCellValue('B1', 'CANTIDAD')
			->setCellValue('C1', 'COSTO');
	 
		$ssql = 'SELECT distinct(ID_MARCA),MARCA,sum(COSTO), count(*) ';
		$ssql .= 'FROM `ave_t_mantenimiento_llanta` WHERE ';
		$ssql .= 'FECHA Between "'.date("Y-m-d", strtotime($FechaInicial)).'" And "'.date("Y-m-d", strtotime($FechaFinal)).'"';
		$ssql .= 'Group by ID_MARCA, MARCA order by 3 desc ';

	
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
		
		//Se asigna un Titulo a la ventana de Usuarios
		$objPHPExcel->getActiveSheet()->setTitle('Marca Consumo');
		$objPHPExcel->setActiveSheetIndex(0);

		//Se limpia el Buffer
		ob_clean();
		
		//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
		header('Content-Type: application/vnd.ms-excel; charset = UTF-8');
		header('Content-Disposition: attachment;filename="MarcaConsumo.xls"'); //attachment
		header('Cache-Control: max-age=0');

		//Escribimos el archivo de Excel
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

		exit;
	}
 }
?>


