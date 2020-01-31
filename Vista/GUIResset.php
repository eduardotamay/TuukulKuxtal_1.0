<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/Login2.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<?php 
	$id = $_GET['encod'];
?>
<body id="bd-body">
	<section class="login-block">
    <div class="container">
	<div class="row d-flex align-items-center">
		<div class="offset-md-3 col-md-6 login-sec">
		    <h3 title="Cambiar contraseña" class="text-center">K’ex jéets’ ta’akil ts’íib</h3>
		    <span title="Para verificar que es usted, ingrese los siguientes datos que se pide" class="text-white">
	        	<p class="text-center">U ti’al k-ilik waa teeche’, ts’íibtej le ba’ax ku k’áatalo’</p>
	      </span>
<form class="login-form" action="../Controlador/TRessetPass.php" method="post">
	<div class="form-group">
    	<input type="text" name='idUser' hidden="True" class="form-control" value="<?php echo $id;?>">
  	</div>
  <div title="Usuario" class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">K'aaba'</label>
    <input type="text" name='usuario' class="form-control" placeholder="K'aaba'" required="">
  </div>
  <div title="Fecha de nacimiento" class="form-group">
    <label for="exampleInputDate" class="text-uppercase">U k'iinil a síijil</label>
    <input type="date" name='fNacimiento' class="form-control" placeholder="U k'iinil uch a síijil" required="">
  </div>
  <div title="Nueva Contraseña" class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Tumben jéets’ ta’akil ts’íib</label>
    <input type="password" id='pw' name='newClave' class="form-control" placeholder="Tumben jéets’ ta’akil ts’íib" required="">
  </div>
  <div title="Confirme su Contraseña" class="form-group">
    <label for="exampleInputPassword2" class="text-uppercase">Jaajkuntej a jéets’ ta’akil ts’íib</label>
    <input type="password" id='pw' name='confClave' class="form-control" placeholder="Jaajkuntej a jéets’ ta’akil ts’íib" required="">
  </div>
    <button title="Enviar" name="OK2" value="Confirmar" type="submit" class="btn btn-login btn-md btn-lg float-right">Túuxt</button>
</form>
</div>
</div>
	<div class="row new-row">
		<div title="Regresar" class="col-12 col-md-4 bg-light"><p class="text-center text-black m-3"><a href="../GUILogin2.php" class="text-decoration-none">Suut</a></p></div>
		<div title="Registrarse" class="col-12 col-md-4 bg-light"><p class="text-center text-black m-3"><a href="GUIRegistrar.php" class="text-decoration-none">Ts'íibtabaj</a></p></div>
		<div title="Inicio" class="col-12 col-md-4 bg-light"><p class="text-center text-black m-3"><a href="GUIPublic.php" class="text-decoration-none">Chúumbal</a></p></div>
	</div>
</section>
</body>
</html>