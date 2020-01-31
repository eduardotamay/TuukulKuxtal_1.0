<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/Login2.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
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
<body id="bd-body">
	<section class="login-block">
    <div class="container">
    	<div class="row">
    		<div class="offset-md-4 col-md-4 banner-sec">
				<figure class="figure">
				  <img src="Imagenes/Tuukul-Kuxtal.png" class="figure-img img-fluid rounded"alt="Responsive image" width="300" height="300">
				</figure>   
			</div>
    	</div>
	<div class="row d-flex align-items-center">
		<div class="offset-md-3 col-md-6 login-sec">
		    <h3 title="Entrar ahora" class="text-center">Okol te súutuka'</h3>
<form class="login-form" action="GUILogin.php" method="post">
  <div title="Usuario" class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">K'aaba'</label>
    <input type="text" name='usuario' class="form-control" placeholder="K'aaba'" required="">
    
  </div>
  <div title="Contraseña" class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Jéets’ ta’akil ts’íib</label>
    <input type="password" id='pw' name='clave' class="form-control" placeholder="Jéets’ ta’akil ts’íib" required="">
  </div>
    <div class="form-check">
    <label title="Recordarme" class="form-check-label">
      <input type="checkbox" class="form-check-input">
      <small class="remember-me">K'a'asten</small>
    </label>
  </div>
    <button name="OK" title="Entrar" value="Enlace" type="submit" class="btn btn-login btn-md btn-lg float-right">Okol</button>
</form>
</div>
</div>
	<div class="row new-row">
		<div class="col-12 col-md-4 bg-light" title="Regresar" ><p class="text-center text-black m-3"><a href="Vista/GUIPublic.php" class="text-decoration-none">Suut</a></p></div>
		<div class="col-12 col-md-4 bg-light" title="Registrarse"><p class="text-center text-black m-3"><a href="Vista/GUIRegistrar.php" class="text-decoration-none">Tsíibtabaj</a></p></div>
		<div class="col-12 col-md-4 bg-light" title="¿Olvidó su contraseña?" ><p class="text-center text-black m-3"><a href="" class="text-decoration-none" id="olvidado">Tu’ub waa a jéets’ ta’akil ts’íib</a></p></div>
	</div>
<div class="row">
	<div class="col-12 col-md-6 ml-auto">
		<div style="display: none;" id="form-olvidado">
	    <form accept-charset="UTF-8" role="form" action="Controlador/TRessetPass.php" id="login-recordar" method="post">
	      <fieldset class="pt-2">
	        <span title='Ingresa su email
	          y siga las siguientes instrucciones para cambiar su contraseña' class="help-block text-white">
					Ts’íibtej a correo 
					yéetel chuckbest le ba’ax ku k’áata’alo ti’al a k’exik a jéets’ ta’akil ts’íib
	        </span>
	        <div class="form-group input-group">
	          	<div class="input-group-prepend">
	          		<div class="input-group-text">@</div>
	        	</div>
	          <input class="form-control" placeholder="Correo" name="email" type="email" required="">
	        </div>
	        <button name="OK1" value="RessetPass" type="submit" class="btn btn-primary btn-block" id="btn-olvidado">
	          Continuar
	        </button>
	        <p class="pt-2 text-right">
	          <a style="text-decoration: none;color: white; font: 15px;" href="#" id="acceso"><small>Cerrar</small></a>
	        </p>
	      </fieldset>
	    </form>
	</div>
	</div>
</div>
</section>
</body>
<script type="text/javascript">
	$(document).ready(function() {
  $('#olvidado').click(function(e) {
    e.preventDefault();
    $('div#form-olvidado').toggle('500');
  });
  $('#acceso').click(function(e) {
    e.preventDefault();
    $('div#form-olvidado').toggle('500');
  });
});
</script>
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