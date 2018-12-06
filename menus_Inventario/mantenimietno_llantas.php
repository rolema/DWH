<?php 
	session_start();
	
	//version 5.4 trae false, version 5.2 trae verdadero por lo cual se invierte para v 5.4
	if(isset($_SESSION['login'])){
		echo "<SCRIPT LANGUAGE='javascript'> alert(";
		echo $_SESSION['login'];
		echo "); javascript:window.location='.../index.php'; </SCRIPT>";
	}
?>

<!DOCTYPE html>
<head>
<?php include ("../contenido/menu.php"); ?>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- javascripst -->
	<!--
    
	orden para poner las librerias de JS.
	1-jquery.min.js
	2-jquery-ui.js
	3-alguna api de terceros
	4-codigo midificado de JS.

	-->
    
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="../js/M_Llantas.js"></script>
<script src="../js/M_Llantas_totales.js"></script>

<!--CSS controla menu, titulos, boton y tabla-->
<link rel="stylesheet" type="text/css" href="../css/master.css">

<!--CSS calendario-->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />


<title>Estatus LLantas</title>
</head>


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
          <input name="edTotalImporteLantas" type="text" id="edTotalImporteLlantas" align="right"  readonly/>
        </div>
         <div id="EstausTotalCantidadLlantas">
		  <label>Cantidad Total de Llantas </label>
  			<input type="text" name="edTotalCantidadLlantas" id="edTotalCantidadLlantas" align="right" readonly/>
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