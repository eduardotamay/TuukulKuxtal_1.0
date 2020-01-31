<?php
require_once("../Datos/Conexion.php");
class Usuario{  
   
   private $id_usuario;
   private $nombre_usuario;
   private $perfil_usuario;
   private $clave_usuario;
   private $correo_usuario;
   private $paterno_usuario;
   private $materno_usuario;
   private $imagen_usuario;
   private $ocupacion_usuario;
   private $admin;
   private $disponible;
   private $usuario;
   private $fecha_nacimiento;
   //private $status;
 
   public function __construct(){}
   
   public function Usuario($id_usuario,$nombre_usuario,$perfil_usuario,$clave_usuario,$correo_usuario,$paterno_usuario,$materno_usuario,$ocupacion_usuario,$imagen_usuario,$fecha_nacimiento){

	   $this->id_usuario 		= $id_usuario;
	   $this->nombre_usuario 	= $nombre_usuario;
	   $this->perfil_usuario 	= $perfil_usuario;
	   $this->clave_usuario 	= $clave_usuario;
	   $this->correo_usuario 	= $correo_usuario;
	   $this->paterno_usuario 	= $paterno_usuario;
	   $this->materno_usuario 	= $materno_usuario;
	   $this->ocupacion_usuario =$ocupacion_usuario;
	   //this->status = $status;
	   $this->imagen_usuario 	= $imagen_usuario;
	   $this->fecha_nacimiento  = $fecha_nacimiento;
   }
   public function Usuario3($nombre_usuario,$perfil_usuario,$clave_usuario,$correo_usuario,$paterno_usuario,$materno_usuario,$imagen_usuario,$ocupacion_usuario,$admin,$disponible,$usuario,$fecha_nacimiento){

	   $this->nombre_usuario 	= $nombre_usuario;
	   //echo $nombre_usuario;
	   $this->perfil_usuario 	= $perfil_usuario;
	   //echo $perfil_usuario;
	   $this->clave_usuario 	= $clave_usuario;
	   //echo $clave_usuario;
	   $this->correo_usuario 	= $correo_usuario;
	   //echo $correo_usuario;
	   $this->paterno_usuario 	= $paterno_usuario;
	   //echo $paterno_usuario;
	   $this->materno_usuario 	= $materno_usuario;
	   //echo $materno_usuario;
	   $this->imagen_usuario 	= $imagen_usuario;
	   $this->ocupacion_usuario = $ocupacion_usuario;
	   //echo $ocupacion_usuario;
	   $this->admin 			= $admin;
	   //echo $admin;
	   $this->disponible 		= $disponible;
	   //echo $disponible;
	   $this->usuario			= $usuario;
	   //echo $usuario;
	   $this->fecha_nacimiento  = $fecha_nacimiento;
   	   //echo $fecha_nacimiento;
   }
   public function Usuario2($id_usuario,$nombre_usuario,$perfil_usuario,$clave_usuario,$correo_usuario,$paterno_usuario,$materno_usuario,$ocupacion_usuario,$fecha_nacimiento){
	   $this->id_usuario 		= $id_usuario;
	   $this->nombre_usuario 	= $nombre_usuario;
	   $this->perfil_usuario 	= $perfil_usuario;
	   $this->clave_usuario 	= $clave_usuario;
	   $this->correo_usuario 	= $correo_usuario;
	   $this->paterno_usuario 	= $paterno_usuario;
	   $this->materno_usuario 	= $materno_usuario;
	   $this->ocupacion_usuario = $ocupacion_usuario;
	   $this->fecha_nacimiento  = $fecha_nacimiento;
   }
   //ACCESADORES
   	public function getId_Usuario()			{return $this->id_usuario;}
   	public function getNombre_Usuario()		{return $this->nombre_usuario;}
   	public function getPerfil_Usuario()		{return $this->perfil_usuario;}
 	public function getClave_Usuario()		{return $this->clave_usuario;}
	public function getCorreo_Usuario()		{return $this->correo_usuario;}
	public function getPaterno_Usuario()	{return $this->paterno_usuario;}
	public function getMaterno_Usuario()	{return $this->materno_usuario;}
	public function getOcupacion_Usuario()	{return $this->ocupacion_usuario;}
	public function getImagen_Usuario()		{return $this->imagen_usuario;}
	public function getUsuario()			{return $this->usuario;}
	public function getFecha_nacimiento()	{return $this->fecha_nacimiento;}
				
