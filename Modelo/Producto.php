<?php
require_once("../Datos/Conexion.php");

class Producto
{  private $id_producto;
   private $titulo_producto;
   private $descripcion_producto;
   private $fechacreacio_producto;
   private $fechapublicacion_producto;
   private $genero_producto;
   private $tipo_subida;
   private $estado;
   private $usuario_id_usuario;
   private $comunidad_producto;
   private $idioma_id_idioma;
   private $tipo_producto;
   private $autor_producto;
   private $link;
   // private $suma_like;
   // private $suma_dislike;
 
   public function __construct(){}

   public function Producto (
    $id_producto,
    $titulo_producto,
    $descripcion_producto,
    $fechacreacio_producto,
    $fechapublicacion_producto,
    $genero_producto,
    $tipo_subida,
    $estado,
    $usuario_id_usuario,
    $comunidad_producto,
    $idioma_id_idioma,
    $tipo_producto,
    $autor_producto,
    $link
    // $suma_like,
    // $suma_dislike
   )
   { 
    $this->id_producto=$id_producto;
    $this->titulo_producto=$titulo_producto;
    $this->descripcion_producto=$descripcion_producto;
    $this->fechacreacio_producto=$fechacreacio_producto;
    $this->fechapublicacion_producto=$fechapublicacion_producto;
    $this->genero_producto=$genero_producto;
    $this->tipo_subida=$tipo_subida;
    $this->estado=$estado;
    $this->usuario_id_usuario=$usuario_id_usuario;
    $this->comunidad_producto=$comunidad_producto;
    $this->idioma_id_idioma=$idioma_id_idioma;
    $this->tipo_producto=$tipo_producto;
    $this->autor_producto=$autor_producto;
    $this->link=$link;
    // $this->suma_like=$suma_like;
    // $this->suma_dislike=$suma_dislike;
    }
 

   //ACCESADORES
    public function getId_producto()                {return $this->id_producto;}
    public function getTitulo_producto()            {return $this->titulo_producto;}
    public function getDescripcion_producto()       {return $this->descripcion_producto;}
    public function getFechacreacio_producto()      {return $this->fechacreacio_producto;}
    public function getFechapublicacion_producto()  {return $this->fechapublicacion_producto;}
    public function getGenero_producto()            {return $this->genero_producto;}
    public function getTipo_subida()       {return $this->tipo_subida;}
    public function getEstado()                     {return $this->estado;}
    public function getUsuario_id_usuario()         {return $this->usuario_id_usuario;}
    public function getComunidad_producto()         {return $this->comunidad_producto;}
    public function getIdioma_id_idioma()           {return $this->idioma_id_idioma;}
    public function getTipo_producto()              {return $this->tipo_producto;}
    public function getAutor_producto()             {return $this->autor_producto;}
    public function getLink()                       {return $this->link;}
    // public function getSuma_Like()                  {return $this->suma_like;}
    // public function getSuma_Dislike()               {return $this->suma_dislike;}



   //MUTANTES
    public function setId_producto($id_producto)                            {$this->id_producto=$id_producto;}
    public function setTitulo_producto($titulo_producto)                    {$this->titulo_producto=$titulo_producto;}
    public function setDescripcion_producto($descripcion_producto)          {$this->descripcion_producto=$descripcion_producto;}
    public function setFechacreacio_producto($fechacreacio_producto)        {$this->fechacreacio_producto=$fechacreacio_producto;}
    public function setEchapublicacion_producto($fechapublicacion_producto) {$this->fechapublicacion_producto=$fechapublicacion_producto;}
    public function setGenero_producto($genero_producto)                    {$this->genero_producto=$genero_producto;}
    public function setTipo_subida($tipo_subida)                            {$this->tipo_subida=$tipo_subida;}
    public function setEstado($estado)                                      {$this->estado=$estado;}
    public function setUsuario_id_usuario($usuario_id_usuario)              {$this->usuario_id_usuario=$usuario_id_usuario;}
    public function setComunidad_producto($comunidad_producto)              {$this->comunidad_producto=$comunidad_producto;}
    public function setIdioma_id_idioma($idioma_id_idioma)                  {$this->idioma_id_idioma=$idioma_id_idioma;}
    public function setTipo_producto($tipo_producto)                        {$this->tipo_producto=$tipo_producto;}
    public function setAutor_producto($autor_producto)                      {$this->autor_producto=$autor_producto;}
    public function setLink($link)                                          {$this->link=$link;}
    // public function setSuma_Like($suma_like)                                {$this->suma_like;}
    // public function setSuma_Dislike($suma_dislike)                           {$this->suma_dislike;}

