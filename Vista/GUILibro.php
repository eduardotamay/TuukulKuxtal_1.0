<!DOCTYPE html>
	<html>
		<head>
		  <meta http-equiv="content-type" content="text/html; charset=utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <meta name="description" content="">
		  <meta name="author" content="">
		  <title>Libros</title>
		  <!-- Bootstrap core CSS-->
		  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		  <!-- Custom fonts for this template-->
		  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		  <!-- Custom styles for this template-->
		  <link href="css/sb-admin.css" rel="stylesheet">
		</head>
    <body>
        <?php include('../Vista/BarraMenu.php');

        if(isset($_GET["id_genero"])){
        	$g = $objGen->buscaGenero($_GET["id_genero"]);
			$g=mysqli_fetch_array($g);
			$genero=$g[0];
			if (isset($_GET["where"]))
			{
				$where=$_GET["where"];
			}else {	
        		$where=" ";
			}
        	?> 
			<div class="container">
	            <div class="row">
				 	<h3 title="Libros" align="center">Ánalte’ob</h3>
	                <div class="col-md-12">
						<form id="filtros" action="../Controlador/TProducto.php" method="GET">
							<div class="col-md-3">
								<div title="Título" class="form-group">
									<label for="titulo_producto">Jo’olts’íib :</label>
									<input type="text" class="form-control" id="titulo_producto" placeholder="Jo’olts’íib" name="titulo_producto">
									<input type="number" value="<?php echo $_GET["id_genero"] ; ?>" id="id_genero" name="id_genero" hidden>
									<input type="text" value="<?php echo $genero; ?>" id="genero" name="genero" hidden>
								</div>
							</div>
							<div title="Autor" class="col-md-3">  
				                <div class="form-group">
				                <label for="autor_producto">Máax meyajtej</label>
				                <input class="form-control"  placeholder="Máax meyajtej" id="autor_producto" name="autor_producto"
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
									<label for="fechapublicacion_producto">K'iinil</label>
									<input type="date" class="form-control" id="fechapublicacion_producto" name="fechapublicacion_producto">
								</div>
							</div>
							<div class="col-md-3">
								<div title="Buscar" class="form-group">
									<label for="Buscar"></br></label>
									<button type="submit" class="btn btn-primary form-control" name="Buscar" value="Buscar">Kaxan</button>
								</div>
							</div>
						</form> 
					</div>
					<div class="card-body">
						<div class="col-md-12">
							<center><h3 title="Lista de" >Tsoolil <?php echo $genero; ?></h3></center>
							<div class="row">
								<div class="table-responsive">
									<table class="table">
										<tr class="active">
											<th></th>
											<th title="Título">Jo’olts’íib</th>
                      <th title="Autor">Máax meyajtej</th>
											<th title="Descripción">Tsolt’aan</th>
											<th title="Fecha de publicacion">K’iinil ka ts’áab k’ajóoltbil</th>
											<th>Ver detalles</th>
											<th></th>
										</tr>
				
							<?php 
								$idg = $_GET['id_genero']; //El id == #	
								require_once '../Modelo/Producto.php';
				                
				                $tipo=4;
				                if($idg==5 || $idg==8){
				                	$tipo=3;
				                }
				                $result = $objPro->listarProductosPorGenero($idg,$tipo,$where);
				                while ($reg = mysqli_fetch_array($result)){
			                  
		                  
										echo "<tr class='warning'>";
											echo "<td></td>";
											echo "<td>".$reg[1]."</td>";
											echo "<td>".$reg[2]."</td>";
											echo "<td>".$reg[3]."</td>";
											echo "<td>".date_format(date_create($reg[4]),"d/m/Y")."</td>";
											echo "<td><a href=GUIDetalleLibro.php?id_producto=".$reg[0].">Ver detalle</a></td>";
											if($admin and $reg['estado']==0){
												echo "<td><form id='tab' action='../Controlador/TEstado.php' method='POST'>"."
												<input type='hidden' id='id_producto' name='id_producto' value=".$reg[0].">
		                    				<input type='hidden' id='id_genero' name='id_genero' value=".$_GET['id_genero'].">
		                    				<input type='hidden' id='genero' name='genero' value=".$genero.">
		                    				<button type='submit' class='btn btn-primary ' name='Activar1' value='Activar1'>Activar</button></form></td>";
		                    				}
		                    				if($admin and $reg['estado']==1){
		                    				echo "<td><form id='tab' action='../Controlador/TEstado.php' method='POST'>"."
		                    				<input type='hidden' id='id_producto' name='id_producto' value=".$reg[0].">
		                    				<input type='hidden' id='id_genero' name='id_genero' value=".$_GET['id_genero'].">
		                    				<input type='hidden' id='genero' name='genero' value=".$genero.">
		                    				<button title='Eliminar' type='submit' class='btn btn-danger' name='Eliminar1' value='Eliminar1'>Tse’elel</button></form></td>";
		                    				}
		                    				if(!$admin){
		                    				echo"<td></td>";}
										echo "</tr>";
									}
									?>
									</table>
								</div>
							</div>
						</div>
	               </div>
	            </div>
	        </div>
    
   			<?php 
		} else {
    		?>
		<div class="container">
            <div class="row">
			 	<h3 align="center">GENERO NO PUENE VENIR VACIO</h3>
			 	<br/>
			 	<h3 align="center">Elija una opcion en el menú</h3>
            </div>
        </div>
		<?php 
			}
		?>
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