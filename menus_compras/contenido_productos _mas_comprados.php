<!DOCTYPE html>
<head>
<?php 
	session_start();
	
	//version 5.4 trae false, version 5.2 trae verdadero por lo cual se invierte para v 5.4
	if(isset($_SESSION['login'])){
		echo "<SCRIPT LANGUAGE='javascript'> alert(";
		echo $_SESSION['login'];
		echo "); javascript:window.location='.../index.php'; </SCRIPT>";
	}
?>
<?php include ("../contenido/menu.php"); ?>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--CSS calendario-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#dtDe" ).datepicker();
	 $( "#dtA" ).datepicker();
  });
</script>

<!--JS de acciones de Boton-->
<script type="text/javascript" src="../js/accionesCompras.js"></script>
<script type="text/javascript" src="../js/char.js"></script>
<script src="../js/menu_jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", '1.0', {'packages':['controls']});
   	google.load("visualization", "1", {'packages': ["corechart"]});
</script>

<!--CSS controla menu, titulos, boton y tabla-->
<link rel="stylesheet" type="text/css" href="../css/master.css">


<title>Compras de Productos</title>
</head>

<body>
<div class="principal">
	
	<form class="menu1" id="menu_1" name="formaProductos" action="javascript:MostrarDatos();" method="post">
		<div id="espacio">
			<h1 class="espacio">
				<p><span>C</span>ompras de Productos</h1></p>
		</div>

		<div class="menu1" id="caja_menu_select_2" >
   	
			<div class="fechas1" id="fechas">
      		
            	<div id="fecha1">
        			<label>De</label>
        			<input type="text" name="dtDe" id="dtDe" step="1" min="2013-01-01" placeholder="mm/dd/aaaa">
     			</div>
     		 	<div id="fecha2">
        			<label>A</label>
        			<input type="text" name="dtA" id="dtA" step="1" min="2013-01-01" placeholder="mm/dd/aaaa">
      			</div>
    
    		</div>
		</div>

		<input  name="Consultar" type="button"  class="consular_p_G_C" id="ConsultarCompraMayProductos" value="Consultar" />
        <input  name="ConsultarTodo" type="button"  class="btnExcel_C" id="ConsultarProductosMayTodo" value="Consultar Todo" />
    	
        <input type="reset" name="limpia" id="limpia_G" class="limpia_G_C" value="Restablecer" />
 		
        <div id="topp_C">
        	<label >Ordenar por:</label>
        	<select id="TipoOrden">
  				<option value="1">Importe</option>
  				<option value="2">Cantidad</option>
  			</select>
        </div>
        
        <div id="top_cosulta_C">
        	<label >Tipo Consulta</label>
        	<select id="TipoConsulta">
  				<option value="0">Top 10</option>
  				<option value="1">Top 20</option>
  				<option value="2">Maximo 250 Productos</option>
  			</select>
        </div>
        
		<div id="rb3_Compra">
  			<label>Total</label>
  			<input type="text" name="edTotalCompra" id="edTotalCompra" align="right" readonly/>
  		</div>

		 <div id="dashboard1_div">
         
          <table id="tbConsulta" name="tbConsulta" class="ConsultarComprasTodosProveedores">
          		<tbody id="tbl">
            	</tbody>
          </table>
          
          <table>
              <tr style='vertical-align: top'>
              <td style='width: 400px; font-size: 0.9em;'>
              	<div id="control1"></div>
                <br><br><br><br>
                <div id="control2"></div>
                <br><br><br><br>
                <div  id="table_div"></div> <!--style="float: left;"-->
              </td>
              <td style='width: auto'>
                <div style="float: left;" id="chart_div"></div>
                
              </td>
            </tr>
           
          </table>
      
		</div>
	</form>
</div>

</body>
</html>