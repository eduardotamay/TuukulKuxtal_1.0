<!DOCTYPE html>
<link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/normalize.css" rel="stylesheet">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="css/estilobody.css">
<link href="https://fonts.googleapis.com/css?family=Niramit" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../Bootstrap/fonts/glyphicons-halflings-regular.svg">
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php 
session_start();

error_reporting(E_ALL ^ E_DEPRECATED); 

if (isset($_SESSION['nombre_usuario'])) //Si se cumple se ejecuta se abre Inicio
	{
		header("Location:Vista/GUIPublic.php");
	}  
else 
	{ 
?>
<body id="main-body">
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  	<form action="GUILogin.php" method="post">
		<div class='login'>
		 <div>
		 	<img style="width: 50%; height: 50%; position: relative; margin-left: 24%;" src="Imagenes/Tuukul-Kuxtal.png">
		</div>
		<h2 class="ini-sesion">Iniciar sesión</h2><br>
		<input class="pt" name='usuario' placeholder='Usuario' type='text' required=""/>
		<input class="pt" id='pw' name='clave' placeholder='Contraseña' type='password' required=""/>
		<div class='remember'>
		</div>
		<div style="" class="g-recaptcha" data-sitekey="6LdxxooUAAAAAFK7Pia501RgcEKfoUqyzPAzEE4c"></div>
		<button class="button" name="OK" value="Enlace" type="submit" class="js-toggle-login login--login-submit">
					Entrar
		</button>
		  <a class='forgot' href='Vista/GUIPublic.php'>Regresar</a>
		</div>
	</form>
	<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>
</html>
<?php

//require_once("TLogin.php");
if(isset($_POST["OK"]) && $_POST["OK"]=="Enlace"){ 
  $usuario="";//Limpiar para evitar que usuario ingrese sin id y clave
  $clave="";
	if(isset($_POST["usuario"]) & $_POST["usuario"]!="" ){ 

		$usuario=$_POST["usuario"];
	}

	if(isset($_POST["clave"]) & $_POST["clave"]!="" ){ 

		  	$clave=$_POST["clave"];
	}

	if($usuario!="" && $clave!=""){
					
					include("TLogin.php");
				}

	}

}

?>