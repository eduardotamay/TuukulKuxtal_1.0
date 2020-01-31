<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Registro</title>
    <meta charset="utf-8">
  	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/Resgister.css">
    </head>
    <body class="body-container">
        <div class="container">
            <div class="row">
			<center><h3 title="Registrate">Tsíibtabaj</h3></center><br/>			
                <div class="col-md-12">
                    <div class="row">
                    	<div class="col-md-3"></div>
						<div class="col-md-6 box-register">
							<form id="tab1" action="../Controlador/TUsuario.php" method="POST">
								<div class="form-group">
									<input type="hidden" class="form-control" id="registroXusuario" value="registroXusuario" name="registroXusuario">
									<label for="uperil" hidden>Perfil: </label>
									<select class="" id="uperfil" name="uperfil" hidden>
										<option value="Usuario">Usuario</option>
									</select>
								</div>
								<div title="Este es el nombre con el que entrarás al sistema" class="form-group">
									<label for="nusuario">Usuario:</label></br><em>Yéetel le k'aaba ken ookokech ichil le sistema</em>
									<input type="text" class="form-control" id="nusuario" placeholder="Usuario" name="unombre" required="true">
								</div>
								<div title="Nombre" class="form-group">
									<label for="unombre">A k'aaba':</label>
									<input type="text" class="form-control" id="unombre" placeholder="A K'aaba'" name="nusuario" required="true">
								</div>
								<div title="Apellido Paterno" class="form-group">
									<label for="upaterno">U ka' k'aaba' a yuumtsil:</label>
									<input type="text" class="form-control" id="upaterno" placeholder="U ka' k'aaba' a yuumtsil" name="upaterno" required="true">
								</div>
								<div title="Apellido Materno" class="form-group">
									<label for="umaterno">U ka' k'aaba' a na'tsil:</label>
									<input type="text" class="form-control" id="umaterno" placeholder="U ka' k'aaba' a na'tsil" name="umaterno" required="true">
								</div>
								<div class="form-group">
									<label for="ucorreo">Correo:</label>
									<input type="email" class="form-control" id="ucorreo" placeholder="abc@ejemplo.com" name="ucorreo" required="true" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
								</div>
								<div title="Fecha Nacimiento" class="form-group">
									<label for="ufecha">K'iinil a síijil :</label>
									<input type="date" class="form-control" id="ufecha" placeholder="ufecha" name="ufecha" required="true">
								</div>
								<div title="Contraseña" class="form-group">
									<label for="uclave">A jéets’ ta’akil ts’íib : </label>
									<input type="password" class="form-control" id="uclave" placeholder="A jéets’ ta’akil ts’íib" name="uclave" required="true">
								</div>
								<div title="Confirmar contraseña" class="form-group">
									<label for="confclave">Jaajkuntej a jéets’ ta’akil ts’íib</label>
									<input type="password" class="form-control" id="confclave" placeholder="Jaajkuntej a jéets’ ta’akil ts’íib" name="confclave" required="true">
								</div>
							<!--	<div class="form-group">
									<label for="uocupacion">Ocupación:</label>
									<select class="form-control" id="uocupacion" name="uocupacion" required="true">
										<?php
										require_once '../Modelo/Usuario.php';
										$objGen = new Usuario();
										$datos = $objGen->listarOcupacion();
										while ($reg = mysqli_fetch_row($datos)) {
											
											echo "<option selected value='" . $reg[0] . "'>" . $reg[0] . " | " . utf8_encode($reg[1]) . " </option>";
										}
										?>
									</select>
								</div>
							-->	
								<div title="Ocupación" class="form-group">
					              <label for="autor"> A meyaj:</label>
					              <input id="uocupacion" name="uocupacion" list="ocupaciones" class="form-control" type="text" value="" require="true">
				                      <datalist id="ocupaciones" name="ocupaciones">
				                      <?php
				                      	require_once '../Modelo/Usuario.php';
										$objGen = new Usuario();
				                      $datos = $objGen->listarOcupacion();
				                      while ($reg = mysqli_fetch_row($datos)) {
				                          ?>
				                        <option value="<?php echo $reg[1]?>"></option>
				                        <?php
				                      }               
				                      ?>
				                    </datalist> 
				                    <?php
				                      $datos = $objGen->listarOcupacion();
				                      while ($reg = mysqli_fetch_row($datos)) {
				                    ?>
				                        <input type="text" id ='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' name='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' 
				                        value='<?php echo preg_replace('[\s+]','', $reg[0]);?>' hidden>
				                    <?php
				                      }               
				                    ?>
					            </div>
								<p title="Regresar" class="btn-regresar">
									<a class="btn btn-danger" href="../Vista/GUIPublic.php" role="button">Suut</a>
								</p>
								<p title="Guadar" class="btn-registro">
									<button type="submit" class="btn btn-primary" name="OK0" value="Ingresar">Ta'ak</button>
								</p>
							</form>
							</br>
						</div>
						<div class="col-md-3"></div>				
						</div></br>
                    </div>
                </div>
            </div>
            </br>	
        </div>
		<?php 
			//}
			//else{
		?>
		<?php 
			//}
		?>
    </body>
</html>