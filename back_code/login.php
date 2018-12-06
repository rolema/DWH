<?php
	/* Llamar a Cadena de Conexion*/ 
	include ("Mysql.class.php");
	conectar();

	if($_POST && !empty($_POST['USR']) &&  !empty($_POST['PASS'])) 
	{
		//quitamos el posible SQLInjection del usuario
		$usuario = mysql_real_escape_string($_POST['USR']);  
		//sacamos el hash del password para que se compare ya encriptado
		$password = md5(mysql_real_escape_string($_POST['PASS']));
		//vemos si existen registros que coincidan
		$query = mysql_query("SELECT ID_USUARIO FROM ave_c_usuario WHERE USUARIO  = '$usuario' AND PASSWORD = '$password'");
		
	
		if(mysql_num_rows($query) == 1) 
   	 	{
			$resultado = mysql_fetch_row($query);
			$IdUsuario = $resultado[0];
			
			mysql_query('update ave_t_session set ACTIVO = 0 where ID_USUARIO = '.$resultado[0]);
			
  		 	session_start(); 
           	$_SESSION['login'] = $usuario;
			$_SESSION['idUsuario'] = $IdUsuario;
			
			$query2 = 'insert into ave_t_session(ID_USUARIO, HR_ENTRADA,  ACTIVO) Values('.$IdUsuario.', CURRENT_TIMESTAMP, 1)';	
			mysql_query($query2);
						
				
			
			echo"<SCRIPT LANGUAGE='javascript'> alert('Bienvenido ";
			echo $_SESSION['login'];
			echo "'); location='../contenido/contenido.php';
				
				</SCRIPT>";
			
			
			
			//header("Location: ../contenido/contenido.php");
			//header("Location: ".base64_encode('../contenido/contenido.php'));
			die();
           	exit;
     	} 
		else {
   			session_start();
			unset($_SESSION['login']);
			session_destroy();
			
			echo"<SCRIPT LANGUAGE='javascript'>
			alert('Verifique Usuario y contraseÃ±a.');
				location='../index.php';
				</SCRIPT>";
       		//header("Location: ../index.php");  
     	}
	}
?>
