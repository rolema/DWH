<?php
	require_once '../Clases/PHPExcel-develop/Classes/PHPExcel.php';
  	include '../back_code/Mysql.class.php';
  	conectar();
 
  	if (isset($_REQUEST['TipoUnidad'])){
	 	//Obtiene valores enviados por la variable POST
	 	$TipoUnidad = $_REQUEST['TipoUnidad'];
	 	$Unidad = $_REQUEST['Unidad'];
	 	$options='';
	 	$IdUnidad = 0;
		$Ind = 2;
		
		//Se crea un objeto de Exel
	 	$objPHPExcel = new PHPExcel();

	 	//Propiedades que tendra nuestro Hoja de Excel
	 	$objPHPExcel->getProperties()
			->setCreator("AveTransportes")
			->setLastModifiedBy("AveTransportes.com")
			->setTitle("LLANTAS PROFUNDIDAD")
			->setSubject("Documento de prueba")
			->setDescription("Documento generado con PHPExcel")
			->setKeywords("usuarios phpexcel")
			->setCategory("reportes");
  	 
	 	//Se pone nombre a ls Columnas
	 	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tipo Unidad')
            ->setCellValue('B1', 'Unidad')
			->setCellValue('C1', 'Folio Inventario')
            ->setCellValue('D1', 'Marca')
			->setCellValue('E1', 'Medida')
            ->setCellValue('F1', 'Matricula')
			->setCellValue('G1', 'Profunidad')
            ->setCellValue('H1', 'Fecha');
	 
	 	$ssql = 'SELECT TIPO_UNIDAD, UNIDAD, FOLIO_INVENTARIO, MARCA, MEDIDA, MATRICULA, MILIMETROS, FECHA_HORA, ID_UNIDAD FROM ave_t_llanta_profundidad ';
	 	//Si se Seleciono Tipo de Unidad, se incluira en el Where
	 	if($_REQUEST['TipoUnidad'] > 0){ 
	 		$ssql .= 'WHERE ID_TIPO_UNIDAD = '.$TipoUnidad;}
	 	//Si selecciono Unidad, la incluira en el Where
	 	if($_REQUEST['Unidad'] > 0){
	 		$ssql .= ' AND ID_UNIDAD = '.$Unidad;} 	
	 	$ssql .= ' Order by 1,2,3'; 
	
	 
	 	$query = mysql_query($ssql);
	 	if ($query){
			while ($resultado = mysql_fetch_row($query)){
			
				if($IdUnidad <> $resultado[8]){
					
					$objPHPExcel ->setActiveSheetIndex(0)
						-> setCellValue('A'.$Ind, $resultado[0]) //TIPO_UNIDAD
            			-> setCellValue('B'.$Ind, $resultado[1]);//UNIDAD
				
				}else{
					$objPHPExcel ->setActiveSheetIndex(0)
						-> setCellValue('A'.$Ind,'') //TIPO_UNIDAD
    	        		-> setCellValue('B'.$Ind,'');//UNIDAD
				}
				
				$objPHPExcel ->setActiveSheetIndex(0)
					-> setCellValue('C'.$Ind, $resultado[2])
            		-> setCellValue('D'.$Ind, $resultado[3])
					-> setCellValue('E'.$Ind, $resultado[4])
            		-> setCellValue('F'.$Ind, $resultado[5])
					-> setCellValue('G'.$Ind, $resultado[6])
					-> setCellValue('H'.$Ind, date("d-m-Y H:i:s", strtotime($resultado[7])));  

				$IdUnidad = $resultado[8];
				$Ind += 1;
			}
			//Se asigna un Titulo a la ventana de Usuarios
			$objPHPExcel->getActiveSheet()->setTitle('Profundidad Llantas');
			$objPHPExcel->setActiveSheetIndex(0);

			//Se limpia el Buffer
			ob_clean();

			//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
			header('Content-Encoding: UTF-8');
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			//header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
			header('Content-Disposition: attachment;filename="LlantasProfundidad.xls"'); 
			header('Cache-Control: max-age=0');

			//Escribimos el archivo de Excel
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');

			exit;
		}
 	}
?>