<?php
require_once("../Datos/Conexion.php");

class Genero
{  private $id_genero;
   private $genero;
   
   public function __construct(){}
   
   public function Genero ($id_genero ,$genero)
   { 
    $this->id_genero=$id_genero;
    $this->genero=$genero;

   }
   

   //ACCESADORES
    public function getId_genero()        {return $this->id_genero;}
    public function getGenero()        {return $this->genero;}
  

   //MUTANTES
    public function setId_genero($id_genero)                { $this->id_genero=$id_genero;}
    public function setGenero($genero)                   { $this->genero=$genero;}
   

   //trae cualquier tipo de producto pero le debes pasar el parametro para saber si el libro cuento poesia o leyenda
   public function listarGeneros()
   { $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT * FROM genero ";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   } 
   public function listarTipos()
   { $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT * FROM tipo ";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   }
public function listarComunidad()
   { $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT * FROM comunidad";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   }
   public function listarAutores()
   { $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT * FROM autor ";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   }
    public function listarIdiomas()
   { $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT * FROM idioma ";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   }
   public function buscaGenero($id)
   { $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT genero FROM genero where (id_genero=".$id.")";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   }
   public function listarUsuario(){
    $objConex=new Conexion();//Instanciar clase Conexion
     $sql="SELECT * FROM usuario";
     $vector=$objConex->generarTransaccion($sql);
     return $vector;
   }
   

  } //clase
?>
