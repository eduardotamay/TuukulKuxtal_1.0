<?php
require_once("../Modelo/Producto.php");
session_start();
if(isset($_POST["Modificar"]) && $_POST["Modificar"]=="Guardar Cambios")
{
	//reviso que se mandaran todos los valores necesarios para crear el objeto de la clase Producto.php
	if(isset($_POST["id_producto"]))
	{
		$id_producto=$_POST["id_producto"];
	}else{
		$id_producto="";
	}
	if(isset($_POST["fechapublicacion_producto "]))
	{
	$fechapublicacion_producto =$_POST["fechapublicacion_producto "];}
	else{
		$fechapublicacion_producto ="";
	}
	if(isset($_POST["tipo_producto"]))
	{
		$tipo_producto=$_POST["tipo_producto"];
	}else{
		$tipo_producto=0;
	}
	
	if(isset($_POST["titulo_producto"]))
	{
		$titulo_producto=$_POST["titulo_producto"];
	}else{
		$titulo_producto="";
	}
	if(isset($_POST["autor_producto"]))
	{
		$autor_producto=$_POST['autor_producto'];
		$nombre=preg_replace('[\s+]','', $autor_producto);
		//echo $nombre;
		if(isset($_POST["i".$nombre])){
			$idautor=$_POST['i'.$nombre];
		}else{
			$idautor=-1;
		}
		//echo $idautor;
	}
	if(isset($_POST["descripcion_producto"]))
	{
		$descripcion_producto=$_POST["descripcion_producto"];}
	else{
		$descripcion_producto="";
	}
	if(isset($_POST["fechacreacio_producto"]))
	{
	$fechacreacio_producto=$_POST["fechacreacio_producto"];}
	else{
		$fechacreacio_producto="";
	}
	if(isset($_POST["fechapublicacion_producto"]))
	{
	$fechapublicacion_producto=$_POST["fechapublicacion_producto"];}
	else{
		$fechapublicacion_producto="";
	}
	if(isset($_POST["comunidad_producto"]))
	{
		$comunidad_producto=$_POST['comunidad_producto'];
		$nombre_comu=preg_replace('[\s+]','', $comunidad_producto);
		//echo $nombre;
		if(isset($_POST["i".$nombre_comu])){
			$idcomu=$_POST['i'.$nombre_comu];
		}else{
			$idcomu=-1;
		}
		//echo $idcomu;
	}
	if(isset($_POST["genero_producto"]))
	{
		$genero_producto=$_POST["genero_producto"];}
	else{
		$genero_producto="";
	}
	if(isset($_POST["tipo_subida"]))
	{
		$tipo_subida=$_POST["tipo_subida"];}
	else{
		$tipo_subida="";
	}
	//echo "<br>";
	//echo $_POST['idioma_id_idioma'];
	if(isset($_POST["idioma_id_idioma"]))
	{
		$idioma_id_idioma=$_POST["idioma_id_idioma"];}
	else{
		$idioma_id_idioma="";
	}
	/*if(isset($_POST["calificacio_producto"]))
	{
		$calificacio_producto=$_POST["calificacio_producto"];}
	else{
		$calificacio_producto="";
	}*/
	if(isset($_POST["link"]))
	{
		$link=$_POST["link"];}
	else{
		$link="";
	}
	if(isset($_POST["estado"]))
	{
		$estado=$_POST["estado"];}
	else{
		$estado="";
	}
	$objProd=new Producto();
	if(preg_replace('[\s+]','_', $autor_producto)!="" && $idautor==-1){
		$objProd->nuevoAutor($autor_producto);
		$idautor = $objProd->buscarAutor($autor_producto);
		$idautor = mysqli_fetch_array($idautor);
		$idautor = $idautor[0];
	}
	$objProd=new Producto();
	if(preg_replace('[\s+]','_', $comunidad_producto)!="" && $idcomu==-1){
		$objProd->nuevaComunidad($comunidad_producto);
		$idcomu = $objProd->buscarComunidad($comunidad_producto);
		$idcomu = mysqli_fetch_array($idcomu);
		$idcomu = $idcomu[0];
	}
	$usuario_id_usuario=$_SESSION['id_usuario'];					
	$objProd->Producto(
		$id_producto,
		$titulo_producto,
		$descripcion_producto,
		$fechacreacio_producto,
		$fechapublicacion_producto,
		$genero_producto,
		$tipo_subida,
		$estado,
		$usuario_id_usuario,
		$idcomu,
		$idioma_id_idioma,
		$tipo_producto,
		$idautor,
		$link
	);
	
	/*echo 	 "</br>getId_producto: ".$objProd->getId_producto();
	echo     "</br>getTitulo_producto: ".$objProd->getTitulo_producto();
	echo     "</br>getDescripcion_producto: ".$objProd->getDescripcion_producto();
	echo     "</br>getFechacreacio_producto: ".$objProd->getFechacreacio_producto();
	echo     "</br>getFechapublicacion_producto: ".$objProd->getFechapublicacion_producto();
	echo     "</br>getGenero_producto: ".$objProd->getGenero_producto();
	//echo     "</br>getCalificacio_producto: ".$objProd->getCalificacio_producto();
	echo     "</br>getEstado: ".$objProd->getEstado();
	echo     "</br>getUsuario_id_usuario: ".$objProd->getUsuario_id_usuario();
	echo  	 "</br>getComunidad_producto: ".$objProd->getComunidad_producto();
	echo     "</br>getIdioma_id_idioma: ".$objProd->getIdioma_id_idioma();
	echo     "</br>getTipo_producto: ".$objProd->getTipo_producto();
	echo     "</br>getAutor_producto: ".$objProd->getAutor_producto();
	echo     "</br>getLink: ".$objProd->getLink();
	*/
	$resul=$objProd->modificarProducto();
	//$resul=$objProd->modificarProducto();
		//compruebo si la fila se subio a la base de datos y envio el mensaje correspondiente
	if ($resul!=""){
		if($tipo_producto==1 || $tipo_producto==2){
		echo "<script language='javascript'>alert('BIEN:DATOS GUARDADOS');
			window.location='../Vista/GUIDetalleMultimedia.php?id_producto=".$id_producto."&tipo=".$_POST["tipo"]."'</script>";
		}else{
			echo "<script language='javascript'>alert('BIEN:DATOS GUARDADOS');
			window.location='../Vista/GUIDetalleLibro.php?id_producto=".$id_producto."'</script>";
		}
	}
	else {
		if($tipo_producto==1 || $tipo_producto==2){
		echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO GUARDADOS');
		window.location='../Vista/GUIDetalleMultimedia.php?id_producto=".$id_producto."&tipo=".$_POST["tipo"]."'</script>";
		}else
		{
			echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO GUARDADOS');
		window.location='../Vista/GUIDetalleLibro.php?id_producto=".$id_producto."'</script>";
		}
	}
}


?>