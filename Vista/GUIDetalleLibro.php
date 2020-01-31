<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ver detalles</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>
  <body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color:#62929a;">
    <!-- Navigation-->
    <?php include('../Vista/BarraMenu.php')?>
    <!--Modelo de cerrar sesión-->
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <!-- Example DataTables Card-->
        <div class="card mb-3 col-md-offset-2 col-md-8 col-md-offset-2"  >
          <div class="card-header text-left">
            <div class="row">
            <?php
        //todo este procesos llama al objeto producto y con la funcion buscarDetalleLibro  traigo tanto todos los datos del producto como del genero
                  $id = $_GET['id_producto']; //El id == #
                  $result = $objPro->buscarDetalleLibro($id);
                  $editable=false;
                  while ($mostrar = mysqli_fetch_array($result)){
                    if($mostrar['usuario_id_usuario']==$_SESSION['id_usuario'] || $admin){
                      $editable=true;
                    }
              // echo "<a href=GUILibro.php?id_genero=".$mostrar['id_genero']."&genero=".$mostrar['genero'].">".$mostrar['genero']."</a>";
            ?>
              <div class="row">
                <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                  <div class="text-center">
                  <?php 
                    if (!$editable){
                        $datos = $objGen->listarUsuario();
                        while ($reg = mysqli_fetch_row($datos)) {
                           if($reg[0]==$mostrar['usuario_id_usuario']){
                            $cUser=$reg[1];
                           }
                        }
                    echo "<div class='alert alert-danger' role='alert'>";
                      echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                        Compartido por:<strong> " .$cUser."</strong>";  
                    echo "</div>";
                    }
                  ?>
                  </div>
                </div>
              </div>
              <div class="col-xs-offset-2 col-xs-4">
                <form action="../Controlador/TVisualizar.php" method="GET" enctype="multipart/form-data" accept-charset="utf-8">
                  <?php echo '<input type="number" hidden="true" id="id_producto" name="id_producto" value= "'.$id.'">' ; ?>
                  <button class="btn btn-primary" type="submit" name="Visualizar" value="Visualizar" >Visualizar<span class="glyphicon glyphicon-eye-open"></span></button>
                </form>
              </div>
              <div class="col-xs-offset-2 col-xs-4">
                <form action="../Controlador/TDescarga.php" method="get" enctype="multipart/form-data" accept-charset="utf-8">
                  <?php echo '<input type="number" hidden="true" id="id_producto" name="id_producto" value= "'.$id.'">' ; ?>
                  <button class="btn btn-primary" type="submit" name="Descargar" value="Descargar" >Descargar  <span class="glyphicon glyphicon-download-alt"></span></button>
                </form>
              </div>
            </div>
          </div><br>
          <!--Aqui se va poner fondo y ajustar el error con autor-->
          <div class="col-md-offset-3 col-md-6 col-md-offset-3"><!--Aqui va el formulario-->
            <form class="login100-form validate-form" action="../Controlador/TModificar.php" method="POST" accept-charset="utf-8"> <!--Formulario para update-->

            <?php echo '<input type="number" hidden="true" id="tipo_producto" name="tipo_producto" value= "'.$mostrar["tipo_producto"].'">' ; ?>
            <?php echo '<input type="number" hidden="true" id="id_producto" name="id_producto" value= "'.$id.'">' ; ?>

            <span style="color: white; font-size: 1.8em;" class="login100-form-title">
            </span>
            <div title="Título" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
              <label for="titulo"> Jo’olts’íib:</label>
              <input class="form-control" id="titulo_producto" name="titulo_producto" <?php if (!$editable){echo 'readonly';} ?> type="text" value="<?php echo $mostrar['titulo_producto']; ?>">
            </div>

            <div title="Autor" class="wrap-input100 validate-input">
              <label for="autor"> Máax meyajtej:</label>
              <input id="autor_producto" name="autor_producto" <?php if (!$editable){echo 'readonly';} ?> 
                  list="nombres" 
                  class="form-control" 
                  type="text" 
                  value="<?php echo $mostrar['nombre_autor']; ?>" >
                  <!--<input type="text" id ='i<?php echo $mostrar['nombre_autor']; ?>' name='i<?php echo $mostrar['nombre_autor']; ?>' value='<?php echo $mostrar[12];?>' hidden>-->
                      <datalist id="nombres" name="nombres">
                      <?php
                      $datos = $objGen->listarAutores();
                      while ($reg = mysqli_fetch_row($datos)) {
                          ?>
                        <option value="<?php echo $reg[1] ;?>"></option>
                        <?php
                      }               
                      ?>
                    </datalist> 
                    <?php
                      $datos = $objGen->listarAutores();
                      while ($reg = mysqli_fetch_row($datos)) {
                    ?>
                        <input type="text" id ='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' name='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' 
                        value='<?php echo preg_replace('[\s+]','', $reg[0]);?>' hidden>
                    <?php
                      }               
                    ?>
            </div>
            <div title="Idioma" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
              <label for="umaterno"> U t'aanil:</label>
              <select
                   <?php 
                    if (!$editable){
                      echo 'onmouseover="this.disabled=true;" onmouseout="this.disabled=false;"';
                  }  ?> 
                  class="form-control" id="idioma_id_idioma" name="idioma_id_idioma">
                      <?php 
                        $datos = $objGen->listarIdiomas();
                        while ($reg = mysqli_fetch_row($datos)) {
                          $selected="";
                           if($reg[0]==$mostrar['idioma_id_idioma']){
                            $selected="selected";
                           }
                          echo "<option ".$selected." value='" . $reg[0] . "'>" . $reg[0] . " | " . $reg[1] . " </option>";
                        }
                      ?>
                  </select>
            </div>
          <div title="Descripción" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <label for="descripcion_producto">Tsolt’aan:</label>
            <input id="descripcion_producto" name="descripcion_producto" <?php if (!$editable){echo 'readonly';} ?> type="text" class="form-control" 
                value="<?php echo $mostrar[6];?>">
          </div>
          <div title="Fecha de creación" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <label for="fechacreacion">K’iinil ka betabi':</label>
            <input id="fechacreacio_producto" name="fechacreacio_producto" <?php if (!$editable){echo 'readonly';} ?> type="date" class="form-control" name="fechacreacio_producto" value="<?php echo strftime('%Y-%m-%d',strtotime($mostrar['fechacreacio_producto'])); ?>">
          </div>
          <div title="Fecha de publicación" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <label for="fechapublicacion">K’iinil ka ts’áab k’ajóoltbil:</label>
            <input id="fechapublicacion_producto" name="fechapublicacion_producto" <?php if (!$editable){echo 'readonly';} ?> type="date" class="form-control" name="fechapublicacion_producto" value="<?php echo strftime('%Y-%m-%d',strtotime($mostrar['fechapublicacion_producto'])); ?>">
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <label for="uocupacion">Género:</label>
            <select id="genero_producto" name="genero_producto" 
                <?php 
                  if (!$editable){
                    echo 'onmouseover="this.disabled=true;" onmouseout="this.disabled=false;"';
                }  ?> 
                class="form-control">
                      <?php  
                      $datos = $objGen->listarGeneros();
                      while ($reg = mysqli_fetch_row($datos)) {
                        if($reg[1]==$mostrar['genero']){
                          $selected="selected";
                        }else{
                          $selected="";
                        }
                            echo "<option ".$selected." value='" . $reg[0] . "'>" . $reg[0] . " | " . $reg[1]. " </option>";
                      }
                      ?>
            </select>
          </div>
          <div>
          <?php if($admin){ ?>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" 
                class="form-control" id="estado" name="estado">
                <?php if ($mostrar['estado']==0) { ?>
                  <option value="1"> Activo</option>
                  <option selected value="0">Inactivo</option>
                <?php }else{?>
                  <option selected value="1"> Activo</option>
                  <option value="0">Inactivo</option>
                <?php } ?>
              </select>
            </div>
              <?php }else{ ?>
                <input type="text" id ="estado" name="estado"
                      value="<?php echo $mostrar['estado'] ;?>" hidden>
              <?php }?>
          </div>
          <!-- <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <label for="estado">Municipio:</label>
                <select class="form-control" id="comunidad_producto" name="comunidad_producto"
                  <?php 
                  if (!$editable){
                    echo 'onmouseover="this.disabled=true;" onmouseout="this.disabled=false;"';
                }  ?> >
                    <?php
                    $datos = $objGen->listarComunidad();
                    while ($reg = mysqli_fetch_row($datos)) {
                      echo "<option value='" . $reg[0] . "'>" . $reg[0] . " | " . $reg[1] . " </option>";
                    }
                    ?>
                  </select>
          </div> -->
          <div title="Lugar de origen" class="wrap-input100 validate-input">
                  <label for="comunidad"> Tu'uxil:</label>
                  <input class="form-control" id="comunidad_producto" name="comunidad_producto" <?php if (!$editable){echo 'readonly';} ?> 
                  list="nombres_comunidad" 
                  class="col-md-2" 
                  type="text" 
                  value="<?php echo $mostrar['comunidad']; ?>" >
                      <datalist id="nombres_comunidad" name="nombres_comunidad">
                      <?php
                      $datos = $objGen->listarComunidad();
                      while ($reg = mysqli_fetch_row($datos)) {
                          ?>
                        <option value="<?php echo $reg[1] ;?>"></option>
                        <?php
                      }               
                      ?>
                    </datalist> 
                    <?php
                      $datos = $objGen->listarComunidad();
                      while ($reg = mysqli_fetch_row($datos)) {
                    ?>
                        <input type="text" id ='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' name='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' 
                        value='<?php echo preg_replace('[\s+]','', $reg[0]);?>' hidden>
                    <?php
                      }               
                    ?>
                </div>
          <!-- <input type="number" id ="calificacio_producto" name="calificacio_producto"
                      value="" hidden> -->
          <hr class="mt-3">
              <div class="row">
                <?php if($editable){ ?>
                <div class="col-md-5 bordered"></div>
                <input class="btn btn-primary" type="submit" name="Modificar" value="Guardar Cambios" >
                <?php }?>
              </div>
        </form>
        </div>
          <div class="card-footer small text-right">
            <div class="col-md-9">
            <div class="row">
                <div class="col-md-offset-4 col-md-8">
                <hr class="mt-3">
                <div class="panel panel-default">
                  <div title="Comentarios" class="panel-heading">
                    <h3 class="panel-title"><p style="margin-bottom: 0px;!important" align="center" class="mb-0">Tsikbalilo'ob</p></h3>
                  </div>
                  <div class="panel-body">
                    <form action="../Controlador/Tcomentario.php" method="POST">
                      <textarea title="Escribe tu comentario" class="form-control" rows="2" placeholder="Ts'íib a tsikbal" name="comentario"></textarea>
                      <input type="text" name="tipo_producto" value="<?php echo $mostrar['tipo_producto'];?>" hidden="true">
                      <input type="text" name="nom_user" value="<?php echo $_SESSION['nombre_usuario'];?>" hidden="true">
                      <input type="text" name="id_producto" value="<?php echo $mostrar['id_producto'];?>" hidden="true">
                      <input type="text" name="tipo_producto" value="<?php echo $mostrar['tipo_producto'];?>" hidden="true">
                      <input type="text" name="tipo_comentario" value="revision" hidden="true">
                      <input type="text" name="detalle" value="detaLibro" hidden="true">
                      <br>
                      <button title="Enviar" type="submit"  name='OK1' value='Publicar Ahora' class="btn btn-primary">Tuxt</button>
                    </form>
                  </div>
                </div>
                  <?php
                    $result = $objCom->mostrarComentarioRevision($mostrar['id_producto']);
                    while ($reg = mysqli_fetch_row($result)) {
                      echo "<div class='panel panel-warning'>";
                        echo "<div class='panel-heading text-left'><em><h5 style='margin:0px;!important'>".$reg[7]."</h5></em></div>";
                        echo "<div class='panel-body text-justify'>";
                          echo "<h5>".$reg[1]."</h5>";
                        echo "</div>";
                      echo "</div>";
                    }
                  ?> 
                </div>
              </div>
              <?php
                } //Cierre de la lógica
              ?>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- /.content-wrapper-->
      
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="vendor/chart.js/Chart.min.js"></script>
      <script src="vendor/datatables/jquery.dataTables.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin.min.js"></script>
      <!-- Custom scripts for this page-->
      <script src="js/sb-admin-datatables.min.js"></script>
      <script src="js/sb-admin-charts.min.js"></script>
    </div>
  </body>
</html>