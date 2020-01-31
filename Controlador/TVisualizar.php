<?php
	//echo $_GET['id_producto'];
	$id_producto=$_GET['id_producto'];
	require_once("../Modelo/Producto.php");
	$objProd=new Producto();
	$result = $objProd->linkTituloProducto($id_producto);
	$reg = mysqli_fetch_array($result);
	$link ="".$reg[0];
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<iframe style="width:100vw; height:100vh;" frameborder="0" src=<?php echo $link; ?>> </iframe>
</body>
</html>