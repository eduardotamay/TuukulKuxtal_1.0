<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/Public.css">
    <link rel="stylesheet" type="text/css" href="../css/estiloDetaPublic.css">
    <link rel="stylesheet" type="text/css" href="../Bootstrap/css-bpotstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
    <!-- <script type="text/javascript" src="../js/carousel.js"></script> -->
    <title>Public</title>
  </head>
  <body>
    <?php include('headerPublic.php');
    require_once '../Datos/Conexion.php';
    $objConex=new Conexion();//Instanciar clase Conexion
        error_reporting(E_ALL ^ E_DEPRECATED);
        require_once '../Modelo/Genero.php';
        require_once '../Modelo/Producto.php';
        $objPro = new Producto();
        $objGen = new Genero();
        $id_genero=$_GET['id_genero'];
        $genero_pro=$_GET['genero'];
        $tipo_producto=$_GET['tipo_producto'];
        $nom_archivo=$_GET['archivo'];
    ?>
    <section>
      <div class="container main-container">
        <div class="row">
          <div class="col-12 offset-md-2 col-md-8 fila-detalle"><br>
            <h5 title="Lista de" class="titulo-tabla" align="center">U tsoolil <?php  echo $nom_archivo=$_GET['archivo'];?></h5>
            <?php
                if ($genero_pro!='NG') {
                  echo "<p align='center'>Género: ".$nom_archivo=$_GET['genero'];"</p>";
                }
                // AQUI HAY QUE VER QUE SE CUMPLA LA CONDICIÓN
            ?>
            <table class="table table-hover table-light">
             <!--  <thead align="center">
                  <th scope="col" class="ultimas-agregadas" style="color: black">Lista completa</th>
              </thead> -->
              <tbody align="center">
                <?php
                $sql="SELECT * FROM producto ORDER BY fechapublicacion_producto";
                    $vector=$objConex->generarTransaccion($sql); 
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==$tipo_producto && $genero_pro=='NG') {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }if(isset($_GET["id_genero"]) && $reg['estado']==1 && $reg['tipo_producto']==$tipo_producto && $reg['genero_producto']==$id_genero){
                        $g = $objGen->buscaGenero($_GET["id_genero"]);
                        $g=mysqli_fetch_array($g);
                        $genero=$g[0];
                        if (isset($_GET["where"]))
                        {
                          $where=$_GET["where"];
                        }else { 
                              $where=" ";
                      }
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }if ($reg['estado']==1 && $reg['tipo_producto']==$tipo_producto && $id_genero=='NOAPLICA') {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <?php include('footerPublic.php');?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>