   //MUTANTES
   	public function setId_Usuario($id_usuario) 						{return $this->id_usuario=$id_usuario;}
   	public function setNombre_Usuario($nombre_usuario)       		{return $this->nombre_usuario;}
   	public function setPerfil_Usuario($perfil_usuario)     			{return $this->perfil_usuario;}
 	public function setClave_Usuario($clave_usuario)       			{return $this->clave_usuario;}
	public function setCorreo_Usuario($correo_usuario)       		{return $this->correo_usuario;}
	public function setPaterno_Usuario($paterno_usuario)       		{return $this->paterno_usuario;}
	public function setMaterno_Usuario($materno_usuario)       		{return $this->materno_usuario;}
	public function setOcupacion_usuario($ocupacion_usuario)       	{return $this->ocupacion_usuario;}
	public function setImagen_Usuario($imagen_usuario)				{return $this->imagen_usuario;}
	public function setUsuario($usuario)							{return $this->usuario;}
	public function setFecha_nacimiento($fecha_nacimiento)          {return $this->fecha_nacimiento;}

   //Crear usuario y activar su estado
	public function crearUsuario(){ 
		$objConex=new Conexion();
		$activar = 1;  //Esta variable hace que cuando es registrado se ective directamente ante el valor booleono de la BD.
		$sql="INSERT INTO usuario (nombre_usuario,perfil,password_usuario,correo_usuario,paterno_usuario,materno_usuario,imagen_usuario,ocupacion_id_ocupacion,admin,disponible,usuario,fecha_nacimiento) VALUES 
     ('".$this->nombre_usuario."',
     '".$this->perfil_usuario."',
     '".$this->clave_usuario."',
    '".$this->correo_usuario."',
    '".$this->paterno_usuario."',
    '".$this->materno_usuario."',
    '".$this->imagen_usuario."',
    ".$this->ocupacion_usuario.", 
    ".$activar.",
	".$this->disponible.",
	'".$this->usuario."',
	'".$this->fecha_nacimiento."')"; 
     $resul=$objConex->generarTransaccion($sql);
     return $resul;
   }
   	public function claveUsuario($id){
   		$id=''.$id;
   		$objConex=new Conexion();
		$sql="select password_usuario from usuario WHERE id_usuario=".$id."";
		$resul=$objConex->generarTransaccion($sql);
		$reg = mysqli_fetch_array($resul);
		$clave =$reg[0];
		return $clave;
   	}
   	//Actualizar los datos de los usuarios
	public function modificarUsuario(){ 
		$objConex=new Conexion();
		$sql="UPDATE usuario SET nombre_usuario='".$this->nombre_usuario."',perfil='".$this->perfil_usuario."',password_usuario='".$this->clave_usuario."',correo_usuario='".$this->correo_usuario."',paterno_usuario='".$this->paterno_usuario."',materno_usuario='".$this->materno_usuario."',ocupacion_id_ocupacion='".$this->ocupacion_usuario."',fecha_nacimiento ='".$this->fecha_nacimiento."' WHERE (id_usuario='".$this->id_usuario."')";
		 $resul=$objConex->generarTransaccion($sql);
		 return $resul;
	   }
	//Para actualizar password
	   public function updatePassword($id_usuario,$clave_usuario){
	   	$objConex=new Conexion();
   		$sql = "UPDATE usuario SET password_usuario='".$clave_usuario."' WHERE (id_usuario='".$id_usuario."')";
   		$resul=$objConex->generarTransaccion($sql);
		 return $resul;
	   }
	//Para dar de baja a un usuario
	   public function modificarEdoUsuario(){ 
		$objConex=new Conexion();
		$desactivar=0;
		$sql="UPDATE usuario SET admin='".$desactivar."' WHERE (id_usuario='".$this->id_usuario."')";
		 $resul=$objConex->generarTransaccion($sql);
		 return $resul;
	   }

