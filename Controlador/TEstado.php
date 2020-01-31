<?php
session_start();
if(isset($_POST["Eliminar"]) && $_POST["Eliminar"]=="Eliminar")
{
	//por ahora no esta dentro de una condición, para asegurarse que el codigo funcionara 
	$id=$_POST["id_producto"];
	require_once '../Modelo/Producto.php';
	$objPro = new Producto();
	$result = $objPro->inactivo($id);
//traer los datos del archivo en la direccion "link"
	if ($result!=""){
			echo "<script language='javascript'>alert('Archivo dado de baja');
		window.location='../Vista/GUIMisArchivos.php'</script>";
	}else{
	echo "<script language='javascript'>alert('ERROR:Archivo no se dio de baja');
		window.location='../Vista/GUIMisArchivos.php'</script>";	
	}
}
if(isset($_POST["Activar"]) && $_POST["Activar"]=="Activar")
{
	//por ahora no esta dentro de una condición, para asegurarse que el codigo funcionara 
	$id=$_POST["id_producto"];
	require_once '../Modelo/Producto.php';
	$objPro = new Producto();
	$result = $objPro->activo($id);
//traer los datos del archivo en la direccion "link"
	if ($result!=""){
			echo "<script language='javascript'>alert('Archivo se activó');
		window.location='../Vista/GUIMisArchivos.php'</script>";
	}else{
	echo "<script language='javascript'>alert('ERROR:Archivo no se activó');
		window.location='../Vista/GUIMisArchivos.php'</script>";	
	}
}
if(isset($_POST["Eliminar1"]) && $_POST["Eliminar1"]=="Eliminar1")
{
	$id=$_POST["id_producto"];
	$id_genero=$_POST["id_genero"];
	$genero=$_POST["genero"];
	require_once '../Modelo/Producto.php';
	$objPro = new Producto();
	$result = $objPro->inactivo($id);
//traer los datos del archivo en la direccion "link"
	if ($result!=""){
			echo "<script language='javascript'>alert('Archivo dado de baja');
		window.location='../Vista/GUILibro.php?id_genero=".$id_genero."&genero=".$genero."'</script>";
	}else{
	echo "<script language='javascript'>alert('ERROR:Archivo no se dio de baja');
		window.location='../Vista/GUILibro.php?id_genero=".$id_genero."&genero=".$genero."'</script>";	
	}
}
if(isset($_POST["Activar1"]) && $_POST["Activar1"]=="Activar1")
{
	$id=$_POST["id_producto"];
	$id_genero=$_POST["id_genero"];
	$genero=$_POST["genero"];
	require_once '../Modelo/Producto.php';
	$objPro = new Producto();
	$result = $objPro->activo($id);
//traer los datos del archivo en la direccion "link"
	if ($result!=""){
			echo "<script language='javascript'>alert('Archivo se activó');
		window.location='../Vista/GUILibro.php?id_genero=".$id_genero."&genero=".$genero."'</script>";
	}else{
	echo "<script language='javascript'>alert('ERROR:Archivo no se activó');
		window.location='../Vista/GUILibro.php?id_genero=".$id_genero."&genero=".$genero."'</script>";	
	}
}

//ADMIN publica y da de baja
if(isset($_POST["EliminarAdmin"]) && $_POST["EliminarAdmin"]=="EliminarAdmin")
{
	//por ahora no esta dentro de una condición, para asegurarse que el codigo funcionara 
	$id=$_POST["id_producto"];
	require_once '../Modelo/Producto.php';
	$objPro = new Producto();
	$result = $objPro->inactivo($id);
//traer los datos del archivo en la direccion "link"
	if ($result!=""){
			echo "<script language='javascript'>alert('Archivo dado de baja');
		window.location='../Vista/GUIGestionArchivos.php'</script>";
	}else{
	echo "<script language='javascript'>alert('ERROR:Archivo no se dio de baja');
		window.location='../Vista/GUIGestionArchivos.php'</script>";	
	}
}
if(isset($_POST["ActivarAdmin"]) && $_POST["ActivarAdmin"]=="ActivarAdmin")
{
	//por ahora no esta dentro de una condición, para asegurarse que el codigo funcionara 
	$id=$_POST["id_producto"];
	require_once '../Modelo/Producto.php';
	$objPro = new Producto();
	$result = $objPro->activo($id);
//traer los datos del archivo en la direccion "link"
	if ($result!=""){
			echo "<script language='javascript'>alert('Archivo se activó');
		window.location='../Vista/GUIGestionArchivos.php'</script>";
	}else{
	echo "<script language='javascript'>alert('ERROR:Archivo no se activó');
		window.location='../Vista/GUIGestionaArchivos.php'</script>";	
	}
}



/*
el MIME de un PDF es “application/pdf“, el de un ZIP es “application/zip“, el de una imagen JPG es “image/jpeg“, el de un MP3 es “audio/mpeg” y el de EXE es “application/octet-stream“.
--codigo para conocer la extencion de un archivo
//$info = new SplFileInfo($link);
//$ext=pathinfo($info->getFilename(), PATHINFO_EXTENSION);
//echo $ext;	
*/
?>
