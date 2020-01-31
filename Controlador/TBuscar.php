<?php
require_once("../Modelo/Usuario.php");
session_start();

if(isset($_POST["xusuario"]))
{$xusuario=$_POST["xusuario"];}else{$xusuario="";}

if(isset($_POST["xnombre"]))
{$xnombre=$_POST["xnombre"];}else{$xnombre="";}

if(isset($_POST["xperfil"]))
{$xperfil=$_POST["xperfil"];}else{$xperfil="";}

if(isset($_POST["xfecha"]))
{$xfecha=$_POST["xfecha"];}else{$xfecha="";}

if(isset($_POST["OK"]) && $_POST["OK"]=="Buscar")
{ 
	$w="";
	if(empty($_POST["xusuario"]) && empty($_POST["xnombre"]) && empty($_POST["xperfil"]))
 	{
		$w="";
 	}
	else if(empty($_POST["xnombre"]) && empty($_POST["xperfil"]) )
	{
		$w ="and usuario like '".$xusuario."%'";
	}
	else if(empty($_POST["xusuario"]) && empty($_POST["xperfil"]))
	{
		$w="and nombre_usuario like '".$xnombre."%'";
	}
	else if(empty($_POST["xusuario"]) && empty($_POST["xnombre"]))
	{
		$w ="and perfil = '".$xperfil."'";
	}
	else if(empty($_POST["xperfil"]))
	{
		$w ="and usuario like '".$xusuario."%' and nombre_usuario like '".$xnombre."%'";
	}
	else if(empty($_POST["xnombre"]))
	{
		$w ="and usuario like '".$xusuario."%' and perfil = '".$xperfil."'";
	}
	else if(empty($_POST["xusuario"]))
	{
		$w ="and nombre_usuario like '".$xnombre."%' and perfil = '".$xperfil."'";
	}
	else 
	{
		$w ="and nombre_usuario like '".$xnombre."%' and usuario like '".$xusuario."%' and perfil = '".$xperfil."'";
	}
	
	header("Location:../Vista/GUINuevoUsuario.php?where=".$w."");
}
?>

