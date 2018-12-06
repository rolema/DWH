<?php 
	session_start();
	
	//version 5.4 trae false, version 5.2 trae verdadero por lo cual se invierte para v 5.4
	if(isset($_SESSION['login'])){
		echo "<SCRIPT LANGUAGE='javascript'> alert(";
		echo $_SESSION['login'];
		echo "); javascript:window.location='.../index.php'; </SCRIPT>";
	}
?>
<!DOCTYPE html><head>
<?php include ("../contenido/menu.php"); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--CSS calendario-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--JS de acciones de Boton-->
<script type="text/javascript" src="../js/combo.js"></script>
<script src="../js/menu_jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>


<script>
  $(function() {
    $( "#dtDe" ).datepicker();
	 $( "#dtA" ).datepicker();
  });
</script>

<!--CSS controla menu, titulos, boton y tabla-->
<link rel="stylesheet" type="text/css" href="../css/master.css">

<script type="text/javascript">
	google.load("visualization", '1.0', {'packages':['controls']});
    google.load("visualization", "1", {packages: ["corechart"]});
</script>

<title>Consumo de Llantas por Estatus</title>
</head>


<body>
<div class="principal">
	

	<form class="menu1" id="menu_1" name="form1"  action="javascript:MostrarDatos();">
		<div id="espacio">
			<h1 class="espacio">
				<p><span>C</span>onsumo de Llantas por Estatus</h1></p>
		</div>


		<div class="menu1" id="caja_menu_select_1">
			<div class="fechas" id="fechas">
      		
            	<div id="fecha1">
        			<label>De</label>
        			<input type="text" name="dtDe" id="dtDe" step="1" min="2013-01-01" placeholder="mm/dd/aaaa" required>
     			</div>
      
     		 	<div id="fecha2">
        			<label>A</label>
        			<input type="text" name="dtA" id="dtA" step="1" min="2013-01-01" placeholder="mm/dd/aaaa">
      			</div>
			</div>
		</div>
 
      <input  name="Consultar" type="button"  class="consultar_LL_E" id="ConsultarLlantaEstatusConsumo" value="Consultar" /><!-- onclick="drawChart()" /> -->
      
    	<!--<input type="submit" name="btnExcel" id="btnExcel" class="btnExel_G" value="Excel"  onclick="document.form1.action= '../Code_Excel/ExcelLlantaEstatusConsumo.php'; document.form1.submit();"/>-->
        
        <input type="reset" name="limpia" id="limpia_G" class="limpia_LL" value="Restablecer" />
    
 		<div id="rb3_G_M_M">
  			<label>Total</label>
  			<input type="text" name="edTotalEstatusLlanta" id="edTotalEstatusLlanta" align="center" readonly/>
  		</div>

		
	  <div id="dashboard2_div">
          <table>
            <tr style='vertical-align: top'>
              <td style='width: 400px; font-size: 0.9em;'>
                <div  id="table_div"></div> <!--style="float: left;"-->
                <br><br><br><br>
                <div id="control1"></div>
                <br><br><br><br>
                <div id="control2"></div>
              </td>
              <td style='width: 700px'>
                <div style="float: left;" id="chart_div"></div>
              </td>
            </tr>
          </table>
      
		</div>
	</form>
</div>

</body>
</html>