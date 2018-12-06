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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--CSS controla menu, titulos, boton y tabla-->
<link rel="stylesheet" type="text/css" href="../css/master.css">
<!--JS de acciones de Boton-->
<script type="text/javascript" src="../js/combo.js"></script>
<title>Todos los Registros</title>
</head>

<body>
<div id="tabla_P" class="CSSTableGenerator"> 
			<table  border="1" id="tbConsultaCompraProveedor" name="tbConsultaCompraProveedor">
				<tbody>
					<tr>
						<td width="8%%">Tipo de Compra</td>
                        <td width="8%%">Proveedor</td>
                        <td width="8%">Importe</td>
                    </tr>
            	</tbody>
			</table>
		</div>
</body>
</html>
