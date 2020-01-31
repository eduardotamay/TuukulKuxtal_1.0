<?php 

	//print_r($_SESSION);
	//include('../Vista/BarraMenu.php'); 
	include('../Vista/BarraMenu.php');     
    if (isset($_SESSION)) {
        $id_usuario=$_SESSION['id_usuario']; //Es el ID que sirve le para la funcion de buscarUsuarioId()      
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Mi Cuenta</title>
        <style>
		.custom-input-file {
		    overflow: hidden;
		    position: relative;
		    cursor: pointer;
		    background: #2aa9d2;
		    width: 137px;
		    border-radius: 5px;
		    border: 0.5px solid black;
		}
		.custom-input-file .input-file {
		    margin: 0;
		    padding: 0;
		    outline: 0;
		    font-size: 10000px;
		    border: 10000px solid transparent;
		    opacity: 0;
		    filter: alpha(opacity=0);
		    position: absolute;
		    top: -1000px;
		    cursor: pointer;
		}
        </style>
    </head>
    <body>
        <?php
			require_once '../Modelo/Usuario.php';
			$objPro = new Usuario();
			$datos = $objPro->buscarUsuarioId($id_usuario); //Agarra el id de la sesión iniciada
			$reg = mysqli_fetch_row($datos); //Con el ID se lee todos los datos del USER en BD
		?>
        <!--Probando css cuenta-->
		<div class="container">	
				<p style="color: white; font-size: 1.8em; text-align:center">
				Mi cuenta
				</p>
			<div class="row">
				<div class="col-12 col-md-4 d-flex">	
					<div data-tilt>
						<p title="Foto de perfil" style="color: white; font-size: 1.2em;" align="center">
							Oochel
						</p>
						<figure">
							<p align="center" style="margin: 0 0 0 0">
							<img style="border-radius: 130px; border:5px solid #666;" src="data:image/jpg;base64,<?php echo base64_encode ($reg[7])?> " alt="Foto de perfil" class="img-fluid rounded-circle" width="130px" height="130px" alt="Responsive image">
							</p>
						</figure><br>
							<form action='../Controlador/TCuenta.php' method='POST' enctype='multipart/form-data'>
									<input type="hidden" class="form-control" id="id_usuario" value="<?php echo ($reg[0])?>" name="id_usuario">
									<?php //echo $id_usuario; ?>
									<div class="row">
										<div class="col-xs-offset-4 col-xs-4 col-md-offset-3 col-md-6">
												<input type='file' name='imagen'required=true style="width: 140px;">
										</div>
									</div>
									<br>
									<p align="center">
									<input class="btn btn-primary" type='submit' name="OK2" value='SubirFoto' data-toggle="tooltip" data-placement="bottom" title="Na'aks oochel">
									<button title="No guardar" type="reset" class="btn btn-danger" >Ma' ta'ak</button>
									</p>
							</form>
					</div> <!--Formulario para foto de perfil-->
				</div>
				<div class="col-12 col-md-7 col-md-offset-1">
					<form class="login100-form validate-form" action="../Controlador/TCuenta.php" method="POST"> <!--Formulario para update-->
						<input type="text" required="required" id="uperfil" value="<?php echo ($reg[2]) ;?>" name="uperfil" hidden>
						<div class="wrap-input100 validate-input">
							<input type="hidden" class="form-control" id="id_usuario" value="<?php echo ($reg[0]) ;?>" name="id_usuario">
						</div>
						<div title="Nombre usuario" class="wrap-input100 validate-input">
							<label for="unombre"> K'aaba' :</label>
							<input type="text" class="form-control" required="required" id="unombre" value="<?php echo $reg[1] ;?>" name="unombre">
						</div>
						<div title="Apellido paterno" class="wrap-input100 validate-input">
							<label for="upaterno"> U ka' k'aaba' a yuumtsil:</label>
							<input type="text" class="form-control" required="required" id="upaterno" value="<?php echo $reg[5];?>" name="upaterno">
						</div>
						<div title="Apellido materno" class="wrap-input100 validate-input" >
							<label for="umaterno"> U ka' k'aaba' a na'tsil:</label>
							<input type="text" class="form-control" required="required" id="umaterno" value="<?php echo $reg[6];?>" name="umaterno">
						</div>
						<div title="Fecha de nacimiento" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<label for="ufecha"> K'iinil síijil:</label>
							<input type="date" class="form-control" id="ufecha" placeholder="Contraseña" name="ufecha" value="<?php echo ($reg[12]) ; ?>" required="true">
						</div><br>
						<input type="hidden" class="form-control" id="uclave" value="<?php echo ($reg[3]) ;?>" name="uclave">
						<div class="wrap-input100 validate-input">
							<label class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" for="nclave" data-toggle="tooltip" data-placement="right" title="Ver campo para cambiar contraseña">Il kúuchil ti'al a k'exik jéets’ ta’akil ts’íib</label>
							<div class="collapse" id="collapseExample">
							    <input title="Nueva contraseña" type="password" class="form-control" id="nclave" placeholder="Túumben jéets’ ta’akil ts’íib" name="nclave">
							</div>
						</div><br>
						<div class="wrap-input100 validate-input">
							<label title="Confirmar contraseña" for="nconf">Jaajkuntej a jéets’ ta’akil ts’íib</label>
							<input title="Confirmar contraseña" type="password" class="form-control" id="nconf" placeholder="Jaajkuntej a jéets’ ta’akil ts’íib" name="nconf" required="true">
						</div>
						<div class="wrap-input100 validate-input">
							<label for="ucorreo">Correo:</label>
							<input type="text" class="form-control" required="required" id="ucorreo" value="<?php echo ($reg[4])?>" name="ucorreo">
						</div>
						<div class="wrap-input100 validate-input">
							<div title="Ocupación" class="form-group">
						              <label for="autor"> Meyaj :</label>
						        <input id="uocupacion" name="uocupacion" list="ocupaciones" class="form-control" type="text" value="<?php echo $reg[14];?>" >
					                      <datalist id="ocupaciones" name="ocupaciones">
					                      <?php
					                      $datos = $objPro->listarOcupacion();
					                      while ($reg = mysqli_fetch_row($datos)) {
					                          ?>
					                        <option value="<?php echo $reg[1] ;?>"></option>
					                        <?php
					                      }               
					                      ?>
					                    </datalist> 
					                    <?php
					                      $datos = $objPro->listarOcupacion();
					                      while ($reg = mysqli_fetch_row($datos)) {
					                    ?>
					                        <input type="text" id ='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' name='i<?php echo preg_replace('[\s+]','', $reg[1]); ?>' 
					                        value='<?php echo preg_replace('[\s+]','', $reg[0]);?>' hidden>
					                    <?php
					                      }               
					                    ?>
						     </div>
						</div>
						<div style="margin-left: 24px;">
						<p align="center">
						<button type="reset" title="No guardar" class="btn btn-danger" style="margin-right: 60px;" >Ma' ta'ak</button>
		                <button type="submit" title="Guardar" class="btn btn-primary" name="OK1" value="Modificar">Ta'ak</button>
						</p>
						</div>
					</form>
				</div>
			</div>
		</div>
  </body>
</html>
<?php
    } 
    else {
        echo "No existe usuario en la sesión";
        //header('Location: http://url-de-tu-web.com/login.php');
	}
?>
