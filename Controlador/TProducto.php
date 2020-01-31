<?php
require_once("../Modelo/Producto.php");
session_start();
//aqui compruebo si se mando desde GUICarga el boton de nombre "cargar" y si el valor de este es igual a "Subir Archivo"
if(isset($_POST["cargar"]) && $_POST["cargar"]=="Subir Archivo")
{
	//reviso que se mandaran todos los valores necesarios para crear el objeto de la clase Producto.php
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
		$autor_producto=$_POST["autor_producto"];
		$idautor=-1;
		if(isset($_POST["i".$autor_producto])){
			$idautor=$_POST["i".$autor_producto];
		}
	}
	if(isset($_POST["descripcion_producto"]))
	{
		$descripcion_producto=addslashes($_POST["descripcion_producto"]);}
	else{
			$descripcion_producto="";
	}
	if(isset($_POST["fechacreacio_producto"]))
	{
		$fechacreacio_producto=$_POST["fechacreacio_producto"];}
	else{
		$fechacreacio_producto="";
	}
	if(isset($_POST["comunidad_producto"]))
	{
		$comunidad_producto=$_POST["comunidad_producto"];
		$idComunidad=-1;
		if(isset($_POST["co".$comunidad_producto])){
			$idComunidad=$_POST["co".$comunidad_producto];
		}
	}
	else{
		$comunidad_producto="";
	}
	if(isset($_POST["genero_producto"]))
	{
		$genero_producto=$_POST["genero_producto"];}
	else{
		$genero_producto="";
	}
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
	if(isset($_POST["estado"]))
	{
		$estado=$_POST["estado"];}
	else{
		$estado="";
	}
	//
	$usuario_id_usuario=$_SESSION['id_usuario'];
	$id_producto = 0;
	$fechapublicacion_producto=$fechacreacio_producto;
	if ($_POST["tipo_producto"]==2 AND ($_POST["link_ytb"]!="")) {
		$objProd=new Producto();
		$nombreArchivo=preg_replace('[\s+]','',$titulo_producto);
		$objProd=new Producto();
		if(preg_replace('[\s+]','', $autor_producto)!="" && $idautor==-1){
			$objProd->nuevoAutor($autor_producto);
			$idautor = $objProd->buscarAutor($autor_producto);
			$idautor = mysqli_fetch_array($idautor);
			$idautor = $idautor[0];
		}else{
			echo "<script language='javascript'>alert('ERROR:,AUTOR VIENE VACIO');
			window.location='../Vista/GUICarga.php'</script>";
		}
		if(preg_replace('[\s+]','', $comunidad_producto)!="" && $idComunidad==-1){
			$objProd->nuevaComunidad($comunidad_producto);
			$idComunidad = $objProd->buscarComunidad($comunidad_producto);
			$idComunidad = mysqli_fetch_array($idComunidad);
			$idComunidad = $idComunidad[0];
		}else{
			echo "<script language='javascript'>alert('ERROR:,Comunidad viene vacío');
			window.location='../Vista/GUICarga.php'</script>";
		}
		$link=$_POST["link_ytb"];
		$tipo_subida="youtube";
		$titulo_producto = addslashes($titulo_producto);
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
		$idComunidad,
		$idioma_id_idioma,
		$tipo_producto,
		$idautor,
		$link);
		$resul=$objProd->ingresarProducto();//compruebo si la fila se subio a la base de datos y envio el mensaje correspondiente
		if ($resul!=""){
			echo "<script language='javascript'>alert('BIEN:DATOS ALMACENADOS');
				window.location='../Vista/GUICarga.php'</script>";
		}
		else {
			echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
			window.location='../Vista/GUICarga.php'</script>";
		}
	}
	else{
		// condiciones para saber donde se va a guardar el archivo, que tipo de extencion se permite y el tamaño maximo aceptado para su posterior alojamiento en el servidor
		$extDocumentos=["pdf","PDF"];
		$extAudios=['mp3','MP3','mp4','MP4','m4a','M4A','ogg','OGG','wav','WAV'];
		$extVideos=['mp4','MP4','m4v','M4V','MOV','mov','wmv','WMV','avi','AVI','MPG','mpg','ogv','OGV','3gp','3GP','3G2','3g2'];
		$ExtPermitida=false;
		$ext=pathinfo(basename( $_FILES['uploadedfile']['name']),PATHINFO_EXTENSION);
		
		if ($_POST["tipo_producto"]==1){
			$target_path = "../archivos/audios/";
			foreach ($extAudios as $e) {
				if($e==$ext){
					$ExtPermitida=true;
				}
			}
			$size=104857600;//100 MEGAS
		}
		elseif ($_POST["tipo_producto"]==2){
			$target_path = "../archivos/videos/";
			foreach ($extVideos as $e) {
				if($e==$ext){
					$ExtPermitida=true;
				}
			}
				$size=1073741824;//1 GIGA
		}
		elseif ($_POST["tipo_producto"]==3){
			$target_path = "../archivos/investigacion/";
			foreach ($extDocumentos as $e) {
				if($e==$ext){
					$ExtPermitida=true;
				}
			}
			$size=26214400; //25 Megas en bytes
		}
		elseif ($_POST["tipo_producto"]==4){
			$target_path = "../archivos/literatura/";
			foreach ($extDocumentos as $e) {
				if($e==$ext){
					$ExtPermitida=true;
				}
			}
			$size=26214400; //25 megas en bytes
			// 	 bytes 		kilobytes megabytes gigabytes
			//	1073741824 	1048576		1024		1
		}
		if(($_POST["tipo_producto"]==4 or $_POST["tipo_producto"]==3) and $ExtPermitida==false){
			echo "<script language='javascript'>alert('PARA INVESTIGACIÓN Y LITERATURA SOLO SE PERMITEN	ARCHIVOS PDF');
							window.location='../Vista/GUICarga.php'</script>";
		}
		$codError="";
		$objProd=new Producto();
		$nombreArchivo=preg_replace('[\s+]','',$titulo_producto);
		$target_path = $target_path.$nombreArchivo.($objProd->ultimoProducto()+1).".".$ext;
		if ($ExtPermitida){
		// nos aseguramos que el tamaño del archivo sea menor al minimo permitido y si la extencion de archivo corresponde a la aceptada
			if ($_FILES['uploadedfile']['size']<$size){
				//move_uploaded_file sube el archivo al servidor y solo si logra hacerlo, entra en la condicion para crear una fila en la tabla producto
				if($_FILES['uploadedfile']['error']==0 || $_FILES['uploadedfile']['error']==null){
					if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
						$link=$target_path;
						$objProd=new Producto();
							if(preg_replace('[\s+]','', $autor_producto)!="" && $idautor==-1){
								$objProd->nuevoAutor($autor_producto);
								$idautor = $objProd->buscarAutor($autor_producto);
								$idautor = mysqli_fetch_array($idautor);
								$idautor = $idautor[0];
							}else{
								echo "<script language='javascript'>alert('ERROR:,AUTOR VIENE VACIO');
								window.location='../Vista/GUICarga.php'</script>";
							}
							if(preg_replace('[\s+]','', $comunidad_producto)!="" && $idComunidad==-1){
								$objProd->nuevaComunidad($comunidad_producto);
								$idComunidad = $objProd->buscarComunidad($comunidad_producto);
								$idComunidad = mysqli_fetch_array($idComunidad);
								$idComunidad = $idComunidad[0];
							}else{
								echo "<script language='javascript'>alert('ERROR:,Comunidad viene vacío');
								window.location='../Vista/GUICarga.php'</script>";
							}
						$tipo_subida="local";
						$titulo_producto = addslashes($titulo_producto);
						$link = addslashes($link);
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
						$idComunidad,
						$idioma_id_idioma,
						$tipo_producto,
						$idautor,
						$link);
						$resul=$objProd->ingresarProducto();//compruebo si la fila se subio a la base de datos y envio el mensaje correspondiente
							if ($resul!=""){
								echo "<script language='javascript'>alert('BIEN:DATOS ALMACENADOS');
									window.location='../Vista/GUICarga.php'</script>";
							}
							else {
								echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
								window.location='../Vista/GUICarga.php'</script>";
							}
					}else{
						echo "<script language='javascript'>alert('ERROR:,HA OCURRIDO UN ERROR INTENTE DENUEVO');
							window.location='../Vista/GUICarga.php'</script>";;
					}
				}else{
					$codError.="Archivo no se puede subir Codigo de error: ".$_FILES['uploadedfile']['error']."</br>";
				}
			}else{
				$msj= "Ha ocurrido un error, el archivo de ".$_FILES['uploadedfile']['size']." bytes es muy pesado, trate con uno nuevo menor a ".$size/1024**2;
				echo "<script language='javascript'>alert('".$msj."');
							window.location='../Vista/GUICarga.php'</script>";
			}
		}else{
			echo 'Extención no permitida para este tipo de archivo';
		}
	}
