<?php

  include '../back_code/Mysql.class.php';
  conectar();
 
 $options='';
 if (isset($_POST["elegido"])){
	 
	 switch($_POST["elegido"]){
		case 1:
			$ssql = 'Select ID_CARRO, ECONOMICO From ave_c_carro Where ID_CARRO > 0 Order by 2';
			break;
		case 2:
			$ssql = 'Select ID_REMOLQUE, ECONOMICO From ave_c_remolque Where ID_REMOLQUE > 0 Order by 2';
			break;
		case 3:
			$ssql = 'Select ID_DOLLY, ECONOMICO From ave_c_dolly Where ID_DOLLY > 0 Order by 2';
			break;
	  }
	 
	  $options .= '<option value="0">Seleccione Unidad...</option>';
	  $query = mysql_query($ssql);
	  if ($query){
		while ($resultado = mysql_fetch_row($query)){
			$options .= '<option value="'.$resultado[0].'">'.$resultado[1].'</option>';
			
		}
		echo $options;
	  }
 }
?>