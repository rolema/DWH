<!DOCTYPE html>
<head>
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
<title>Ordenes de Trabajo Productos</title>
</head>

<body>

<div class="principal">

	<form class="menu1" id="menu_1" name="form1"  action="javascript:MostrarDatos();">
        <div id="espacio">
            <h1 class="espacio">
            <p> <span>O</span>rdenes de Trabajo Productos</h1> </p>
        </div>
        
        <div class="menu1" id="caja_menu_select_1" >
           
           <div class="fechas" id="fechas">
                <div id="fecha1">
                    <label>De</label>
                    <input type="text" name="dtDe" id="dtDe" step="1" min="2013/01/01" placeholder="mm/dd/aaaa">
                </div>
                <div id="fecha2">
                    <label>A</label>
                    <input type="text" name="dtA" id="dtA" step="1" min="2013/01/01" placeholder="mm/dd/aaaa">
                </div>
            </div>
    
            <div id="tipo_unidad_s"><!--combos de seleccion de tipos de unidades-->
                <label>Tipo de Unidad</label>
             	<select  name="TipoUnidad" id="TipoUnidad"  >
                	<option value="0">Seleccione Tipo de Unidad...</option>         
                    <option value="1">Carro</option>
                    <option value="2">Remolque</option>
                    <option value="3">Dolly</option>
           		</select>
            </div>
       
            <div id="propiedad_s"><!--combos de seleccion de propiedad de las unidades unicamente para carros-->
                <label>Propiedad</label>
                <select  name="Propiedad" id="Propiedad" >
                	<option value="0">Seleccione Propiedad...</option>
                    <option value="1">Casa</option>
                    <option value="2">Permisonario</option>
                </select>
            </div>
       
       
            <div id="unidades_s"><!--combos de seleccion de unidades-->
            	<label>Unidades</label>
                <select  name="Unidad" id="Unidad"   >
                	<option value="0">Seleccione Unidad...</option>
            	</select>
            </div>  
            
        </div>
       
        <input  name="Consultar" type="button"  class="consular_p_D_A" id="ConsultarProducto" value="Consultar"  />
        <!--<input type="submit" name="btnExcel" id="btnExcel" class="btnExcel" value="Excel"  onclick="document.form1.action='../Code_Excel/ExcelDatosOTProductos.php'; document.form1.submit();"/> -->
        <input type="reset" name="limpia" id="limpia" class="limpia" value="Restablecer" />
     
        
        <div id="rb3_D_A">
            <label>Total</label>
            <input type="text" name="edTotal" id="edTotal" align="right" readonly/>
        </div>
    
        <div id="tabla" class="CSSTableGenerator"> 
            <table  border="1" id="tbConsulta" name="tbConsulta">
                <tbody>
                    <tr>
                        <td>Orden Trabajo</td>
                        <td>Folio</td>
                        <td>Fecha</td>
                        <td>Operador</td>
                        <td>Tipo</td>
                        <td>Economico</td>
                        <td>Cantidad</td>
                        <td>Unidad</td>
                        <td>Producto</td>
                        <td>Costo</td>
                        <td>Importe</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>

</body>
</html>