	//Para dar de alta a un usuario
	   public function activarEdoUsuario(){ 
		$objConex=new Conexion();
		$activar_user=1;
		$sql="UPDATE usuario SET admin='".$activar_user."' WHERE (id_usuario='".$this->id_usuario."')";
		 $resul=$objConex->generarTransaccion($sql);
		 return $resul;
	   }
	   public function compruebaUsuario($usuario){
	   		 $objConex=new Conexion();//Instanciar clase Conexion
			 $sql="SELECT usuario FROM usuario  WHERE usuario='".$usuario."'";
			 $resul=$objConex->generarTransaccion($sql);
    		 $vector=mysqli_fetch_array($resul);
    		 if($vector>0){
      			return true;
    		}else{
    		return false;
    		}
	   }
	   public function compruebaCorreo($correo){
	   		 $objConex=new Conexion();//Instanciar clase Conexion
			 $sql="SELECT correo_usuario FROM usuario  WHERE correo_usuario='".$correo."'";
			 $resul=$objConex->generarTransaccion($sql);
    		 $vector=mysqli_fetch_array($resul);
    		 if($vector>0){
      			return true;
    		}else{
    			return false;
    		}
	   }

	/*public function eliminarUsuario()
	   { $objConex=new Conexion();//Instanciar clase Conexion
		 $sql="DELETE FROM usuario WHERE(id_usuario='".$this->id_usuario."')";
		 $resul=$objConex->generarTransaccion($sql);
		 return $resul;
	   }*/  
	   
	/*public function buscarUsuario()
	   { $objConex=new Conexion();//Instanciar clase Conexion
		 $sql="SELECT * FROM usuario WHERE(usuario=".$this->usuario.")";
		 $vector=$objConex->generarTransaccion($sql);
		 return $vector;
	   }*/

	/*public function buscarUsuario2(){//$id){ 
		$objConex=new Conexion();//Instanciar clase Conexion
		 $sql="SELECT * FROM usuario";  WHERE(usuario='".$id."')";
		 $vector=$objConex->generarTransaccion($sql);
		 return $vector;
	   }*/

	
	public function buscarUsuarioId($id_usuario){ 
			$objConex=new Conexion();//Instanciar clase Conexion
			 $sql="SELECT * FROM usuario u JOIN ocupacion o on u.ocupacion_id_ocupacion = o.id_ocupacion WHERE(id_usuario='".$id_usuario."')";
			 $vector=$objConex->generarTransaccion($sql);
			 return $vector;
		   }

	//Listar usuario activos
	public function listarUsuarios($where){ 
		$objConex=new Conexion();
	   	//Sólo mostrar usuarios que tengan numero 1
		$sql="SELECT * FROM usuario u JOIN ocupacion o on u.ocupacion_id_ocupacion = o.id_ocupacion WHERE admin = 1 ".$where."";
		$matrix=$objConex->generarTransaccion($sql);
		return $matrix;
	   } 
	//Listar usuario baja
	public function listarUsuariosBaja($where){ 
		$objConex=new Conexion();
	   	$desactivo_user = 0;  //Sólo mostrar alumnos que tengan numero 1
		$sql="SELECT * FROM usuario u JOIN ocupacion o on u.ocupacion_id_ocupacion = o.id_ocupacion WHERE admin = 0 ".$where."";
		$matrix=$objConex->generarTransaccion($sql);
		return $matrix;
	   }

	/*public function filtrarUsuarios($where){ 
		$objConex=new Conexion();
	   	 $sql="SELECT * FROM usuario ".$where."";
		 $matrix=$objConex->generarTransaccion($sql);
		 return $matrix;
	   }*/
	 public function buscarOcupacion($ocupacion)
	  { 
	    $objConex=new Conexion();//Instanciar clase Conexion
	    $sql="SELECT id_ocupacion FROM ocupacion WHERE (ocupacion = '".$ocupacion."')";
	    $vector=$objConex->generarTransaccion($sql);
	    return $vector;
	  }
	  public function nuevaOcupacion($ocupacion)
	  { 
	    $objConex=new Conexion();//Instanciar clase Conexion
	    $vector = $this->buscarOcupacion($ocupacion);
	    $vector=mysqli_fetch_array($vector);
	    if(!($vector>0)){
	      $sql="INSERT INTO ocupacion (ocupacion) values('".$ocupacion."')";
	      $vector=$objConex->generarTransaccion($sql);
	      return true;
	    }
	    return false;
	  }
	//Listar ocupacion para asignar a usuarios
	   public function listarOcupacion(){
	   	$objConex = new Conexion();
	   	$sql="SELECT * FROM ocupacion ";
	   	$matrix=$objConex->generarTransaccion($sql);
	   	return $matrix;
	   }
  } //clase
?>

