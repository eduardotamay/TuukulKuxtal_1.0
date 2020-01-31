<?php
require_once("../Modelo/Producto.php");

$busqueda = $_POST['palabraClave'];

if ($busqueda=='') {
	echo "<script language='javascript'>alert('Buscador vacío');
            window.location='../Vista/GUIPublic.php'</script>";
}
if ($busqueda!=''){
	   //CUENTA EL NUMERO DE PALABRAS 
	   	$trozos=explode($busqueda);
	   	$numero=count($trozos); 
	   	$busqueda = $_POST['palabraClave'];
		$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
		$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
		$busqueda = str_replace($caracteres_malos, $caracteres_buenos, $busqueda);
	   header("Location:../Vista/GUIPublic.php?where=".$busqueda."");
}
 ?>