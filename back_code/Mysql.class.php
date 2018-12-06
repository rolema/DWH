<?php
function conectar()
{
	/*$server='db527766647.db.1and1.com';//aqui va el nombre del servidor.
	$user='dbo527766647';//nombre de usuario mysql del servidor. 
	$pass='1534267';//contraseña del usuario mysql. 
	$DB='db527766647';//nombre de la base de datos.*/
	$server='localhost';//aqui va el nombre del servidor.
	$user='root';//nombre de usuario mysql del servidor. 
	$pass='';//contraseña del usuario mysql. 
	$DB='AVE_DWH';//nombre de la base de datos.
if (!$conexion=mysql_connect($server,$user,$pass))
	{
		echo "Error al conectar a la base de datos ".mysql_error();
		exit();
	}
if (!@mysql_select_db($DB,$conexion)) 
   	{
     	echo "Error al seleccionar la base de datos ".mysql_error();
     	exit();
   	}
}
?>