  public function ingresarProducto()
  { 
    $objConex=new Conexion();
    $sql="INSERT INTO producto
    (id_producto,
    titulo_producto,
    descripcion_producto,
    fechacreacio_producto,
    fechapublicacion_producto,
    genero_producto,
    tipo_subida,
    estado,
    usuario_id_usuario,
    comunidad_producto,
    idioma_id_idioma,
    tipo_producto,
    autor_producto,
    link) values
    (null,
    '".$this->titulo_producto."',
    '".$this->descripcion_producto."', 
    '".$this->fechacreacio_producto."',
    CURRENT_TIMESTAMP, 
    ".$this->genero_producto.",
    '".$this->tipo_subida."',
    ".$this->estado.",
    ".$this->usuario_id_usuario.",
    ".$this->comunidad_producto.",
    ".$this->idioma_id_idioma.",
    ".$this->tipo_producto.",
    ". $this->autor_producto.",
    '".$this->link."')";
    $resul=$objConex->generarTransaccion($sql);
    return $resul;
  }
   //trae cualquier tipo de producto pero le debes pasar el parametro para saber si el libro cuento poesia o leyenda
  public function listarProductos($tipo,$where)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql='SELECT * FROM producto p join autor au on p.autor_producto = au.id_autor WHERE tipo_producto='.$tipo.$where;
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }

  public function buscarProducto($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT * FROM producto WHERE(id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function buscarMisProducto($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT * FROM producto p join autor au on p.autor_producto = au.id_autor join tipo t on t.id_tipo=p.tipo_producto WHERE(estado =1 and usuario_id_usuario=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function buscarMisProductoEspera($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT * FROM producto p join autor au on p.autor_producto = au.id_autor join tipo t on t.id_tipo=p.tipo_producto WHERE(estado=0 and usuario_id_usuario=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function buscarDetalleLibro($id)
  { 
    $objConex=new Conexion();//Instanciar clase stream_context_set_option(stream_or_context, wrapper, option, value)
    $sql="SELECT 
    p.id_producto,
    au.nombre_autor,
    co.comunidad,
    p.titulo_producto,
    p.fechacreacio_producto,
    p.fechapublicacion_producto,
    p.descripcion_producto,
    g.genero,
    p.link,
    g.id_genero,
    p.tipo_producto,
    p.usuario_id_usuario,
    p.comunidad_producto,
    p.idioma_id_idioma,
    p.autor_producto,
    p.estado,
    p.suma_like,
    p.suma_dislike,
    p.tipo_subida
    from producto p join genero g on p.genero_producto=g.id_genero  join autor au on au.id_autor= p.autor_producto join comunidad co on co.id_comunidad=p.comunidad_producto  where (id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }

  public function listarProductosAdmin() //Listar productos sólo para admin con estado=1
  { 
    $objConex=new Conexion();
    $sql="SELECT 
    p.id_producto,
    au.nombre_autor,
    p.titulo_producto,
    p.fechacreacio_producto,
    p.fechapublicacion_producto,
    p.descripcion_producto,
    p.link,
    g.genero,
    g.id_genero,
    p.tipo_producto,
    t.tipo,
    p.usuario_id_usuario,
    u.nombre_usuario,
    p.usuario_id_usuario,
    p.idioma_id_idioma,
    p.autor_producto,
    p.estado,
    p.tipo_subida
    from producto p join genero g on p.genero_producto=g.id_genero  join autor au on au.id_autor= p.autor_producto join tipo t on t.id_tipo=p.tipo_producto join usuario u on u.id_usuario=p.usuario_id_usuario";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function listarProductosPorGenero($idg,$tipo,$where)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql='SELECT p.id_producto,
    p.titulo_producto,
    au.nombre_autor,
    p.descripcion_producto,
    p.fechapublicacion_producto,
    p.estado 
    FROM producto p
    join autor au on au.id_autor=p.autor_producto 
    where p.tipo_producto='.$tipo.' and p.genero_producto='.$idg.'  and estado=1'.$where;
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function listarProductosInactivos($idg,$tipo,$where)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql='SELECT p.id_producto,
    p.titulo_producto,
    au.nombre_autor,
    p.descripcion_producto,
    p.fechapublicacion_producto,
    p.estado 
    FROM producto p
    join autor au on au.id_autor=p.autor_producto 
    where p.tipo_producto='.$tipo.' and p.genero_producto='.$idg.' '.$where;
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function eliminarProducto($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="DELETE * FROM producto where (id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function modificarProducto()
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="UPDATE producto set 
    tipo_producto = ".$this->tipo_producto.",
    idioma_id_idioma = ".$this->idioma_id_idioma.",
    titulo_producto = '".$this->titulo_producto."',
    autor_producto = ".$this->autor_producto.",
    descripcion_producto = '".$this->descripcion_producto."',
    fechacreacio_producto = '".$this->fechacreacio_producto."',
    fechapublicacion_producto = '".$this->fechapublicacion_producto."',
    comunidad_producto = ".$this->comunidad_producto.",
    genero_producto = ".$this->genero_producto.",
    estado = ".$this->estado." 
    where (id_producto = ".$this->id_producto.")";
    $vector=$objConex->generarTransaccion($sql);
    return $sql;
  }
  public function linkTituloProducto($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT link,titulo_producto FROM producto where (id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function cambiarEstadoProducto($id,$estado)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="UPDATE producto set estado = ".$estado." where (id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function buscarAutor($nombre)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT id_autor FROM autor WHERE (nombre_autor = '".$nombre."')";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function buscarComunidad($nombre)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT id_comunidad FROM comunidad WHERE (comunidad = '".$nombre."')";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function inactivo($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="UPDATE producto set estado = 0 where (id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function activo($id)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="UPDATE producto set estado = 1 where (id_producto=".$id.")";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
  public function nuevoAutor($nombre)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $vector= $this->buscarAutor($nombre);
    $vector=mysqli_fetch_array($vector);
    if(!($vector>0)){
      $sql="INSERT INTO autor (nombre_autor) values('".$nombre."')";
      $vector=$objConex->generarTransaccion($sql);
      return true;
    }
    return false;
  }
  public function nuevaComunidad($nombre)
  { 
    $objConex=new Conexion();//Instanciar clase Conexion
    $vector= $this->buscarComunidad($nombre);
    $vector=mysqli_fetch_array($vector);
    if(!($vector>0)){
      $sql="INSERT INTO comunidad (comunidad) values('".$nombre."')";
      $vector=$objConex->generarTransaccion($sql);
      return true;
    }
    return false;
  }
  public function ultimoProducto(){
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT max(id_producto) FROM producto";
    $vector=$objConex->generarTransaccion($sql);
    $reg=mysqli_fetch_array($vector);
    $ultimo = $reg[0];
    return $ultimo;
  }
  
  public function listarProductosLikes(){
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT * FROM producto ORDER BY suma_like DESC LIMIT 20";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }

  public function listarProductosPubli(){
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT * FROM producto ORDER BY fechapublicacion_producto DESC LIMIT 40";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }

  public function listarProductosRecientes(){
    $objConex=new Conexion();
    $sql="SELECT * FROM producto WHERE (estado=1) ORDER BY fechapublicacion_producto DESC";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }

  public function buscarProductosPubli($where){
    $objConex=new Conexion();//Instanciar clase Conexion
    $sql="SELECT * FROM producto WHERE estado = 1 AND descripcion_producto LIKE '%$where%' OR titulo_producto LIKE '%$where%' LIMIT 50";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }

  public function buscarVotoProducto(){
    $objConex=new Conexion();
    $sql="SELECT * FROM likes";
    $vector=$objConex->generarTransaccion($sql);
    return $vector;
  }
} //clase
?>
