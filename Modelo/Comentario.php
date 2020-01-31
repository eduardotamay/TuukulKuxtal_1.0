<?php  
require_once("../Datos/Conexion.php");

class Comentario{
		//private $id_comentario;
		private $nom_user;
		private $comentario;
      private $id_usuario;
      private $id_producto;
      private $tipo_comentario;
	
	public function __construct(){}

	public function Comentario($comentario,$id_usuario,$id_producto,$tipo_comentario){
		//$this->id_comentario 	= $id_comentario;
	   	// $this->nom_user 		= $nom_user;
	   	$this->comentario     = $comentario;
         $this->id_usuario    = $id_usuario;
         $this->id_producto   =$id_producto;
         $this->tipo_comentario   =$tipo_comentario;
         
	}

	//ACCESADORES
   	//public function getId_Comentario()	{return $this->id_comentario;}
   	public function getNom_User()		{return $this->nom_user;}
   	public function getComentario()		{return $this->comentario;}
      public function getIdUsuario()     {return $this->id_usuario;}
      public function getIdProducto()     {return $this->id_producto;}
      public function getTipo_Comentario()     {return $this->tipo_comentario;}

   	//MUTANTES
   	// public function setId_Comentario($id_comentario) 				{return $this->id_comentario=$id_comentario;}
   	public function setNom_User($nom_user)       					{return $this->nomb_user;}
   	public function setComentario($comentario)     					{return $this->comentario;}
      public function setId_Usuario($id_usuario)                  {return $this->id_usuario;}
      public function setId_Producto($id_producto)                {return $this->id_producto;}
      public function setTipo_Comentario($tipo_comentario)        {return $this->tipo_comentario;}


   	public function insertarComentario($comentario,$id_usuario,$id_producto,$tipo_comentario){
         $objConex=new Conexion();
         $sql="INSERT INTO comentario (comentario,fecha_comen,id_usuario,id_producto,tipo_comentario) VALUES ('".$this->comentario."',CURRENT_TIMESTAMP,'".$this->id_usuario."','".$this->id_producto."','".$this->tipo_comentario."')";
   		$resul=$objConex->generarTransaccion($sql);
   		return $resul;
   	}

      public function mostrarComentario($id_producto){
         $objConex=new Conexion();
         $sql="SELECT * FROM comentario co JOIN usuario us on co.id_usuario=us.id_usuario WHERE (id_producto='".$id_producto."' AND tipo_comentario='publico')";
         $result=$objConex->generarTransaccion($sql);
         return $result;
      }

      public function mostrarComentarioRevision($id_producto){
         $objConex=new Conexion();
         $sql="SELECT * FROM comentario co JOIN usuario us on co.id_usuario=us.id_usuario WHERE (id_producto='".$id_producto."' AND tipo_comentario='revision')";
         $result=$objConex->generarTransaccion($sql);
         return $result;
      }
      
      public function compruebaUsuario($nom_user){
          $objConex=new Conexion();//Instanciar clase Conexion
          $sql="SELECT * FROM usuario  WHERE nombre_usuario='".$nom_user."'";
          $resul=$objConex->generarTransaccion($sql);
          $vector=mysqli_fetch_array($resul);
          if($vector>0){
               return true;
         }else{
         return false;
         }
      }

      // public function obtenerIdUsuario($nom_user,$id_usuario){
      //    $objConex=new Conexion();
      //    $sql="SELECT * FROM usuario  WHERE nombre_usuario='".$nom_user."'";
      //    $result=$objConex->generarTransaccion($sql);
      //    while ($mostrar = mysqli_fetch_array($result)) {
      //       $id_usuario==$mostrar['id_usuario'];
      //       return $id_usuario;
      //    }
      // }

}//Clase
?>