<?php 
include("../Datos/Conexion.php");

if (isset($_POST["OK1"]) && $_POST["OK1"]=="RessetPass") {
	
	if(isset($_POST["email"]) & trim($_POST['email'])!="" ){
 		$email=$_POST["email"];
	}

	$objConex=new Conexion();
    $sql="SELECT * FROM usuario WHERE(correo_usuario='".$email."') LIMIT 1";
	$qry=$objConex->generarTransaccion($sql);
    if ($qry) {
		while ($row = mysqli_fetch_array($qry)) {
				$id = $row['id_usuario'];
				$correo = $row['correo_usuario'];
				$u = $row['nombre_usuario'];
			}
	}
	if ($correo == isset($email)) {
		echo "<script language='javascript'>alert('Email si existe');
					window.location='../Vista/GUIResset.php?encod=$id'</script>";
	}else{
		echo "<script language='javascript'>alert('Dato no existente');
					window.location='../GUILogin2.php'</script>";
	}
}

if (isset($_POST["OK2"]) && $_POST["OK2"]=="Confirmar") {

	//Se confirma de que la clave no esten vacías o que contengan espacios en blanco
	if (ltrim($_POST['newClave'])!='' AND ltrim($_POST['confClave'])!='' ) {
		
		if(isset($_POST["idUser"]) & $_POST['idUser']!="" ){
 			$idUser=$_POST["idUser"];
		}
		if(isset($_POST["usuario"]) & $_POST['usuario']!="" ){
 			$usuario=$_POST["usuario"];
		}
		if(isset($_POST["fNacimiento"]) & $_POST['fNacimiento']!="" ){
	 		$fNacimiento=$_POST["fNacimiento"];
		}
		if(isset($_POST["newClave"]) & ltrim($_POST['newClave'])!=""){
	 		$newClave=$_POST["newClave"];
		}
		if(isset($_POST["confClave"]) & ltrim($_POST['confClave'])!=""){
	 		$confClave=$_POST["confClave"];
		}

		if ($newClave == $confClave) { //Se verifica si las claves coinciden
			$objConex=new Conexion(); //Se prosigue para la selección de los datos del usuario con su ID
		    $sql="SELECT * FROM usuario WHERE(id_usuario='".$idUser."') LIMIT 1";
			$qry=$objConex->generarTransaccion($sql);
		    if ($qry) {
				while ($row = mysqli_fetch_array($qry)) {
						$id = $row['id_usuario'];
						$fNaci = $row['fecha_nacimiento'];
						$Unombre = $row['nombre_usuario'];
					}
			}
			if ($fNacimiento == $fNaci AND $Unombre == $usuario) {
				//Se crea el hass para encriptar el password
				$claveHash = password_hash($newClave,PASSWORD_DEFAULT);
				$objConex = new Conexion();
				$update = "UPDATE usuario SET password_usuario = '".$claveHash."' WHERE (id_usuario = '".$id."')";
				$qry = $objConex->generarTransaccion($update);
				echo "<script language='javascript'>alert('Listo, ha cambiado su contraseña');
					window.location='../Vista/GUIPublic.php'</script>";
			} else {
				echo "<script language='javascript'>alert('Los datos nos existen, verifica');
					window.location='../GUILogin2.php'</script>";
			}
		} else {
			echo "<script language='javascript'>alert('Las contraseñas no coinciden');
					window.location='../GUILogin2.php'</script>";
		}
	} else {
		echo "<script language='javascript'>alert('Contraseñas están vacías');
					window.location='../GUILogin2.php'</script>";;
	}
	
	// Se hace una consulta a la BD para verificar los datos correspondientes, si existen los datos, se convierte el pass en hash y se hace el update.

}


	
?>