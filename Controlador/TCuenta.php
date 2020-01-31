<?php
require_once("../Modelo/Usuario.php");
session_start();

if(isset($_POST["id_usuario"]) && $_POST["id_usuario"]!="" )
{ $id_usuario=$_POST["id_usuario"];}

if(isset($_POST["unombre"]) && $_POST["unombre"]!="" )
{ $nombre_usuario=$_POST["unombre"];}

if(isset($_POST["uperfil"]) && $_POST["uperfil"]!="" )
{ $perfil_usuario=$_POST["uperfil"];}

if(isset($_POST["uclave"]) && $_POST["uclave"]!="" ) // Pass que
{ $clave_usuario=$_POST["uclave"];}                  //está en la BD

if(isset($_POST["nclave"]) && $_POST["nclave"]!="" ){ 
  $npassword=$_POST["nclave"];
}else{$npassword="";}
if(isset($_POST["ucorreo"]) && $_POST["ucorreo"]!="" )
{ $correo_usuario=$_POST["ucorreo"];}

if(isset($_POST["upaterno"]) && $_POST["upaterno"]!="" )
{ $paterno_usuario=$_POST["upaterno"];}

if(isset($_POST["umaterno"]) && $_POST["umaterno"]!="" )
{ $materno_usuario=$_POST["umaterno"];}

if(isset($_POST["uocupacion"]) && ltrim($_POST["uocupacion"])!="" ){
    $uocupacion=$_POST["uocupacion"];
    $idOcupa=-1;
    if(isset($_POST["i".$uocupacion])){
      $idOcupa=$_POST["i".$uocupacion];
    }
  }
  
if(isset($_POST["ufecha"]) && $_POST["ufecha"]!="" )
  { $ufecha=$_POST["ufecha"];}

//Sentencia para hacer la modificación de la cuenta del usuario
if(isset($_POST["OK1"]) && $_POST["OK1"]=="Modificar"){
    $objUsu=new Usuario();
    // $clave_usuario=$objUsu->claveUsuario($_SESSION['id_usuario']);//Busca el hash cifrado en la DB
    if (($_POST["nclave"]=="") && ltrim($_POST["nclave"])=="") {
        if(isset($_POST["nconf"]) && ltrim($_POST["nconf"])!="" ){ 
        $nconf=$_POST["nconf"];
        if(trim($_POST["nconf"])!="" and isset($_POST["nconf"])){
          if(password_verify($_POST["nconf"],$objUsu->claveUsuario($_SESSION['id_usuario']))){
            $clave_usuario=$nconf;
            if(preg_replace('[\s+]','', $uocupacion)!="" && $idOcupa==-1){
              $objUsu->nuevaOcupacion($uocupacion);
              $idOcupa = $objUsu->buscarOcupacion($uocupacion);
              $idOcupa = mysqli_fetch_array($idOcupa);
              $idOcupa = $idOcupa[0];
          }
            // Se encripta la clave con un hash
            $clave_usua = password_hash($clave_usuario,PASSWORD_DEFAULT);
            
            $objUsu->Usuario2($id_usuario,$nombre_usuario,$perfil_usuario,$clave_usua,$correo_usuario,$paterno_usuario,$materno_usuario,$idOcupa,$ufecha);
            $resul=$objUsu->modificarUsuario();

            if ($resul!="") {
              // echo $clave_usuario=password_verify($_POST["nconf"],$objUsu->claveUsuario($_SESSION['id_usuario']));
              echo "<script language='javascript'>alert('Los datos se guardaron correctamente');
                        window.location='../Vista/GUICuenta.php'</script>";
            }
            else {  

                echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
                        window.location='../Vista/GUICuenta.php'</script>"; 
            }

          }else{
            echo "<script language='javascript'>alert('ERROR: Las contraseñas no coinciden');
                        window.location='../Vista/GUICuenta.php'</script>"; 
            }
            }else{
              echo "<script language='javascript'>alert('ERROR:CONTRASEÑA ESTÁ VACÍA');
                        window.location='../Vista/GUICuenta.php'</script>";   
            }
        }else{
          echo "<script language='javascript'>alert('ERROR: Las contraseñas no coinciden');
                        window.location='../Vista/GUICuenta.php'</script>";
        }
    }else{
        $passconfi = $_POST["nconf"];
        if(ltrim($npassword)!="" and ltrim($passconfi)!=""){
           if ($npassword == $passconfi) {
             $clave_us = password_hash($passconfi,PASSWORD_DEFAULT);
             $changePass = $objUsu->updatePassword($_SESSION['id_usuario'],$clave_us);
             echo "<script language='javascript'>alert('Cambio exitoso');
                      window.location='../Vista/GUICuenta.php'</script>";
           }else{
            echo "<script language='javascript'>alert('ERROR: Las contraseñas no coinciden');
                      window.location='../Vista/GUICuenta.php'</script>";
           }
        }else{
          echo "<script language='javascript'>alert('ERROR: Las contraseñas están vacías');
                      window.location='../Vista/GUICuenta.php'</script>";
        }
    }
}

//Sentencia para subir foto del usuario
if(isset($_POST["OK2"]) && $_POST["OK2"]=="SubirFoto"){
    require_once("../Datos/Conexion.php");
    $objConex=new Conexion();   //Hay que almacener con el ID
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    //si voy a modificar debe ser un UPDATE!!!!
    $sql = "UPDATE usuario set imagen_usuario = '$imagen' where (id_usuario=".$id_usuario.")";
        
      $resul=$objConex->generarTransaccion($sql);
      
      if ($resul==true) {
          
        echo "<script language='javascript'>
                window.location='../Vista/GUICuenta.php'</script>";
        }else{  
      
        echo "<script language='javascript'>alert('ERROR:FOTO NO ALMACENADO');
                window.location='../Vista/GUICuenta.php'</script>"; 
    }
   
}
/*if(isset($_POST["OK"]) && $_POST["OK"]=="Buscar")
{  $objUsu=new Usuario();
  $objUsu->Usuario($nusuario,$nclave,$nperfil,$nnombre,$ncorreo,$nocupa);
  $resul=$objUsu->buscarUsuario();
  if ($resul!="") header("Location:../Vista/GUINuevoUsuario.php");
  else   echo "<script language='javascript'>alert('ERROR:DATOS DE USUARIO, NO ALMACENADOS');
                window.location='../Vista/GUINuevoUsuario.php'</script>";         
}*/

/*
if(isset($_POST["OK2"]) && $_POST["OK2"]=="Eliminar")
{ $objUsu=new Factura();
  $objUsu->setId($id);
  $resul=$objUsu->eliminarFactura();
  if ($resul!="") header("Location:../Vista/GUICuenta.php");
  else   echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
                window.location='../Vista/GUICuenta.php'</script>";          
}
if(isset($_POST["OK3"]) && $_POST["OK3"]=="Ingresar")
{  $objUsu=new Usuario();
  $objUsu->Usuario($usuario,$clave,$perfil,$nombre,$correo,$ocupacion);
  $resul=$objUsu->crearUsuario();
  if ($resul!="") header("Location:../Vista/GUINuevoUsuario.php");
  else   echo "<script language='javascript'>alert('ERROR:DATOS DE USUARIO, NO ALMACENADOS');
                window.location='../Vista/GUINuevoUsuario.php'</script>";         
}*/
?>

