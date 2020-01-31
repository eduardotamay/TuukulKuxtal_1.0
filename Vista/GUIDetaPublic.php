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
    <script src="//api.html5media.info/1.2.2/html5media.min.js"></script>
    <title>Tsolilo'ob</title>
  </head>
  <body>
    <?php include('headerPublic.php');
        error_reporting(E_ALL ^ E_DEPRECATED);
        require_once '../Modelo/Genero.php';
        require_once '../Modelo/Producto.php';
        require_once '../Modelo/Comentario.php';
        require_once '../Modelo/Usuario.php';
        $objPro = new Producto();
        $objGen = new Genero();
        $objCom = new Comentario();
        $objUser = new Usuario();
        $id=$_GET['id_producto'];
        $tipo_producto=$_GET['tipo_producto'];
        // echo $id;
        // // echo "<br>";
        // echo $tipo_producto;
        $result = $objPro->buscarDetalleLibro($id);
        // $result = $objPro->buscarDetalleLibro($id);
        while ($mostrar = mysqli_fetch_array($result)){
          //Hay que listar los comentarios para verlos
    ?>
    <section>
      <div class="container main-container">
        <div class="row">
          <div class="col-12 offset-md-2 col-md-8 fila-detalle">
            <div class="col-12 titulo" align="center">
               <h5 title="Información" class="alert alert-primary" role="alert">Nu’uksaj</h5><br>
              <h3><?php echo $mostrar['titulo_producto']?></h3>
            </div>
            <div class="col-12 icono-autor">
              <div class="row fila-contenido d-flex align-items-center">
                <div class="col-4 col-md-5 colu-foto">
                  <?php
                     if ($mostrar['tipo_producto']==1) {  
                  echo "<img class='d-block w-100' src='../Imagenes/ico-audio.png' alt='1 slide'>";
                  }if ($mostrar['tipo_producto']==2) {  
                  echo "<img class='d-block w-100' src='../Imagenes/ico-video.png' alt='1 slide'>";
                  }if ($mostrar['tipo_producto']==3) {  
                  echo "<img class='d-block w-100' src='../Imagenes/ico-investigacion.png' alt='1 slide'>";
                  }if ($mostrar['tipo_producto']==4) {  
                  echo "<img class='d-block w-100' src='../Imagenes/ico-literatura.png' alt='1 slide'>";
                  }
                  ?>
                </div>
                <div class="col-8 col-md-7 colu-deta d-flex justify-content-center">
                  <div class="autor-voto">
                    <?php
                      $datos = $objGen->listarAutores();
                      while ($reg=mysqli_fetch_row($datos)) {
                        if ($reg[0]==$mostrar['autor_producto']) {
                          echo "<h6 title='Nombre autor'>Máax meyajtej: ".$reg['1']."</h6>";
                        }
                      }
                    ?>
                    <div class="contenedor">
                      <div class="post">
                        <?php
                            if (!isset($_SESSION['nombre_usuario'])){
                          ?>
                        <div class="alert alert-warning alert-dismissible fade show mensaje-voto" role="alert">
                          <a href="../GUILogin2.php" title="Inicia sesión" style="text-decoration: none;"> Káast </a> <label title="para poder votar">u ti’al u beytal a yéeya’al</label> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php
                          }
                        ?>
                        <h6 class="voto" title="Votar:">Yéeya’al: 
                          <!-- Abrir ventana y loguerse y votar -->
                          <?php
                            if (isset($_SESSION['nombre_usuario'])){
                            $objConex=new Conexion();//Instanciar clase Conexion
                            $sql = "SELECT * FROM likes WHERE id_user='".$id_usuario."' AND id_prod='".$id."' LIMIT 1";
                            $vector=$objConex->generarTransaccion($sql);
                            if ($vector) {
                              while ($row = mysqli_fetch_array($vector)) {
                                $id_v = $row['id_like'];
                                $id_u = $row['id_user'];
                                $id_p = $row['id_prod'];
                                $li_dis = $row['like_dislike'];
                              }
                                if (isset($id_p) and isset($id_u) and $li_dis==1 and isset($id_p)) {
                                echo "<a style='color:orange;' href='../Controlador/Tvotar.php?like=1&id=".$id_usuario."&pro=".$id."&tipo_producto=".$tipo_producto."'class='voto-a'>";
                                  echo "<i class='fas fa-thumbs-up like-voto'></i>";
                                echo "</a>";
                                }else{
                                  echo "<a href='../Controlador/Tvotar.php?like=1&id=".$id_usuario."&pro=".$id."&tipo_producto=".$tipo_producto."'class='voto-a'>";
                                  echo "<i class='far fa-thumbs-up like-voto disabled'></i>";
                                echo "</a>";
                                }
                              }
                          ?>
                          <?php }else{ ?>
                            <i class="far fa-thumbs-up like-voto" data-toggle="tooltip" data-placement="top" title="Inicia sesión">
                            </i>
                         <?php }?>
                          <span class='badge badge-warning badge-pill'><?php echo $mostrar['suma_like']?></span>
                          <?php 
                            if (isset($_SESSION['nombre_usuario'])){
                              $objConex=new Conexion();//Instanciar clase Conexion
                            $sql = "SELECT * FROM likes WHERE id_user='".$id_usuario."' AND id_prod='".$id."' LIMIT 1";
                            $vector=$objConex->generarTransaccion($sql);
                            if ($vector) {
                              while ($row = mysqli_fetch_array($vector)) {
                                $id_v = $row['id_like'];
                                $id_u = $row['id_user'];
                                $id_p = $row['id_prod'];
                                $li_dis = $row['like_dislike'];
                              }
                              if (isset($id_p) and isset($id_u) and $li_dis==0 and isset($id_p)) {
                                echo "<a style='color:orange;' href='../Controlador/Tvotar.php?like=0&id=".$id_usuario."&pro=".$id."&tipo_producto=".$tipo_producto."'class='voto-a'>";
                                echo "<i class='fas fa-thumbs-down dislike-voto'></i>";
                              echo "</a>";
                              }else{
                                echo "<a href='../Controlador/Tvotar.php?like=0&id=".$id_usuario."&pro=".$id."&tipo_producto=".$tipo_producto."'class='voto-a'>";
                                echo "<i class='far fa-thumbs-down dislike-voto'></i>";
                              echo "</a>";
                              }
                            }
                          ?>
                          <?php }else{
                          ?>
                            <i class="far fa-thumbs-down dislike-voto" data-toggle="tooltip" data-placement="top" title="Inicia sesión"></i>
                         <?php }?>
                          <span class="badge badge-warning badge-pill"><?php echo $mostrar['suma_dislike']?></span>
                          </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 offset-md-2 col-md-8 fila-detalle">
            <div class="col-12 cont-descrip">
              <p align="center">
              <button class="btn btn-info" type="button" title="Ver descripción" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" data-toggle="tooltip" data-placement="top" title="Ver información">
                Il Tsolt’aan
              </button>
            </p>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <?php echo $mostrar['descripcion_producto']?>
              </div>
            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 offset-md-2 col-md-8 fila-detalle">
            <div class="col-12 informacion">
              <br>
              <?php
                  if ($mostrar['tipo_producto']==1) {  
                  echo "<p title='Tipo archivo' class='tipo-arcivo'><strong>Ba’ax meyajil: </strong><i class='ico-archivo fas fa-music'></i></p>";
                  }if ($mostrar['tipo_producto']==2) {  
                  echo "<p title='Tipo archivo' class='tipo-arcivo'><strong>Ba’ax meyajil: </strong><i class='ico-archivo fab fa-youtube'></i></p>";
                  }if ($mostrar['tipo_producto']==3) {  
                  echo "<p title='Tipo archivo' class='tipo-arcivo'><strong>Ba’ax meyajil: </strong><i class='ico-archivo fas fa-book'></i></p>";
                  }if ($mostrar['tipo_producto']==4) {  
                  echo "<p title='Tipo archivo' class='tipo-arcivo'><strong>Ba’ax meyajil: </strong><i class='ico-archivo fas fa-book-open'></i></p>";
                  }
              ?>
              <?php
                $datos = $objGen->listarGeneros();
                while ($reg=mysqli_fetch_row($datos)) {
                  if ($reg[1]==$mostrar['genero']) {
                    echo "<p><strong>Género: </strong> ".$reg['1']."</p>";
                  }
                }
              ?>
              <p title="Año de creación:"><strong>Ja'ab beetanil:</strong> <?php echo date_format(date_create($mostrar['fechacreacio_producto']),"d/m/Y")?></p>
              <?php
                $datos = $objGen->listarComunidad();
                while ($reg=mysqli_fetch_row($datos)) {
                  if ($reg[0]==$mostrar["comunidad_producto"]) {
                    echo "<p title='Origen:' ><strong>Tu’uxil:</strong> ".$reg[1]."</p>";
                  }
                }
              ?>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-12 offset-md-2 col-md-8 fila-detalle">
              <div class="col-12 cont-descrip"><br>
                <h5 align="center">Reproducir Archivo</h5>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex justify-content-center">
                      <?php if($mostrar['tipo_producto']==1){ ?>
                      <audio class="me-audio" id="medio" type="audio/m4a" src=<?php echo $mostrar['link'];?> controls="" preload>
                      </audio>
                      <?php }if($mostrar['tipo_producto']==2){ ?>
                        <div class="embed-responsive embed-responsive-4by3">
                          <?php if ($mostrar['tipo_subida']=="local") {?>
                            <video preload="auto" controls="" src=<?php echo $mostrar['link'];?>></video>
                          <?php }if ($mostrar['tipo_subida']=="youtube"){?>
                            <iframe width="560" height="315" src=<?php echo $mostrar['link'];?> frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                          <?php } ?>
                        </div>
                      <?php }if ($mostrar['tipo_producto']==3 or $mostrar['tipo_producto']==4) {?>
                        <form action="../Controlador/TVisualizar.php" method="GET" enctype="multipart/form-data" accept-charset="utf-8">
                        <?php echo '<input type="number" hidden="true" id="id_producto" name="id_producto" value= "'.$id.'">' ; ?>
                        <button class="btn btn-primary" type="submit" name="Visualizar" value="Visualizar" >Visualizar<span class="glyphicon glyphicon-eye-open"></span></button>
                      </form>
                      <?php }?>
                    </div><br>
                  </div>
                </div>
            </div>
          </div>
        </div>
       <div class="row">
          <div class="col-12 offset-md-2 col-md-8 fila-detalle">
            <div class="col-12 cont-descrip"><br>
              <?php
                if (isset($_SESSION['nombre_usuario'])) {
                  $nomUser=$_SESSION['nombre_usuario'];
                  echo "<div class='card comentarios-card border-secondary mb-3'>";
                echo "<div class='card-header'>";
                  echo "<h5 align='center' title='Comentarios' >Tsikbalilo'ob</h5>";
                echo "</div>";
                echo "<div class='card-body'>";
                  echo "<form action='../Controlador/Tcomentario.php' method='POST'>";
                    echo '<input type="number"  hidden="true" id="tipo_producto" name="tipo_producto" value= "'.$mostrar['tipo_producto'].'">';
                    echo '<input type="text" name="tipo_comentario" value="publico" hidden="true">';
                    echo '<input type="number" hidden="true" id="id_producto" name="id_producto" value= "'.$mostrar['id_producto'].'">';
                    echo "<input class='form-control' type='text' value='".$nomUser."' name='nom_user' data-toggle='tooltip' data-placement='top' title='Kaaba' readonly>";
                    echo "<div class='form-group'>";
                      echo "<label for='comentario'></label>";
                      echo "<textarea class='form-control' title='Agrega tu comentario' id='comentario' rows='3' placeholder='Oksej a tsikbal' name='comentario'></textarea>";
                    echo "</div>";
                    echo "<input class='btn btn-primary' type='submit' name='OK1' value='Publicar Ahora'>";
                  echo "</form>";
                echo "</div>";
              echo "</div>";
              ?>
              <?php }
                else{ 
              ?>
              <div class='card comentarios-card border-secondary mb-3'  data-toggle="tooltip" data-placement="top" title="Inicia sesión">
                <div class='card-header'>
                  <h5 title='Comentarios' align='center'>Tsikbalilo'ob</h5>
                </div>
                <div class='card-body'>
                  <form action='../Controlador/Tcomentario.php' method='POST'>
                    <?php echo '<input type="number"  hidden="true" id="tipo_producto" name="tipo_producto" value= "'.$mostrar['tipo_producto'].'">' ; ?>
                    <?php echo '<input type="number" hidden="true" id="id_producto" name="id_producto" value= "'.$mostrar['id_producto'].'">' ; ?>
                    <input class='form-control' disabled="true" title="Usuario" type='text' placeholder="K'aaba'" name='nom_user'>
                    <div class='form-group'>
                      <label for='comentario'></label>
                      <textarea class='form-control' disabled="true" title='Agrega tu comentario' id='comentario' rows='3' placeholder='Oksej a tsikbal' name='comentario'></textarea>
                    </div>
                    <input class='btn btn-primary' type='submit' name='OK1' value="Publicar Ahora" disabled="true">
                  </form>
                </div>
              </div>
              <?php } ?>
              <?php
                $result = $objCom->mostrarComentario($mostrar['id_producto']);
                    echo "<div class='card'>";
                    echo "<div title='Comentarios' class='card-header'>";
                      echo "Tsikbalilo'ob";
                    echo "</div>";
                while ($reg=mysqli_fetch_row($result)) {
                    echo "<div class='card-body'>";
                    echo "<cite class='usuario-icon'><i class='fa fa-user-circle' aria-hidden='true'></i> ".$reg[7]." :</cite>";
                    echo   "<blockquote class='blockquote mb-0'>";
                      echo  "<p class='texto-comen'>".$reg[1]."</p>";
                        echo "<footer title='Fecha' class='blockquote-footer'>K'iinil: <cite title='Source Title'>".date_format(date_create($reg[2]),"d/m/Y")."</cite></footer>";
                      echo "</blockquote>";
                    echo "</div>";
                  }
                  echo "</div>";
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php
          }
      ?>
    </section>
    <?php include('footerPublic.php');?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
      
    </script>
  </body>
</html>