<?php
require_once("../Modelo/Usuario.php");

/*if (($_POST["uclave"])!=($_POST["confclave"])) {
  echo "<script language='javascript'>alert('Las contraseñas no coinciden, verfícalo');window.location='../Vista/GUINuevoUsuario.php'</script>";
}*/
if(isset($_POST["id_usuario"]) && $_POST["id_usuario"]!="" )
{$id_usuario=$_POST["id_usuario"];}

 //echo $id_usuario=$_POST["id_usuario"];

if(isset($_POST["unombre"]) && $_POST["unombre"]!="" )
{$nombre_usuario=$_POST["unombre"];}

if(isset($_POST["uperfil"]) && $_POST["uperfil"]!="" )
{$perfil_usuario=$_POST["uperfil"];}

if(isset($_POST["uclave"]) && $_POST["uclave"]!="" ) // Para modificar, este almacenará el pass que 
{$clave_usuario=$_POST["uclave"];}                  //está en la BD

if(isset($_POST["nclave"]) && $_POST["nclave"]!="" ){ 
  $npassword=$_POST["nclave"];
}

if(isset($_POST["ucorreo"]) && $_POST["ucorreo"]!="" )
{$correo_usuario=$_POST["ucorreo"];
  $correo_usuario=preg_replace('[\s+]','',strtolower (''.$correo_usuario));
}

if(isset($_POST["upaterno"]) && $_POST["upaterno"]!="" )
{$paterno_usuario=$_POST["upaterno"];}

if(isset($_POST["umaterno"]) && $_POST["umaterno"]!="" )
{$materno_usuario=$_POST["umaterno"];}

/*if(isset($_POST["confclave"]) && $_POST["confclave"]!="" )
{ $nperfil=$_POST["confclave"];}*/
//if(isset($_POST["uocupacion"]) && $_POST["uocupacion"]!="" )
 // { $ocupacion_usuario=$_POST["uocupacion"];}
if(isset($_POST["uocupacion"]) && ltrim($_POST["uocupacion"])!="" ){
    $uocupacion=$_POST["uocupacion"];
    $idOcupa=-1;
    if(isset($_POST["i".$uocupacion])){
      $idOcupa=$_POST["i".$uocupacion];
    }
  }
  

if(isset($_POST["ufecha"]) && $_POST["ufecha"]!="" )
  {$ufecha=$_POST["ufecha"];}