//fin de la funcion para subir archivo y su respectivo parentesis
}

if(isset($_GET["Buscar"]) && $_GET["Buscar"]=="Buscar")
{ 	
	if(isset($_GET["id_genero"])){
		$id_genero=$_GET["id_genero"];
	}
	if(isset($_GET["genero"])){
		$genero=$_GET["genero"];
	}
	if(isset($_GET["autor_producto"])){
		$autor_producto=$_GET['autor_producto'];
		$autor_producto=strtolower($autor_producto);
		$nombre="i".preg_replace('[\s+]','', $autor_producto);
		if(isset($_GET[$nombre])){
			$idautor=$_GET[$nombre];
		}
	}
	$where="";
	if(empty($_GET["titulo_producto"]) && empty($idautor) && empty($_GET["fechapublicacion_producto"]))
 	{
		$w="";
		echo'Aqui el where esta vacio yehi';
 	}
 	else if(empty($_GET["autor_producto"]) && empty($_GET["fechapublicacion_producto"]))
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' ";
	}
	else if(empty($_GET["titulo_producto"]) && empty($_GET["fechapublicacion_producto"]))
	{
		$where=" and p.autor_producto=".$idautor."";
	}
	else if(empty($_GET["titulo_producto"]) && empty($_GET["autor_producto"]))
	{
		$where=" and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
 	}
 	else if(empty($_GET["titulo_producto"]))
	{
		$where=" and p.autor_producto=".$idautor." and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
	}

	else if(empty($_GET["autor_producto"]))
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
	}
	else if(empty($_GET["fechapublicacion_producto"]))
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' and p.autor_producto=".$idautor." ";
	}
	else
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' and p.autor_producto=".$idautor." and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
	}
	if ($where!=""){
	echo '<script language="javascript">
		window.location="../Vista/GUILibro.php?id_genero='.$id_genero.'&genero='.$genero.'&where='.$where.'"</script>';
	}
	else{
		echo '<script language="javascript">
		window.location="../Vista/GUILibro.php?id_genero='.$id_genero.'&genero='.$genero.'"</script>';
	}
}
if(isset($_GET["Buscar2"]) && $_GET["Buscar2"]=="Buscar2")
{ 	
	if(isset($_GET["id_tipo"])){
		$id_tipo=$_GET["id_tipo"];
	}
	if(isset($_GET["tipo"])){
		$tipo=$_GET["tipo"];
	}
	if(isset($_GET["autor_producto"])){
		$autor_producto=$_GET['autor_producto'];
		$autor_producto=strtolower($autor_producto);
		$nombre="i".preg_replace('[\s+]','', $autor_producto);
		if(isset($_GET[$nombre])){
			$idautor=$_GET[$nombre];
		}
	}
	$where="";
	if(empty($_GET["titulo_producto"]) && empty($idautor) && empty($_GET["fechapublicacion_producto"]))
 	{
		$w="";
		echo'Aqui el where esta vacio yehi';
 	}
 	else if(empty($_GET["autor_producto"]) && empty($_GET["fechapublicacion_producto"]))
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' ";
	}
	else if(empty($_GET["titulo_producto"]) && empty($_GET["fechapublicacion_producto"]))
	{
		$where=" and p.autor_producto=".$idautor."";
	}
	else if(empty($_GET["titulo_producto"]) && empty($_GET["autor_producto"]))
	{
		$where=" and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
 	}
 	else if(empty($_GET["titulo_producto"]))
	{
		$where=" and p.autor_producto=".$idautor." and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
	}

	else if(empty($_GET["autor_producto"]))
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
	}
	else if(empty($_GET["fechapublicacion_producto"]))
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' and p.autor_producto=".$idautor." ";
	}
	else
	{
		$where=" and p.titulo_producto like '".$_GET["titulo_producto"]."%' and p.autor_producto=".$idautor." and p.fechapublicacion_producto >= '".$_GET["fechapublicacion_producto"]."' ";
	}
	if ($where!=""){
	echo '<script language="javascript">
		window.location="../Vista/GUIMultimedia.php?id_tipo='.$id_tipo.'&tipo='.$tipo.'&where='.$where.'"</script>';
	}
	else{
		echo '<script language="javascript">
		window.location="../Vista/GUIMultimedia.php?id_tipo='.$id_tipo.'&tipo='.$tipo.'"</script>';
	}
}	
?>