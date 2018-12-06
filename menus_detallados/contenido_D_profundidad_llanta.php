<!DOCTYPE html>
<head>
<?php include ("../contenido/menu.php"); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--JQuery-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

<!--JS de acciones de Boton-->
<script type="text/javascript" src="../js/combo.js"></script>
<script src="../js/menu_jquery.js"></script>

<!--CSS controla menu, titulos, boton y tabla-->
<link rel="stylesheet" type="text/css" href="../css/master.css">


<?php 
	session_start();
	
	//version 5.4 trae false, version 5.2 trae verdadero por lo cual se invierte para v 5.4
	if(isset($_SESSION['login'])){
		echo "<SCRIPT LANGUAGE='javascript'> alert(";
		echo $_SESSION['login'];
		echo "); javascript:window.location='.../index.php'; </SCRIPT>";
	}
?>
<title>Profundidad de Llantas</title>
</head>

<body>
<div class="principal">
	   <form class="menu1" id="menu_1" name="form1"  action="javascript:MostrarDatos();">
		
        <div id="espacio">
			<h1 class="espacio">
				<p><span>P</span>rofundidad de Llantas</p>
            </h1>
		</div>

		<div class="menu1" id="caja_menu_select_1" >
  			<div id="tipo_unidad_s"><!--combos de seleccion de tipos de unidades-->
				<label>Tipo de Unidad</label>
    			<select  name="TipoUnidad" id="TipoUnidad"  >
            		<option value="0">Seleccione Tipo de Unidad...</option>
               		<option value="1">Carro</option>
           			<option value="2">Remolque</option>
           			<option value="3">Dolly</option>
        		</select>
          
			</div>
  
			<div id="unidades_s_D_1"><!--combos de seleccion de unidades-->
	    		<label>Unidades</label>
    			<select  name="Unidad" id="Unidad"   >
            		<option value="0">Seleccione Unidad...</option>
      			</select>
     		</div>  
    	</div>
 
		<input  name="Consultar" type="button"  class="consular_p_G" id="ConsultarProfLlantas" value="Consultar"  />
    	<!--<input type="submit" name="btnExcel" id="btnExcel" class="btnExel_G" value="Excel"  onclick="document.form1.action='../Code_Excel/ExcelDatosOTLlantaPROF.php'; document.form1.submit();"/> -->
        <input type="reset" name="limpia" id="limpia" class="limpia_G" value="Restablecer" />
        
        <div id="tabla_D" class="CSSTableGenerator"> 
			<table  border="1" id="tbConsulta" name="tbConsulta">
				<tbody>
					<tr>
                    	<td>Folio</td>
                        <td>Serie</td>
						<td>Tipo</td>
                        <td>Unidad</td>
                        <td>Posicion</td>
                        <td>Folio Inventario</td>
                        <td>Marca</td>
                        <td>Medida</td>
                        <td>Matricula</td>
                        <td>Profundidad</td>
                        <td>Fecha</td>
              		</tr>
            	</tbody>
			</table>
		</div>
	</form>
</div>

</body>
</html>