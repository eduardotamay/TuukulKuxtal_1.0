<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Mis archivos</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
  include('../Vista/BarraMenu.php')?>  
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header text-left">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <?php 
             
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
             
            </div>
            <div class="card-body">
              <div class="col-md-12">
              <h4 title="Mis trabajos compartidos" align="center">In meyajo'ob in ts'áamaj páay óoltbij</h4>
                <div class="row">
                  <div class="table-responsive">
                  <table class="table">
                    <tr class="active">
                      <th></th>
                      <th title="Título">Jo’olts’íib</th>
                      <th title="Autor">Máax meyajtej</th>
                      <th title="Fecha de publicacion">K’iinil ka ts’áab k’aj óoltbil</th>
                      <th title="Tipo Archivo">Ba'ax meyajil</th>
                      <th>Ver detalles</th>
                      <th></th>
                    </tr>
                  <?php
                    $result = $objPro->buscarMisProducto($id_usuario);
                    while ($reg = mysqli_fetch_array($result)){
                      echo "<tr class='warning'>";
                        echo "<td></td>";
                        echo "<td>".$reg['titulo_producto']."</td>";
                        echo "<td>".$reg['nombre_autor']."</td>";
                        echo "<td>".date_format(date_create($reg['fechapublicacion_producto']),"d/m/Y")."</td>";
                        if($reg['tipo_producto']==1){
                          echo "<td><span class='glyphicon glyphicon-music'></span></td>";
                        }elseif ($reg['tipo_producto']==2) {
                          echo "<td><span class='glyphicon glyphicon-film'></span></td>";
                        }else{
                          echo "<td><span class='glyphicon glyphicon-book'></span></td>";
                        }
                        if($reg['tipo_producto']==1 || $reg['tipo_producto']==2){
                          echo "<td><a href=GUIDetalleMultimedia.php?id_producto=".$reg[0]."&tipo=".$reg['tipo'].">Ver detalle</a></td>";
                        }else{
                          echo "<td><a href=GUIDetalleLibro.php?id_producto=".$reg[0].">Ver detalle</a></td>";
                        }
                         echo "<td title='Eliminar' ><form id='tab' action='../Controlador/TEstado.php' method='POST'>"."<input type='hidden' id='id_producto' name='id_producto' value=".$reg[0]."><button type='submit' class='btn btn-danger' name='Eliminar' value='Eliminar'>Tse'elel</button></form></td>";
                      echo "</tr>";
                    }
                  ?>
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="col-md-12">
              <h4 title="Mis trabajos en revisión" align="center">In meyajo'ob táan u yila'al waa uts</h4>
                <div class="row">
                  <div class="table-responsive">
                  <table class="table">
                    <tr class="active">
                      <th></th>
                      <th title="Título">Jo’olts’íib</th>
                      <th title="Autor">Máax meyajtej</th>
                      <th title="Fecha de publicacion">K’iinil ka ts’áab k’aj óoltbil</th>
                      <th title="Tipo Archivo">Ba'ax meyajil</th>
                      <th>Ver detalles</th>
                      <th></th>
                    </tr>
                  <?php
                    $result = $objPro->buscarMisProductoEspera($id_usuario);
                    while ($reg = mysqli_fetch_array($result)){
                      echo "<tr class='warning'>";
                        echo "<td></td>";
                        echo "<td>".$reg['titulo_producto']."</td>";
                        echo "<td>".$reg['nombre_autor']."</td>";
                        echo "<td>".date_format(date_create($reg['fechapublicacion_producto']),"d/m/Y")."</td>";
                        if($reg['tipo_producto']==1){
                          echo "<td><span class='glyphicon glyphicon-music'></span></td>";
                        }elseif ($reg['tipo_producto']==2) {
                          echo "<td><span class='glyphicon glyphicon-film'></span></td>";
                        }else{
                          echo "<td><span class='glyphicon glyphicon-book'></span></td>";
                        }
                        echo "<td><a href=GUIDetalleMultimedia.php?id_producto=".$reg[0]."&tipo=".$reg['tipo'].">Ver detalle</a></td>";
                        if($admin){echo "<td><form id='tab' action='../Controlador/TEstado.php' method='POST'>"."<input type='hidden' id='id_producto' name='id_producto' value=".$reg[0]."><button type='submit' class='btn btn-primary ' name='Activar' value='Activar'>Activar</button></form></td>";
                        }else{
                          echo "<td></td>" ;
                        }
                        
                      echo "</tr>";
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