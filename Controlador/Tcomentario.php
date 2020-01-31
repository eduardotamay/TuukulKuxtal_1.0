<?php  
require_once("../Modelo/Comentario.php");

// echo "Id_producto <strong>:".$_POST["id_producto"]."</strong></br>";
// echo "Tipo_producto <strong>:".$_POST["tipo_producto"]."</strong></br>";
// echo "Comentario <strong>:".$_POST["comentario"]."</strong></br>";
// echo "Nombre usuario <strong>:".$_POST["nom_user"]."</strong></br>";

if(isset($_POST["nom_user"]) && $_POST["nom_user"]!="" )
{ $nom_usuario=$_POST["nom_user"];}

if(isset($_POST["comentario"]) && $_POST["comentario"]!="" )
{ $comentario=addslashes($_POST["comentario"]);}

if(isset($_POST["id_producto"]) && $_POST["id_producto"]!="" )
{ $id=$_POST["id_producto"];}

if(isset($_POST["tipo_producto"]) && $_POST["tipo_producto"]!="" )
{ $tipo_producto=$_POST["tipo_producto"];}

if(isset($_POST["tipo_comentario"]) && $_POST["tipo_comentario"]!="" )
{ $tipo_comentario=$_POST["tipo_comentario"];}


if(isset($_POST["OK1"]) && $_POST["OK1"]=="Publicar Ahora"){
	$objUsu=new Comentario();
	if ($objUsu->compruebaUsuario($_POST["nom_user"])==TRUE) {//Inicio
		$objConex=new Conexion();
		$sql="SELECT * FROM usuario  WHERE nombre_usuario='".$nom_usuario."'";
		$result=$objConex->generarTransaccion($sql);
		while ($mostrar = mysqli_fetch_array($result)) {
			    // echo $mostrar['id_usuario'];
				$objUsu->Comentario($comentario,$mostrar['id_usuario'],$id,$tipo_comentario);
				$resul=$objUsu->insertarComentario($comentario,$mostrar['id_usuario'],$id,$tipo_comentario);
				if ($resul!=""){
					if ($tipo_comentario=="revision" and $_POST["detalle"]=="detaLibro") {
						echo "<script language='javascript'>alert('BIEN:COMENTARIO ALMACENADOS & PUBLICADO');
						window.location='../Vista/GUIDetalleLibro.php?id_producto=$id&tipo=$tipo_producto'</script>";
					}if ($tipo_comentario=="revision" and $_POST["detalle"]=="detaMulti") {
						echo "<script language='javascript'>alert('BIEN:COMENTARIO ALMACENADOS & PUBLICADO');
						window.location='../Vista/GUIDetalleMultimedia.php?id_producto=$id&tipo=$tipo_producto'</script>";
					}
					if ($tipo_comentario=="publico") {
						echo "<script language='javascript'>alert('BIEN:COMENTARIO ALMACENADOS & PUBLICADO');
						window.location='../Vista/GUIDetaPublic.php?id_producto=$id&tipo_producto=$tipo_producto'</script>";
					}
						//Mando de regreso el id y el tipo producto para no generar error
				}else {
					if ($tipo_comentario=="revision" and $_POST["detalle"]=="detaLibro") {
						echo "<script language='javascript'>alert('ERROR:Comentario no publicado');
					window.location='../Vista/GUIDetalleLibro.php?id_producto=$id&tipo=$tipo_producto'</script>";
					}if ($tipo_comentario=="revision" and $_POST["detalle"]=="detaMulti") {
						echo "<script language='javascript'>alert('ERROR:Comentario no publicado');
					window.location='../Vista/GUIDetalleMultimedia.php?id_producto=$id&tipo=$tipo_producto'</script>";
					}
					if ($tipo_comentario=="publico") {
						echo "<script language='javascript'>alert('ERROR:Comentario no publicado');
					window.location='../Vista/GUIDetaPublic.php?id_producto=$id&tipo_producto=$tipo_producto'</script>";
					}
				}
		    
	 	}
 	}else{//Tambien
			echo "<script language='javascript'>alert('ERROR:Usuario no encontrado, verifique');
				window.location='../Vista/GUIDetaPublic.php?id_producto=$id&tipo_producto=$tipo_producto'</script>";
		}//Aqui termina
}	
?>