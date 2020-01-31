<?php 
	require_once("../Datos/Conexion.php");

	
	//Si se cumple la condición se envía un mensaje a un profesor para más información de la plataforma

	if(isset($_POST['correo']) && $_POST['correo_profe']) {
	
	$email_from = $_POST['correo'];
	// Poner el correo donde se enviará el mensaje
	$para = "jose.tamay@uimqroo.edu.mx";
	$desde_donde = "Contacto desde la plataforma de lengua maya";

	// Validar los datos ingresados por el usuario
	if(!isset($_POST['nombre']) ||
	!isset($_POST['correo']) ||
	!isset($_POST['asunto']) ||
	!isset($_POST['mensaje'])){

	echo "<b>Ocurrió un error y el correo no ha sido enviado. </b><br />";
	echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
	die();
	}

	$detalle_mensaje = "Detalles del formulario de contacto:\n\n";
	$detalle_mensaje .= "Nombre: " . $_POST['nombre'] . "\n";
	$detalle_mensaje .= "Correo: " . $_POST['correo'] . "\n";
	$detalle_mensaje .= "Asunto: " . $_POST['asunto'] . "\n";
	$detalle_mensaje .= "Mensaje: " . $_POST['mensaje'] . "\n";

	// Ahora se envía el e-mail usando la función mail() de PHP
	$cabecera = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	@mail($para, $desde_donde, $detalle_mensaje, $cabecera);

	echo "<script language='javascript'>alert('Correo enviado con éxito! Espere información sobre los contenidos y servicios de la plataforma');
                window.location='../Vista/GUIContacto.php'</script>";
	}

	//Si se cumple la condición se envía un mensaje al admin para problemas técnicos

	if(isset($_POST['correo']) && $_POST['correo_admin']) {
	
	$email_from = $_POST['correo'];
	// Poner el correo donde se enviará el mensaje
	$para = "jose.tamay@uimqroo.edu.mx";
	$desde_donde = "Contacto desde la plataforma de lengua maya";

	// Validar los datos ingresados por el usuario
	if(!isset($_POST['nombre']) ||
	!isset($_POST['correo']) ||
	!isset($_POST['asunto']) ||
	!isset($_POST['mensaje'])){

	echo "<b>Ocurrió un error y el correo no ha sido enviado. </b><br />";
	echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
	die();
	}

	$detalle_mensaje = "Detalles del formulario de contacto:\n\n";
	$detalle_mensaje .= "Nombre: " . $_POST['nombre'] . "\n";
	$detalle_mensaje .= "Correo: " . $_POST['correo'] . "\n";
	$detalle_mensaje .= "Asunto: " . $_POST['asunto'] . "\n";
	$detalle_mensaje .= "Mensaje: " . $_POST['mensaje'] . "\n";

	// Ahora se envía el e-mail usando la función mail() de PHP
	$cabecera = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();

	@mail($para, $desde_donde, $detalle_mensaje, $cabecera);

	echo "<script language='javascript'>alert('Correo enviado con éxito! Espere asistencia técnica');
                window.location='../Vista/GUIContacto.php'</script>";
	}

 ?>