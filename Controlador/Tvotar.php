<?php  
	require_once('../Datos/Conexion.php');

	$voto_like = $_GET['like']; //Likes-dislikes es igual a 1 o 0
	$id_user = $_GET['id'];  //Se toma el id del usuario
	$id_pro = $_GET['pro'];  //Se toma el id del producto
	$tipo_producto = $_GET['tipo_producto'];
// Hago la seleccion de la columna like y dislike en tabla la producto
	$objConex=new Conexion();
	$selec = "SELECT id_producto,suma_like,suma_dislike FROM producto WHERE (id_producto='".$id_pro."')";
	$qry=$objConex->generarTransaccion($selec);
	if ($qry) {
		while ($row = mysqli_fetch_array($qry)) {
			if ($row['id_producto']==$id_pro) {
				$suma_li = $row['suma_like'];
				$resta_li = $row['suma_dislike'];
			}
		}
	}
	

if (isset($voto_like) and isset($id_user) and isset($id_pro)){
	$verify=0;
		$objConex=new Conexion();//Instanciar clase Conexion
		$sql = "SELECT * FROM likes WHERE id_user='".$id_user."' AND id_prod='".$id_pro."' LIMIT 1";
		$vector=$objConex->generarTransaccion($sql);
		if ($vector) {
			while ($row = mysqli_fetch_array($vector)) {
				$id_v = $row['id_like'];
				$id_u = $row['id_user'];
				$id_p = $row['id_prod'];
				$li_dis = $row['like_dislike'];
			}
			if (isset($id_p) and isset($id_u) and isset($li_dis) and isset($id_p)) {
					echo "<script language='javascript'>alert('Gracias pero haz votado');
					window.location='../Vista/GUIDetaPublic.php?id_producto=$id_pro&tipo_producto=$tipo_producto'</script>";
			}else {
				$objConex=new Conexion();
				$INSERT = "INSERT INTO likes (id_user,id_prod,like_dislike) VALUES ('".$id_user."','".$id_pro."','".$voto_like."')";
				$qry=$objConex->generarTransaccion($INSERT);
				if ($voto_like==1) {
					$suma_li++;
					$objConex=new Conexion();
					$UPDATE = "UPDATE producto SET suma_like = '".$suma_li."' WHERE (id_producto='".$id_pro."')";
					$qry=$objConex->generarTransaccion($UPDATE);
				} else {
					$resta_li++;
					$objConex=new Conexion();
					$UPDATE = "UPDATE producto SET suma_dislike = '".$resta_li."' WHERE (id_producto='".$id_pro."')";
					$qry=$objConex->generarTransaccion($UPDATE);
				}
				echo "<script language='javascript'>alert('Gracias por votar');
					window.location='../Vista/GUIDetaPublic.php?id_producto=$id_pro&tipo_producto=$tipo_producto'</script>";
			}
			
		}else{
			echo "Error de consulta";
		}
}

?>		