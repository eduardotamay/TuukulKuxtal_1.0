<?php
//por ahora no esta dentro de una condición, para asegurarse que el codigo funcionara 
$id=$_GET["id_producto"];
require_once '../Modelo/Producto.php';
$objPro = new Producto();
$result = $objPro->linkTituloProducto($id);
$reg = mysqli_fetch_array($result);
$link =$reg[0];
$titulo =$reg[1];
$info = new SplFileInfo($link);
$ext=pathinfo($info->getFilename(), PATHINFO_EXTENSION);
$titulo=preg_replace('[\s+]','_', $titulo);
$file=fopen($link,"r");
$t= filesize($link);
ob_get_level();
if (file_exists($link)) {
    header("Content-Description: File Transfer");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    //header("Cache-Control: must-revalidate");
    header("content-Type: application/force-download");
    header("Content-Type: application/".$ext."");
    header("Content-Disposition: attachment; filename=".$titulo.".".pathinfo($info->getFilename(), PATHINFO_EXTENSION));
    header("content-Transfer-Encoding: binary");
    //header("Pragma: public");
    //header("Content-Length: " .$t );
    readfile($link);
    exit;
}else{
	echo "<script language='javascript'>alert('ERROR: Archivo no descargado');</script>";
}
    

?>
