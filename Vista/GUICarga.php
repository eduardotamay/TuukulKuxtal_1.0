<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta charset="utf-8">
  		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <title>Cargar Archivo</title>
    </head>
	<body>
	<?php include('../Vista/BarraMenu.php');
	if(isset($_GET["id_tipo"])){
		$tipo=$_GET["id_tipo"];
	}else{
		$tipo=1;
	}

	?>
	<script type="text/javascript" async>
		function cambio(){
			var tipo = document.getElementById("tipo_producto").value;
			window.location="../Vista/GUICarga.php?id_tipo="+tipo+"" ;
		}
	</script>
	</script>
		<div class="container">
			<div class="row">
				<center><h3 title="Cargar trabajo">Na'aks noj meyaj</h3></center><br/>
				<div class="col-md-1"></div>		
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-10" style="background-color: rgba(0,0,0,0.2);">
							<?php  
								if ($tipo==2) {
							?>
							<div class="row">
								<div class='alert alert-warning alert-dismissible text-center' role='alert' style="margin-bottom: 0px;background-color: #363434;border:0px;">
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' class='btn-cerrar' style="color: yellow;">&times;</span></button>
									  	<a title="Ver tutorial para subir video" style="text-decoration: none; cursor: pointer;color: white;" data-toggle="modal" data-target=".bs-example-modal-md">Il tabsaj cha'an ti'al a na'axik a noj meyaj <span class="glyphicon glyphicon-film"></span></a>
										<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
											<div class="modal-dialog modal-md" role="document">
												<div class="modal-content">
													<div class="embed-responsive embed-responsive-16by9">
  														<iframe width="560" height="315" src="https://www.youtube.com/embed/Ha-acLp2344" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>
							<?php } ?>
							<form enctype="multipart/form-data" id="tab1" action="../Controlador/TProducto.php" method="POST">
								<div title="Tipo trabajo" class="form-group">
									<br/>
									<label style="color: white" for="tipo_producto">Ba'ax mejail</label>
										<select class="form-control" id="tipo_producto" name="tipo_producto" onchange="cambio()">
										<?php
										$datos = $objGen->listarTipos();
										while ($reg = mysqli_fetch_row($datos)) {
											if($tipo==$reg[0]){
											echo "<option selected value='" . $reg[0] . "'>" . $reg[0] . " | " .$reg[1]. " </option>";
											}else{
												echo "<option value='" . $reg[0] . "'>" . $reg[0] . " | " .$reg[1]. " </option>";
											}
										}
									?>
									</select>
								</div>
								<div class="form-group">
									<label style="color: white" for="genero_producto">Genero:</label>
									<select class="form-control" id="genero_producto" name="genero_producto">';
										<?php  
										$datos = $objGen->listarGeneros();
										$cont=0;
										while ($reg = mysqli_fetch_row($datos)) {
											if($tipo==4){
												if($reg[0]!=5 and $reg[0]!=8 and $reg[0]!=16 and $reg[0]!=17){
													$cont+=1;
													echo "<option  value='" . $reg[0] . "'>" .$cont . " | " .$reg[1]. " </option>";
												}
											}elseif ($tipo==3) {
												if($reg[0]==5 or $reg[0]==8){
													$cont+=1;
													echo "<option  value='" . $reg[0] . "'>" . $cont . " | " .$reg[1]. " </option>";	
												}
											}elseif ($tipo==1) {
												if($reg[0]!=5 and $reg[0]!=8 and $reg[0]!=16){
													$cont+=1;
													echo "<option  value='" . $reg[0] . "'>" . $cont . " | " .$reg[1]. " </option>";	
												}
											}else{
												if($reg[0]!=5 and $reg[0]!=8){
													$cont+=1;
													echo "<option  value='" . $reg[0] . "'>" . $cont . " | " . $reg[1]. " </option>";	
												}
											}
										}
										?>
									</select>
								</div>
								<div title="título" class="form-group">
									<label style="color: white"for="" for="titulo_producto"> Jo'ol ts'íib:</label>
									<input type="text" class="form-control" id="titulo_producto" placeholder="Jo'ol ts'íib" name="titulo_producto" required=true>
								</div>
								<div title="Descripcion" class="form-group">
									<label style="color: white" for="descripcion_producto"> Tsolt'aan:</label>
									<textarea class="form-control" id="descripcion_producto" placeholder="Tsolt'aan" name="descripcion_producto" required=true class="form-control" rows="3"></textarea>
									<!-- <input type="text" > -->
								</div>
								<div title="Autor" class="form-group">
									<label style="color: white" for="autor_producto">Máax meyajtej</label>
									<input list="autores" class="form-control" name="autor_producto" type="text" placeholder="Máax meyajtej">
									<datalist id="autores" name="autores">
									<?php
										$datos = $objGen->listarAutores();
										while ($reg = mysqli_fetch_row($datos)) {
											echo '<input type="text" name="i'.$reg[1].'" id="i'.$reg[1].'" value="'.$reg[0].'" hidden="true">';
											echo "<option value='" .$reg[1]. "'></option>";
										}										
									?>
									</datalist>	
								</div>
								<div title="Idioma" class="form-group">
									<label style="color: white" for="idioma_id_idioma">T'aanil:</label>
									<select class="form-control" id="idioma_id_idioma" name="idioma_id_idioma">'
									<?php 
										$datos = $objGen->listarIdiomas();
										while ($reg = mysqli_fetch_row($datos)) {
											echo "<option value='" . $reg[0] . "'>" . $reg[0] . " | " .$reg[1] . " </option>";
										}
									?>
									</select>	
								</div>
								<div title="Fecha de creación" class="form-group">
									<label style="color: white" for="fechacreacio_producto">K’iinil ka betabi':</label>
									<input type="date" class="form-control" id="fechacreacio_producto" name="fechacreacio_producto" required=true>
								</div>
								<div title="Lugar de origen" class="form-group">
									<label style="color: white" for="comunidad_producto">Tu'uxil</label>
									<input list="comunidad" class="form-control" id="comunidad_producto" name="comunidad_producto" type="text" placeholder="Tu'uxil">
									<datalist id="comunidad" name="comunidad">
									<!-- <select class="form-control" id="comunidad_producto" name="comunidad_producto">'; -->
										<?php
										$datos = $objGen->listarComunidad();
										while ($reg = mysqli_fetch_row($datos)) {
											// echo "<option value='" . $reg[0] . "'>" . $reg[0] . " | " .$reg[1]. " </option>";
											echo '<input type="text" name="co'.$reg[1].'" id="co'.$reg[1].'" value="'.$reg[0].'" hidden="true">';
											echo "<option value='" .$reg[1]. "'></option>";
										}
										?>
									</datalist>
								</div>
								<!-- <div class="form-group">
									<label style="color: white" for="calificacio_producto">Calificación</label>
									<input type="number" value=10 class="form-control" id="calificacio_producto"  min=1 max=10 name="calificacio_producto" required=true>
								</div> -->
								<?php if ($admin){ ?>
								<div class="form-group">
									<label style="color: white" for="estado">Estado</label>
									<select class="form-control" id="estado" name="estado">
										<option selected value=true> 1 | Activo</option>
										<option value=false> 2| Inactivo</option>
									</select>
								</div>
								<?php }else{?>
									<input type="text" name="estado" id="estado"value="false" hidden>
								<?php }?>
								<div class="row">
									<div class="col-sm-6 col-md-6">
										<input style="color: white" name="uploadedfile" type="file"/>
									</div>
									<?php
									if ($tipo==2) {
									echo "<br><div class='col-sm-6 col-md-6'>";
									echo "<div class='alert alert-danger alert-dismissible' role='alert'>";
									  echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' class='btn-cerrar'>&times;</span></button>";
									  echo "<strong>Videos embebidos!</strong> Copia y pega el link ";
									echo "</div>";
										echo "<p>";
										  echo "<a class='btn btn-primary' data-toggle='collapse' href='#collapseExample' role='button' aria-expanded='false' aria-controls='collapseExample'>
										    Ver campo  <i class='fas fa-link'></i>
										  </a>";
										echo "</p>";
										echo "<div class='collapse' id='collapseExample'>";
										  echo "<div class='card card-body'>";
										    echo "<input type='text' id='link_ytb' name='link_ytb' class='form-control' placeholder='https://www.youtube.com/embed/GeCNShiLdpc' aria-label='' aria-describedby='basic-addon1'>";
										  	echo "</div>";
										echo "</div><br>";
									echo "</div>";
									}
									?>
								</div><br>
								<div class="row">
									<div title="Subir trabajo" col-sm-12>
										<p align="center">
										<button type="submit" class="btn btn-outline-info" name="cargar" value="Subir Archivo">Na'aks meyaj <span class="glyphicon glyphicon-open"></span></button>
									<br/>
									</p>
									</div>
								</div>
							</form>
						<!-- <div class="row"></br></br></br></div> -->
						</div>
						<div class="col-md-1">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
			</div>	
		</div>
		<br>
	</div>
</body>
</html>