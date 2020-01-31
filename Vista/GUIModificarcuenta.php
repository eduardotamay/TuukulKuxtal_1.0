<link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
<?php 
	include('../Vista/BarraMenu.php');	?>
<div class="container">
	<?php if ($admin){
		require_once '../Modelo/Usuario.php';
		$id_usuario=$_POST['Idusuario'];
		//echo $id_usuario;
		$objPro = new Usuario();
		$datos = $objPro->buscarUsuarioId($id_usuario);
		$reg = mysqli_fetch_row($datos);
	?>
            <div class="row">
                    <div class="row" style="background:rgba(0,0,0,0.3);">
					<center><h3 title="Modificar datos">K'exik nu'uksaj : <?php echo($reg[1])," ",($reg[5])," ",($reg[6]) ?> </h3></center>
					<div class="col-md-12">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<form id="tab" action="../Controlador/TUsuario.php" method="POST">
							<input type="hidden" class="form-control" id="id_usuario" value="<?php echo($reg[0])?>" name="id_usuario">
								<div class="form-group">
									<div class="form-group">
									<label for="uperil">Perfil: </label>
									<select class="form-control" id="uperfil" name="uperfil">
										<option <?php if($reg[2]=="Administrador"){echo "selected";}?> value="Administrador">Administrador</option>
										<option <?php if($reg[2]=="Usuario"){echo "selected";}?> value="Usuario">Usuario</option>
									</select>
								</div>
								</div>
								<div title="Nombre" class="form-group">
									<label for="unombre"> K'aaba':</label>
									<input type="text" class="form-control" required="required" id="unombre" value="<?php echo($reg[1])?>" name="unombre">
								</div>
								<div title="Apellido Paterno" class="form-group">
									<label for="upaterno">U ka' k'aaba' a yuumtsil</label>
									<input type="text" class="form-control" required="required" id="upaterno" value="<?php echo($reg[5])?>" name="upaterno">
								</div>
								<div title="Apellido Materno" class="form-group">
									<label for="umaterno">U ka' k'aaba' a na'tsil</label>
									<input type="text" class="form-control" required="required" id="umaterno" value="<?php echo($reg[6])?>" name="umaterno">
								</div>
								<div title="Fecha De Nacimiento" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
									<label for="ufecha"> K'iinil síijil:</label>
									<input type="date" class="form-control" id="ufecha" placeholder="Contraseña" name="ufecha" value="<?php echo ($reg[12]) ; ?>" required="true">
								</div>
								<input type="hidden" class="form-control" id="uclave" value="<?php echo($reg[3])?>" name="uclave"><!--Este será el que está almacenado en la bd-->

								<div title="Contraseña" class="form-group">
									<label for="nclave">Jéets’ ta’akil ts’íib</label>
									<input type="password" class="form-control" id="nclave" placeholder="Jéets’ ta’akil ts’íib" name="nclave" required="true">
								</div>
								<div class="form-group">
									<label for="ucorreo">Correo:</label>
									<input type="text" class="form-control" required="required" id="ucorreo" value="<?php echo($reg[4])?>" name="ucorreo">
								</div>
								<div class="wrap-input100 validate-input">
								<div title="Ocupación" class="form-group">
					              <label for="autor">Meyaj:</label>
					        <input id="uocupacion" name="uocupacion" list="ocupaciones" class="form-control" type="text" value="<?php echo $reg[14];?>" >
				                      <datalist id="ocupaciones" name="ocupaciones">
				                      <?php
				                      $datos = $objPro->listarOcupacion();
				                      while ($reg = mysqli_fetch_row($datos)) {
				                          ?>
				                        <option value="<?php echo utf8_encode($reg[1]) ;?>"></option>
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
                    		<button title="Guardar" type="submit" class="btn btn-primary" name="OK1" value="Modificar">Ta'ak</button>
                    	</br>
                    	</br>
				</form>
			</div> 
        	<div class="col-md-2"></div>
		    </div>
		</div>
    </div>
</div>
<?php }else{
	include('NOAdmin.php');
} ?>