<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Multimedia</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php
  include('../Vista/BarraMenu.php')?>  
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header text-left">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <?php 
              $id_tipo=$_GET['id_tipo']; 
              $tipo=$_GET['tipo']; 
              if (isset($_GET["where"]))
              {
                $where=$_GET["where"];
              }
              else {
                if($admin){
                  $where="";
                }
                else{
                  $where=" and estado=1";
                } 
              }
            ?>
            <div class="col-md-12">
            <form id="filtros" action="../Controlador/TProducto.php" method="GET">
              <div class="col-md-3">
                <div title="Título" class="form-group">
                  <label for="titulo_producto">Jo’olts’íib :</label>
                  <input type="text" class="form-control" id="titulo_producto" placeholder="Jo’olts’íib" name="titulo_producto">
                  <input type="number" value="<?php echo $_GET["id_tipo"] ; ?>" id="id_tipo" name="id_tipo" hidden>
                  <input type="text" value="<?php echo $tipo; ?>" id="tipo" name="tipo" hidden>
                </div>
              </div>
              <div title="Autor" class="col-md-3">  
                        <div class="form-group">
                        <label for="autor_producto">Máax meyajtej :</label>
                        <input placeholder="Máax meyajtej" class="form-control"  id="autor_producto" name="autor_producto"
                        list="nombres" 
                        type="text" 
                        value="" >
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
                      </div>
              <div class="col-md-3">
                <div title="Fecha" class="form-group">
                  <label for="fechapublicacion_producto">K'iinil :</label>
                  <input type="date" class="form-control" id="fechapublicacion_producto" name="fechapublicacion_producto">
                </div>
              </div>
              <div class="col-md-3">
                <div title="Buscar" class="form-group">
                  <label for="Buscar"></br></label>
                  <button type="submit" class="btn btn-primary form-control" name="Buscar2" value="Buscar2">Kaxan</button>
                </div>
              </div>
            </form>  
          </div>
            <div class="card-body">
              <div class="col-md-12">
              <center><h3 title="Lista de" ><?php echo "<strong> Tsoolil ".$tipo."</strong>"; ?></h3></center>
                <div class="row">
                  <div class="table-responsive">
                  <table class="table">
                    <tr class="active">
                      <th></th>
                      <th title="Título">Jo’olts’íib</th>
                      <th title="Autor">Máax meyajtej</th>
                      <th title="Fecha de publicacion">K’iinil ka ts’áab k’ajóoltbil</th>
                      <th title="Tipo Archivo">Ba'ax meyajil</th>
                      <th>Ver detalles</th>
                      <th></th>
                    </tr>
                  <?php
                    $result = $objPro->listarProductos($id_tipo,$where);
                    while ($reg = mysqli_fetch_array($result)){
                        if ($reg['estado']==1) {
                         
                        
                        echo "<tr class='warning'>";
                        echo  "<td></td>";
                        echo  "<td>".$reg['titulo_producto']."</td>";
                        echo  "<td>".$reg['nombre_autor']."</td>";
                        echo  "<td>".date_format(date_create($reg['fechapublicacion_producto']),"d/m/Y")."</td>";
                        if($reg['tipo_producto']==1){
                          echo "<td><span class='glyphicon glyphicon-music'></span></td>";
                        }elseif ($reg['tipo_producto']==2) {
                          echo "<td><span class='glyphicon glyphicon-film'></span></td>";
                        }
                        echo  "<td><a href=GUIDetalleMultimedia.php?id_producto=".$reg[0]."&tipo=".$tipo.">Ver detalle</a></td>";
                        if($admin and $reg['estado']==1){
                        echo  "<td><form id='tab' action='../Controlador/TEstado.php' method='POST'>"."
                                <input type='hidden' id='id_producto' name='id_producto' value=".$reg[0].">
                                <input type='hidden' id='tipo_producto' name='tipo_producto' value=".$reg['tipo_producto'].">
                                <button title='Eliminar' type='submit' class='btn btn-danger' name='Eliminar' value='Eliminar'>Tse'elel</button></form></td>";
                        }else{
                        echo  "<td></td>";
                        }                  //Aqui no se hace la eliminación
                      echo "</tr>";
                      }
                    }
                  ?>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="card-footer small text-right">
            <div class="col-md-9">
              <?php
              //  echo "<a href=GUIMultimedia.php?id_tipo=".$id_tipo."&tipo=".$tipo.">Regresar</a>";
              ?>
            </div>
          </div>
        </div>
      </div>
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