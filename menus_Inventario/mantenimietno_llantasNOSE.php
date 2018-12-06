<?php 
	/*session_start();
	
	//version 5.4 trae false, version 5.2 trae verdadero por lo cual se invierte para v 5.4
	if(isset($_SESSION['login'])){
		echo "<SCRIPT LANGUAGE='javascript'> alert(";
		echo $_SESSION['login'];
		echo "); javascript:window.location='.../index.php'; </SCRIPT>";
	}*/
?>

<!DOCTYPE html>
<head>
<?php include ("../contenido/menu.php"); ?>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--CSS calendario-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--JS de acciones de Boton-->
<script src="../js/menu_jquery.js"></script>
<!--CSS controla menu, titulos, boton y tabla-->
<!--<link rel="stylesheet" type="text/css" href="../css/master.css">-->


<title>Estatus LLantas</title>
</head>
<?php
	include '../back_code/Mysql.class.php';
  	conectar();
	
	$ssql =	'SELECT EN_USO, SIN_DESECHAR, ';
	
	$ssql .= 'CASE '; 
	
	$ssql .= 'WHEN(EN_USO = 0 AND SIN_DESECHAR = 0) THEN "DISPONIBLES" ';
	$ssql .= 'WHEN(EN_USO = 1 AND SIN_DESECHAR = 0) THEN "UBICADAS" ';
	
	//////prueba/////////////////////////////////////////////////////
	//$ssql .= 'when(EN_USO = 1 and SIN_DESECHAR = 1) then "1" ';///
	//$ssql .= 'when(EN_USO = 1 and SIN_DESECHAR = 2) then "2" ';///
	////////////////////////////////////////////////////////////////
	
	$ssql .= 'WHEN(EN_USO = 0 AND SIN_DESECHAR = 1) THEN "LISTAS PARA RENOVACION" ';
	$ssql .= 'WHEN(EN_USO = 0 AND SIN_DESECHAR = 2) THEN "EN RENOVACION" ';
	$ssql .= 'WHEN(EN_USO = 2 AND SIN_DESECHAR = 0) THEN "DESECHADAS" ';

	$ssql .= 'END, ';
	$ssql .= 'SUM(COSTO), COUNT(*) ';

	$ssql .= 'FROM ave_t_llanta GROUP BY EN_USO, SIN_DESECHAR ORDERBY BY 4 DESC';
	//echo $ssql;
	
	$results = array('cols' => array (
        	   array ('label' => 'Estatus', 'type' => 'string'),
			   array ('label' => 'Costo', 'type' => 'number'),
			   array ('label' => 'Cantidad', 'type' => 'number')),
    			'rows' => array());
	
	$query = mysql_query($ssql);

	 if ($query){
		while ($resultado = mysql_fetch_array($query)){

			$results['rows'][] = array('c' => array(
       							 array('v' => $resultado[2]),
								 array('v' => $resultado[3]),
       							 array('v' => $resultado[4])));
		}
		
		$json = json_encode($results, JSON_NUMERIC_CHECK/*no olvides poner este*/);
	}
			
			
	//Totales//////////
	
	/////////////Total Costo LLanta
	$ssqllantaimporte = 'SELECT SUM(COSTO) FROM ave_t_llanta';
	$queryllantaimporte = mysql_query($ssqllantaimporte);
	$LlantaTotalImporte = mysql_fetch_row($queryllantaimporte);
	$TotalImporte = $LlantaTotalImporte[0];
	//echo '$'.number_format($TotalImporte, 2);


	////////////Total cantidad de llantas
	$ssqllantacantidad = 'SELECT count(*) FROM ave_t_llanta';
	$queryllantacantidad = mysql_query($ssqllantacantidad);
	$LlantaTotalcantidad = mysql_fetch_row($queryllantacantidad);
	$TotalCantidad = $LlantaTotalcantidad[0];
	//echo $TotalCantidad;
	
	
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">


	//alert('Entro al java script');
 	google.load("visualization", '1.0', {'packages':['controls']});
    google.load("visualization", '1', {packages: ["corechart"]});
		
	google.setOnLoadCallback(drawChart);
	//alert('Mando al evento drawChart');	

    function drawChart() {
	

		var data = new google.visualization.DataTable(<?=$json?>);
		 
		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1_Estatus_llantas',
    		'options': {
      			'filterColumnLabel': 'Costo',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
		
		//alert('Entro al SLIDER');
		var categoryPicker = new google.visualization.ControlWrapper({
    		'controlType': 'CategoryFilter',
    		'containerId': 'control2_Estatus_llantas',
    		'options': {
      			'filterColumnLabel': 'Estatus',
      			'ui': {
      				'labelStacking': 'vertical',
        			'allowTyping': false,
        			'allowMultiple': false
      			}
    		}
  		});
		
		//alert('Entro al picker');
		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div_Estatus_llantas',
    		'options': {
      			'width': 900,
      			'height': 700,
      			'legend': 'bottom',
				'is3D': 'true',
      			'chartArea': {'left': 80, 'top': 150, 'right': 0, 'bottom': 0},
      			'pieSliceText': 'percentage'
    		},
			
			'view': {'columns': [0, 2]}
  		});

		//alert('Entro al pie');
  		var table = new google.visualization.ChartWrapper({
    		'chartType': 'Table',
    		'containerId': 'table_div_Estatus_llantas',
    		'options': {
      			'width': '400px'
    		}
  		});

		
		var formatter = new google.visualization.NumberFormat({prefix: "$"});
      	formatter.format(data,1); //Segundo parametro es la columna a la que se le dara formato 
		//alert('Entro al formato');
  		new google.visualization.Dashboard(document.getElementById('dashboard_div_Estatus_llantas')).bind([slider, categoryPicker], [pie,table]).draw(data);
		
	}
</script>
<body>
<div class="principal">
	
	<form class="menu1" id="menu_1">
        <div id="espacio">
			<h1 class="espacio">
				<p><span>E</span>status de llantas</h1></p>
		</div>

		<div class="menu1" id="caja_menu_select_1" ></div>
		<!--<input type="submit" name="btnExcel" id="btnExcel" class="btnExel_G" value="Excel"   onclick="document.formaProductos.action= '../Code_Excel/ExcelUnidadConsumo.php'; document.formaProductos.submit();"/>-->
		
  		<div id="dashboard_div_Estatus_llantas">
        
        <div id="EstausTotalImporteLlantas">
		  <label>Importe Total de Llantas</label>
          <input name="edTotalConsumo" type="text" id="edTotalConsumo" align="right" readonly value="<?php echo '$'.number_format($TotalImporte, 2); ?>" />
        </div>
         <div id="EstausTotalCantidadLlantas">
		  <label>Cantidad Total de Llantas </label>
  			<input type="text" name="edTotalConsumo" id="edTotalConsumo" align="right" readonly  value="<?php echo $TotalCantidad; ?>"  />
         </div>
         <table>
              <tr style='vertical-align: top'>
              <td style='width: 400px; font-size: 0.9em;'>
              	<div id="control1_Estatus_llantas"></div>
                <br><br><br><br>
                <div id="control2_Estatus_llantas"></div>
                <br><br><br><br>
                <div  id="table_div_Estatus_llantas"></div> <!--style="float: left;"-->
              </td>
              <td style='width: auto'>
                <div style="float: left;" id="chart_div_Estatus_llantas"></div>
                
              </td>
           </tr>
           
          </table>
      
		</div>
    </form>
     
</div>

</body>
</html>