//Para que se registre el usuario
if(isset($_POST["OK0"]) && $_POST["OK0"]=="Ingresar"){ 
  if(isset($_POST["nusuario"])){
    //compruebo que ya exista o no el nombre de usuario no el nombre personal es un atributo que agregue a la tabla para evitar nombres iguales con perfiles distintos
    $objUsu=new Usuario();
    $nusuario = preg_replace('[\s+]','',strtolower (''.$_POST["nusuario"]));
    $existe = $objUsu->compruebaUsuario($nusuario);
    $existe;
  }
  
  $confclave=$_POST["confclave"];
  if($clave_usuario==$confclave){
    $objUsu=new Usuario();
    if(!($objUsu->compruebaCorreo($_POST["ucorreo"]))){
      if (($_POST["registroXusuario"]=="registroXusuario") and !$existe) {
        $id_usuario=0;
        if(preg_replace('[\s+]','', $uocupacion)!="" && $idOcupa==-1){
            $objUsu->nuevaOcupacion($uocupacion);
            $idOcupa = $objUsu->buscarOcupacion($uocupacion);
            $idOcupa = mysqli_fetch_array($idOcupa);
            $idOcupa = $idOcupa[0];
          }
        // Se encripta la clave con un hash
        $clave_usuario = password_hash($clave_usuario,PASSWORD_DEFAULT);
        
        $objUsu->Usuario3($nombre_usuario,$perfil_usuario,$clave_usuario,$correo_usuario,$paterno_usuario,$materno_usuario,'',$idOcupa,1,1,$nusuario,$ufecha);
        $resul=$objUsu->crearUsuario();
        if ($resul!="") {echo "<script language='javascript'>alert('USUARIO ".$nusuario." CREADO CON EXITO');
                    window.location='../GUILogin2.php'</script>"; }
        else {  echo "<script language='javascript'>alert('ERROR: USUARIO NO CREADO');
                    window.location='../Vista/GUIRegistrar.php'</script>"; }
      }else {  echo "<script language='javascript'>alert('ERROR: USUARIO NO CREADO YA EXISTE ESTE NOMBRE DE USUARIO');
                    window.location='../Vista/GUIRegistrar.php'</script>"; }
    }else{ echo "<script language='javascript'>alert('ERROR: USUARIO NO CREADO ESTE CORREO YA HA SIDO REGISTRADO');
                    window.location='../Vista/GUIRegistrar.php'</script>";}
  }else{
    echo "<script language='javascript'>alert('ERROR: USUARIO NO CREADO LAS CLAVES DEBEN COINCIDIR');
                  window.location='../Vista/GUIRegistrar.php'</script>";
  }
}
//Para registrar usuario desde panel de control 
if(isset($_POST["OK4"]) && $_POST["OK4"]=="Ingresar"){
  if(isset($_POST["nusuario"])){
    //compruebo que ya exista o no el nombre de usuario no el nombre personal es un atributo que agregue a la tabla para evitar nombres iguales con prefiles distintos
    $objUsu=new Usuario();
    $nusuario = preg_replace('[\s+]','',strtolower (''.$_POST["nusuario"]));
    $existe = $objUsu->compruebaUsuario($nusuario);
    echo $existe;
  }
  if (($_POST["registroXadmin"]=="registroXadmin") and !$existe) {
    
    if(isset($_POST["uocupacion"]) && $_POST["uocupacion"]!="" ){
    $idOcupa=$_POST["uocupacion"];
    }
      // Se encripta la clave con un hash
      $clave_usuario = password_hash($clave_usuario,PASSWORD_DEFAULT);
      
      $objUsu=new Usuario();
      $objUsu->Usuario3($nusuario,$perfil_usuario,$clave_usuario,$correo_usuario,$paterno_usuario,$materno_usuario,'',$idOcupa,1,1,$nombre_usuario,$ufecha);
      $resul=$objUsu->crearUsuario();
      if ($resul!="") {
        echo "<script language='javascript'>alert('Bien: ".$perfil_usuario."  creado');
                  window.location='../Vista/GUINuevoUsuario.php'</script>";
      }
      else {  echo "<script language='javascript'>alert('ERROR: USUARIO NO CREADO');
                  window.location='../Vista/GUINuevoUsuario.php'</script>"; }
    }else {  echo "<script language='javascript'>alert('ERROR: USUARIO NO CREADO YA EXISTE ESTE NOMBRE DE USUARIO');
                  window.location='../Vista/GUINuevoUsuario.php'</script>"; }


}


//Sentencia para hacer la modificación
if(isset($_POST["OK1"]) && $_POST["OK1"]=="Modificar"){
   $objUsu=new Usuario();
    if(preg_replace('[\s+]','', $uocupacion)!="" && $idOcupa==-1){
            $objUsu->nuevaOcupacion($uocupacion);
            $idOcupa = $objUsu->buscarOcupacion($uocupacion);
            $idOcupa = mysqli_fetch_array($idOcupa);
            $idOcupa = $idOcupa[0];
    }  
    // Se encripta la clave con un hash
    $clave_usuario = password_hash($npassword,PASSWORD_DEFAULT);
    //Se ingresa a la BD

    $objUsu->Usuario2($id_usuario,$nombre_usuario,$perfil_usuario,$clave_usuario,$correo_usuario,$paterno_usuario,$materno_usuario,$idOcupa,$ufecha);
    $resul=$objUsu->modificarUsuario();

    if ($resul!="") {
      echo "<script language='javascript'>alert('Los datos se guardaron correctamente');
                window.location='../Vista/GUINuevoUsuario.php'</script>";
    }
    else {  

        echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
                window.location='../Vista/GUINuevoUsuario.php'</script>"; 
    }
}

//Para dar de baja usuario

if(isset($_POST["OK2"]) && $_POST["OK2"]=="Eliminar"){
  $objUsu=new Usuario();
  $objUsu->setId_Usuario($id_usuario);
  $resul=$objUsu->modificarEdoUsuario();
  if ($resul!="") header("Location:../Vista/GUINuevoUsuario.php");
  else   echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
                window.location='../Vista/GUINuevoUsuario.php'</script>";          
}

//Para dar de alta usuario
if(isset($_POST["OK3"]) && $_POST["OK3"]=="Alta"){
  $objUsu=new Usuario();
  $objUsu->setId_Usuario($id_usuario);
  $resul=$objUsu->activarEdoUsuario();
  if ($resul!="") header("Location:../Vista/GUINuevoUsuario.php");
  else   echo "<script language='javascript'>alert('ERROR:DATOS PERDIDOS, NO ALMACENADOS');
                window.location='../Vista/GUINuevoUsuario.php'</script>";          
}

?>
