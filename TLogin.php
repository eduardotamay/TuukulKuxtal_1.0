<?php

if(isset($_POST["usuario"]) & $_POST["usuario"]!="" ){
 	$usuario=$_POST["usuario"];
}
if(isset($_POST["clave"]) & $_POST["clave"]!="" ){ 
	$clave=$_POST["clave"];
}

if(isset($_POST["OK"]) && $_POST["OK"]=="Enlace"){  //Se hace la evaluaci�n
	$val=0;
    $val=evaluarUsuario($usuario,$clave);
    if ($val==1) {
		$_SESSION['nombre_usuario']=$usuario;
		header("Location:Vista/GUIPublic.php");
	}
	else{
		header("Location:GUILogin2.php");
	}
}
  function evaluarUsuario($usuario,$clave){
  	session_start();
   	include("Datos/Conexion.php");
    $objConex=new Conexion();
    $objConex->abrirConexion();
    $activated = 1;
    $sql="SELECT * FROM usuario WHERE(nombre_usuario='".$usuario."')";
	$datos=$objConex->generarTransaccion($sql);
    $reg=mysqli_fetch_row($datos);
    //Hacer la desencriptaci�n
    $pass = password_verify($clave,$reg[3]); //Hay que descifrar el password para hacer la comparaci�n
	if($reg[1]==$usuario && $reg[9]==$activated && $pass==$reg[3]) {
		$id_usuario=$reg[0];
		$perfil=$reg[2]; 
		$nombre=$reg[1];
		$correo_usuario=$reg[4];
		$paterno_usuario=$reg[5];
		$materno_usuario=$reg[6];
		$clave = $reg[3];
		$ocupacion=$reg[8];
		$imagen=$reg[7];
		$admin = $reg[9];
		$_SESSION['id_usuario']=$id_usuario;
		$_SESSION['nombre_usuario']=$nombre;
		$_SESSION['perfil']=$perfil;
		$_SESSION['correo_usuario']=$correo_usuario;
		$_SESSION['paterno_usuario']=$paterno_usuario;
		$_SESSION['materno_usuario']=$materno_usuario;
		$_SESSION['password_usuario']=$clave;
		$_SESSION['ocupacion_id_ocupacion']=$ocupacion;
		$_SESSION['imagen_usuario']=$imagen;
		$_SESSION['admin']=$admin;
		/*$_SESSION['carrito']=array();
		$_SESSION['where']="";
		$_SESSION['wherev']="";
		$_SESSION['wherep']="";
		$_SESSION['idvd']="";
		$_SESSION['xtotal']=0;*/
		
		return 1;
	}else {
		return 0;  
		echo  '<script language="javascript">alert("Usuario o contrase�a incorrecta");
                window.location="GUILogin2.php"</script>';
	}
}
?>