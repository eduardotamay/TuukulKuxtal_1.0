<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/Public.css">
    <link rel="stylesheet" type="text/css" href="../Bootstrap/css-bpotstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
    <!-- <script type="text/javascript" src="../js/carousel.js"></script> -->
    <title>Public</title>
  </head>
  <body>
  <?php
  include('headerPublic.php');
  require_once '../Datos/Conexion.php';
    $objConex=new Conexion();//Instanciar clase Conexion
        error_reporting(E_ALL ^ E_DEPRECATED);
        require_once '../Modelo/Genero.php';
        require_once '../Modelo/Producto.php';
        $objPro = new Producto();
        $objGen = new Genero();
        if (isset($_GET["where"]))
      {
        $where=$_GET["where"];
      }
      else {
        $where=" ";
      }
  ?>
  
  <!--Carousel con items -->
    <section class="d-none d-md-block">
      <div class="container carousel">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="8000">
          <h5 title="Archivos recientes" class="titulo-reciente">Túumben meyajo’ob</h5>
          <div class="carousel-inner">
                  <?php
                echo "<div class='carousel-item active'>";
                  echo  "<div class='row'>";
                  $vector=$objPro->listarProductosRecientes(); 
                  $vueltas=0;
                 while ($reg = mysqli_fetch_array($vector) and $vueltas<=4){
                  if ($reg['estado']==1 && $reg['tipo_producto']==1) {  
                  echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro data-toggle='tooltip' data-placement='top' title='Más información...'' src='../Imagenes/ico-audio.png' alt='1 slide'></a>";
                  }if ($reg['estado']==1 && $reg['tipo_producto']==2) {
                   echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro data-toggle='tooltip' data-placement='top' title='Más información...'' src='../Imagenes/ico-video.png' alt='1 slide'></a>";
                  }if ($reg['estado']==1 && $reg['tipo_producto']==3) {
                    echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro data-toggle='tooltip' data-placement='top' title='Más información...'' src='../Imagenes/ico-investigacion.png' alt='1 slide'></a>";
                  }if ($reg['estado']==1 && $reg['tipo_producto']==4) {
                   echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro data-toggle='tooltip' data-placement='top' title='Más información...'' src='../Imagenes/ico-literatura.png' alt='1 slide'></a>";
                  }
                    echo "<div class='carousel-caption d-none d-md-block'>";
                      echo "<div class='row d-none d-md-block texto'>";
                        echo "<div class='col-12 texto-cuadro'>". $reg['titulo_producto']."</div>";
                        $datos = $objGen->listarAutores();
                      while ($aut=mysqli_fetch_row($datos)) {
                        if ($aut[0]==$reg['autor_producto']) {
                        // echo "<div class='col-12 texto-cuadro'>Autor: ". $aut['1']."</div>"; 
                        }
                      }
                      echo "<div class='col-12 texto-cuadro' title='Fecha:' >K’iinil: ". date_format(date_create($reg['fechapublicacion_producto']),'d/m/Y')."</div>";
                    echo"</div>";
                  echo "</div>";
                  echo "</div>";
                  $vueltas ++;
                  }
              echo  "</div>";
            echo "</div>";
             echo "<div class='carousel-item'>";
              echo "<div class='row'>";
            while ($reg = mysqli_fetch_array($vector)){
              if ($vueltas<=9) {
                if ($reg['estado']==1 && $reg['tipo_producto']==1) {  
                  echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro' src='../Imagenes/ico-audio.png' alt='1 slide'></a>";
                  }if ($reg['estado']==1 && $reg['tipo_producto']==2) {
                    echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro' src='../Imagenes/ico-video.png' alt='1 slide'></a>";
                  }if ($reg['estado']==1 && $reg['tipo_producto']==3) {
                    echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro' src='../Imagenes/ico-investigacion.png' alt='1 slide'></a>";
                  }if ($reg['estado']==1 && $reg['tipo_producto']==4) {
                    echo "<div class='col-sm'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']."><img class='d-block w-100 imagen-cuadro' src='../Imagenes/ico-literatura.png' alt='1 slide'></a>";
                  }
                    echo "<div class='carousel-caption d-none d-md-block'>";
                      echo "<div class='row d-none d-md-block texto'>";
                        echo "<div class='col-12 texto-cuadro'> ". $reg['titulo_producto']."</div>";
                        $datos = $objGen->listarAutores();
                      while ($aut=mysqli_fetch_row($datos)) {
                        if ($aut[0]==$reg['autor_producto']) {
                        // echo "<div class='col-12 texto-cuadro'>Autor: ". $aut['1']."</div>"; 
                        }
                      }
                      echo "<div class='col-12 title='Fecha:' texto-cuadro'>K'iinil: ". date_format(date_create($reg['fechapublicacion_producto']),'d/m/Y')."</div>";
                    echo"</div>";
                  echo "</div>";
                  echo "</div>";
                    }//if
                  $vueltas ++;
                  }//while
              echo "</div>";
            echo "</div>";
                  echo "<br>";
                  // echo "<p style='color:white;'>".$vueltas."</p>";
                 ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section><br>
    <!-- Aparece mensaje cuando se hace una busqueda -->
    <?php
      if (isset($_GET["where"])){
        echo "<section>";
        echo "<div class='container'>";
          echo "<div class='row'>";
            echo "<div class='col-12 offset-md-2 col-md-8'>";
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                echo "<strong><p class='bMensaje' align='center'>".$_GET["where"]."</p></strong>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                  echo "<span aria-hidden='true'>&times;</span>";
                echo "</button>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</section>";
      }
    ?>
    <!-- Seccion de literatura -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-8 reciente-col">
            <p class="titulo-tabla" title="Literatura - últimos trabajos agregados" align="center">Ts’íibil t’aano’ob - u ts'ook meyaj na'aksa'ano'ob</p>
            <table class="table table-hover table-light">
              <tbody align="center">
                <?php
                if ($where=='') {
                  $vector=$objPro->listarProductosPubli(); 
                   while ($reg = mysqli_fetch_array($vector)){
                      if ($reg['estado']==1 && $reg['tipo_producto']==4) {
                        echo "<tr>";
                        echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                        echo "</tr>";
                      }
                    }
                }else if ($where!='') {
                    $vector=$objPro->buscarProductosPubli($where); 
                     while ($reg = mysqli_fetch_array($vector)){
                        if ($reg['estado']==1 && $reg['tipo_producto']==4) {
                          echo "<tr>";
                          echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                          echo "</tr>";
                        }
                  }
                }
                 ?>
              </tbody>
            </table>
            <div title="Literaturas recientes" class="archivos-recie">
              <a href="listaArchivos.php?tipo_producto=4&id_genero=''&genero=NG&archivo=Literatura tradicional maya" style='text-decoration: none; color: white;'><i class="fas fa-plus-square"></i>
              <p>Túumben ts’íibil t’aano’ob</p></a>
            </div>
          </div>
          <div class="col-12 col-md-4 destaca-col">
            <h4 title='Trabajos destacados' align="center" class="titulo-destacado">Ma’alob noj meyajo’ob</h4><br>
            <?php
              $vector=$objPro->listarProductosLikes();
              while ($mostrar=mysqli_fetch_array($vector)) {
                if ($mostrar['estado']==1 && $mostrar['tipo_producto']==4) {
                  echo "<div class='row justify-content-center'>";
                  echo "<div class='col-8 like'>";
                      echo "<div class='col-12 caja-titulo'>";
                      echo "<a class='link-like' href=GUIDetaPublic.php?id_producto=".$mostrar['id_producto']."&tipo_producto=".$mostrar['tipo_producto']." style='text-decoration:none;color:white;'><i class='fas musica fa-book-open'></i>".$mostrar['titulo_producto']."</a>";
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='col-4 like'>";
                      echo "<div class='col-12 caja-like'>";
                        echo "<i class='far likes fa-thumbs-up'></i><span class='badge badge-warning badge-pill like-badge'>".$mostrar['suma_like']."</span>";
                        echo "<i class='far likes fa-thumbs-down'></i> <span class='badge badge-warning badge-pill'>".$mostrar['suma_dislike']."</span>";
                      echo "</div>";
                  echo "</div>";
                echo "</div>";
                }
              }
            ?>
          </div>
        </div>
      </div>
    </section><br>
    <!-- Seccion de Investigación -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-8 reciente-col">
            <p class="titulo-tabla" title="Investigación - últimos trabajos agregados" align="center">Noj xaak’al tsíib - u ts'ook meyaj na'aksa'ano'ob</p>
            <table class="table table-hover table-light">
              <tbody align="center">
                <?php
                if ($where=='') {
                $vector=$objPro->listarProductosPubli(); 
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==3) {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                } else if ($where!='') {
                 $vector=$objPro->buscarProductosPubli($where);
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==3) {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                }
                 ?>
              </tbody>
            </table>
            <div class="archivos-recie" title="Investigaciones recientes">
              <a href="listaArchivos.php?tipo_producto=3&id_genero=''&genero=NG&archivo=Investigación" style='text-decoration: none; color: white;'><i class="fas fa-plus-square"></i>
              <p>Túumben noj xaak’al tsíibo'ob</p></a>
            </div>
          </div>
          <div class="col-12 col-md-4 destaca-col">
          <h4 title='Trabajos destacados' align="center" class="titulo-destacado">Ma’alob noj meyajo’ob</h4><br>
            <?php
              $vector=$objPro->listarProductosLikes();
              while ($mostrar=mysqli_fetch_array($vector)) {
                if ($mostrar['estado']==1 && $mostrar['tipo_producto']==3) {
                  echo "<div class='row justify-content-center'>";
                  echo "<div class='col-8 like'>";
                      echo "<div class='col-12 caja-titulo'>";
                        echo "<a class='link-like' href=GUIDetaPublic.php?id_producto=".$mostrar['id_producto']."&tipo_producto=".$mostrar['tipo_producto']." style='text-decoration:none;color:white;'><i class='fas musica fa-book-open'></i>".$mostrar['titulo_producto']."</a>";
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='col-4 like'>";
                      echo "<div class='col-12 caja-like'>";
                        echo "<i class='far likes fa-thumbs-up'></i><span class='badge badge-warning badge-pill like-badge'>".$mostrar['suma_like']."</span>";
                        echo "<i class='far likes fa-thumbs-down'></i><span class='badge badge-warning badge-pill'>".$mostrar['suma_dislike']."</span>";
                      echo "</div>";
                  echo "</div>";
                echo "</div>";
                }
              }
            ?>
          </div>
        </div>
      </div>
    </section><br>
    <!-- Sección de videos-->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-8 reciente-col">
            <p title="Videos - ultimos trabajos agregados" class="titulo-tabla" align="center">Tabsaj cha’an - u ts'ook meyaj na'aksa'ano'ob</p>
            <table class="table table-hover table-light">
              <tbody align="center">
                <?php
                if ($where=='') {
                  $vector=$objPro->listarProductosPubli();  
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==2) {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                } else if ($where!='') {
                $vector=$objPro->buscarProductosPubli($where);  
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==2) {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                }
                 ?>
              </tbody>
            </table>
            <div title="Videos recientes" class="archivos-recie">
              <a href="listaArchivos.php?tipo_producto=2&id_genero=''&genero=NG&archivo=Videos" style='text-decoration: none; color: white;'><i class="fas fa-plus-square"></i>
              <p>Túumben tabsaj cha’ano'ob</p></a>
            </div>
          </div>
          <div class="col-12 col-md-4 destaca-col">
          <h4 title='Trabajos destacados' align="center" class="titulo-destacado">Ma’alob noj meyajo’ob</h4><br>
            <?php
              $vector=$objPro->listarProductosLikes();
              while ($mostrar=mysqli_fetch_array($vector)) {
                if ($mostrar['estado']==1 && $mostrar['tipo_producto']==2) {
                  echo "<div class='row justify-content-center'>";
                  echo "<div class='col-8 like'>";
                      echo "<div class='col-12 caja-titulo'>";
                        echo "<a class='link-like' href=GUIDetaPublic.php?id_producto=".$mostrar['id_producto']."&tipo_producto=".$mostrar['tipo_producto']." style='text-decoration:none;color:white;'><i class='fas musica fa-book-open'></i>".$mostrar['titulo_producto']."</a>";
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='col-4 like'>";
                      echo "<div class='col-12 caja-like'>";
                        echo "<i class='far likes fa-thumbs-up'></i> <span class='badge badge-warning badge-pill like-badge'>".$mostrar['suma_like']."</span>";
                        echo "<i class='far likes fa-thumbs-down'></i><span class='badge badge-warning badge-pill'>".$mostrar['suma_dislike']."</span>";
                      echo "</div>";
                  echo "</div>";
                echo "</div>";
                }
              }
            ?>
          </div>
        </div>
      </div>
    </section><br>
    <!-- Seccion de audios -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-8 reciente-col">
            <p title="Audios - últimos trabajos agregados" class="titulo-tabla" align="center">Tabsaj u’uyaj - u ts'ook meyaj na'aksa'ano'ob</p>
            <table class="table table-hover table-light">
              <tbody align="center">
                <?php
                if ($where=='') {
                  $vector=$objPro->listarProductosPubli(); 
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==1) {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                } else if ($where!='') {
               $vector=$objPro->buscarProductosPubli($where);  
                 while ($reg = mysqli_fetch_array($vector)){
                    if ($reg['estado']==1 && $reg['tipo_producto']==1) {
                      echo "<tr>";
                      echo "<th scope='row'><a href=GUIDetaPublic.php?id_producto=".$reg['id_producto']."&tipo_producto=".$reg['tipo_producto']." style='text-decoration: none;'>".$reg['titulo_producto']."</a></th>";
                      echo "</tr>";
                    }
                  }
                }
                 ?>
              </tbody>
            </table>
            <div title="Audios recientes" class="archivos-recie">
              <a href="listaArchivos.php?tipo_producto=1&id_genero=''&genero=NG&archivo=Audios" style='text-decoration: none; color: white;'><i class="fas fa-plus-square"></i>
              <p>Túumben tabsaj u’uyajo'ob</p></a>
            </div>
          </div>
          <div class="col-12 col-md-4 destaca-col">
            <h4 title='Trabajos destacados' align="center" class="titulo-destacado">Ma’alob noj meyajo’ob</h4><br>
            <?php
              $vector=$objPro->listarProductosLikes();
              while ($mostrar=mysqli_fetch_array($vector)) {
                if ($mostrar['estado']==1 && $mostrar['tipo_producto']==1) {
                  echo "<div class='row justify-content-center'>";
                  echo "<div class='col-8 like'>";
                      echo "<div class='col-12 caja-titulo'>";
                        echo "<a class='link-like' href=GUIDetaPublic.php?id_producto=".$mostrar['id_producto']."&tipo_producto=".$mostrar['tipo_producto']." style='text-decoration:none;color:white;'><i class='fas musica fa-book-open'></i>".$mostrar['titulo_producto']."</a>";
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='col-4 like'>";
                      echo "<div class='col-12 caja-like'>";
                        echo "<i class='far likes fa-thumbs-up'></i> <span class='badge badge-warning badge-pill like-badge'>".$mostrar['suma_like']."</span>";
                        echo "<i class='far likes fa-thumbs-down'></i> <span class='badge badge-warning badge-pill'>".$mostrar['suma_dislike']."</span>";
                      echo "</div>";
                  echo "</div>";
                echo "</div>";
                }
              }
            ?>
          </div>
        </div>
      </div>
    </section><br>
    
    <?php include('footerPublic.php');?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>