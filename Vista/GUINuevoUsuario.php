<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Gestión de usuario</title>
        <style type="text/css">
        	th,td{
        		text-align: center;
        	}
        </style>
    </head>
    <body>
        <?php 
        include('../Vista/BarraMenu.php'); 
		if($admin){
			if (isset($_GET["where"]))
			{
				$where=$_GET["where"];
			}
			else {
				$where=" ";
			}
		?>
    	<div class="container">
    		<div class="row">
				<center><h3 title="Gestión de usuarios">Belankun Wíiniko'ob</h3></center><br/>			
            	<div class="col-md-12">
                	<div class="row">
						<div class="col-md-3" style="background-color: rgba(0,0,0,0.3);">
							<center><h3>Crear usuario</h3></center><br/>
							<form id="tab1" action="../Controlador/TUsuario.php" method="POST">
								<div class="form-group">
									<input type="hidden" class="form-control" id="registroXadmin" value="registroXadmin" name="registroXadmin">
									<label for="uperil">Perfil: </label>
									<select class="form-control" id="uperfil" name="uperfil">
										<option value="Administrador">Administrador</option>
										<option value="Usuario">Usuario</option>
									</select>
								</div>
								<div class="form-group">
									<label for="nusuario">Usuario: Acceso al sistema</label>
									<input type="text" class="form-control" id="nusuario" placeholder="Usuario" name="nusuario" required>
								</div>
								<div title="Nombre(s)" class="form-group">
									<label for="unombre"> K'aaba':</label>
									<input type="text" class="form-control" id="unombre" placeholder="K'aaba'" name="unombre"  required>
								</div>
								<div title="Apellido Paterno" class="form-group">
									<label for="upaterno">U ka' k'aaba' a yuumtsil:</label>
									<input type="text" class="form-control" id="upaterno" placeholder="U ka' k'aaba' a yuumtsil" name="upaterno" required>
								</div>
								<div title="Apellido Materno" class="form-group">
									<label for="umaterno">U ka' k'aaba' a na'tsil:</label>
									<input type="text" class="form-control" id="umaterno" placeholder="U ka' k'aaba' a na'tsil" name="umaterno" required>
								</div>
								<div title="Fecha de Nacimiento" class="form-group">
									<label for="ufecha">K'iinil síijil</label>
									<input type="date" class="form-control" id="ufecha" placeholder="K'iinil síijil" name="ufecha" required="true">
								</div>
								<div class="form-group">
									<label for="ucorreo">Correo:</label>
									<input type="email" class="form-control" id="ucorreo" placeholder="Correo" name="ucorreo" required>
								</div>
								<div title="Contraseña" class="form-group">
									<label for="uclave">Jéets’ ta’akil ts’íib</label>
									<input type="password" class="form-control" id="uclave" placeholder="Jéets’ ta’akil ts’íib" name="uclave" required>
								</div>
								<div title="Confirmar contraseña" class="form-group">
									<label for="confclave">Jaajkuntej u jéets’ ta’akil ts’íib</label>
									<input type="password" class="form-control" id="confclave" placeholder="Jaajkuntej a jéets’ ta’akil ts’íib" name="confclave" required>
								</div>
								<div title="Ocupación" class="form-group">
									<label for="uocupacion">Meyaj:</label>
									<select class="form-control" id="uocupacion" name="uocupacion">
										<?php
										require_once '../Modelo/Usuario.php';
										$objGen = new Usuario();
										$datos = $objGen->listarOcupacion();
										while ($reg = mysqli_fetch_row($datos)) {
											
											echo "<option selected value='" . $reg[0] . "'>" . $reg[0] . " | " . $reg[1] . " </option>";
										}
										?>
									</select>
								</div>
								<button title="Guardar" type="submit" class="btn btn-primary" name="OK4" value="Ingresar">Ta'ak</button>
								<br/>
								<br/>

							</form>
						</div>
						<!-- sección de filtros-->
						<div class="col-md-9">
							<div class="col-md-12" style="background-color: rgba(0,0,0,0.3);">
								<form id="tab1" action="../Controlador/TBuscar.php" method="POST">
									<center><h3 title="Buscar">Kaxan</h3></center><br/>
									<div class="col-md-3">
										<div title="Nombre" class="form-group">
											<label for="xusuario">K'aaba' :</label>
											<input type="text" class="form-control" id="xusuario" placeholder="K'aaba'" name="xusuario">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="xnombre"> Usuario:</label>
											<input type="text" class="form-control" id="xnombre" placeholder="Usuario" name="xnombre">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="xperfil">Perfil</label>
											<select class="form-control" id="xperfil" name="xperfil">
												<option value="">Seleccionar
												</option>
												<option value="Usuario">Usuario
												</option>
												<option value="Administrador">Administrador
												</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											</br>
											<button title="Buscar" type="submit" class="btn btn-primary" name="OK" value="Buscar">Kaxan</button>
										</div>
									</div>
								</form>
								<br/>
								
							</div>
							<div class="col-md-12">
								<form id="tab2" action="../Controlador/TUsuario.php" method="POST">
									<center><h3 title="Lista de usuarios">Tsoolil wíiniko'ob (Alta)</h3></center><br/>
									<div class="table-responsive">
		                            <table class="table">
		                                <tr class="active" >
		                                    <!--<th>Foto</th>-->
		                                    <th>Perfil</th>
											<th>Usuario</th>
		                                    <th title="Nombre">K'aaba'</th>
		                                    <th title="Apellido Paterno">U ka' k'aaba' a yuumtsil</th>
		                                    <th title="Apellido Materno">U ka' k'aaba' a na'tsil</th>
											<th style="text-align: center;">Correo</th>
											<th title="Ocupación">Meyaj</th>
		                                    <th colspan="2"></th>
		                                </tr>
										
		                                <?php
		                                require_once '../Modelo/Usuario.php';
		                                $objPro = new Usuario();
		                                $datos = $objPro->listarUsuarios($where);
		                                $cont = 0;
		                                //$id_ocupacion = $objPro->listarOcupacion();
		                                while ($reg = mysqli_fetch_row($datos)) {
		                                    $cont +=1;
		                                    echo "<tr class='warning'>";
		                                    echo "<td>".$reg[2]."</td>";
											echo "<td>".$reg[1]."</td>";
		                                    echo "<td>".$reg[11]."</td>";
		                                    echo "<td style='text-align: center;'>".$reg[5]."</td>";
											echo "<td style='text-align: center;'>".$reg[6]."</td>";
											echo "<td style='text-align: center;'>".$reg[4]."</td>";
											echo "<td style='text-align: center;'>".$reg[14]."</td>";

		                         echo "<td title='Eliminar'><form id='tab' action='../Controlador/TUsuario.php' method='POST'>"."<input type='hidden' id='id_usuario' name='id_usuario' value=".$reg[0]."><button type='submit' class='btn btn-danger' name='OK2' value='Eliminar'>Tse'elel</button></form></td>";
		                                    
		                         echo "<td title='Modificar'><form id='tab' action='../Vista/GUIModificarcuenta.php' method='POST'>"."<input type='hidden' id='Idusuario' name='Idusuario' value=".$reg[0]."><button type='submit' class='btn btn-primary' name='OK1' value='Modificar'>K'eex</button></form></td>";
		                                    //Aqui se tiene que jalar todos los datos para hacer la modificacion
		                                }
		                                ?>
		                            </table>
		                            </div>
		                        </form>
		                        <!--Tablas de usuarios dados de Baja-->
								<form id="tab3" action="../Controlador/TUsuario.php" method="POST">
									<center><h3 title="Lista de usuarios">Tsoolil wíiniko'ob (Baja)</h3></center><br/>
									<div class="table-responsive">
		                            <table class="table">
		                                <tr class="active" >
		                                    <!--<th>Foto</th>-->
		                                    <th align="center">Perfil</th>
											<th>Usuario</th>
		                                    <th title="Nombre">K'aaba'</th>
		                                    <th title="Apellido Paterno">U ka' k'aaba' a yuumtsil</th>
		                                    <th title="Apellido Materno">U ka' k'aaba' a na'tsil</th>
											<th style="text-align: center;">Correo</th>
											<th title="Ocupación">Meyaj</th>
		                                    <th colspan="2"></th>
		                                </tr>
										
		                                <?php
		                                require_once '../Modelo/Usuario.php';
		                                $objPro = new Usuario();
		                                $datos = $objPro->listarUsuariosBaja($where);
		                                $cont = 0;
		                                //$id_ocupacion = $objPro->listarOcupacion();
		                                while ($reg = mysqli_fetch_row($datos)) {
		                                    $cont +=1;
		                                    echo "<tr class='warning' >";
		                                    echo "<td>".$reg[2]."</td>";
											echo "<td>".$reg[1]."</td>";
		                                    echo "<td>".$reg[11]."</td>";
		                                    echo "<td style='text-align: center;'>".$reg[5]."</td>";
											echo "<td style='text-align: center;'>".$reg[6]."</td>";
											echo "<td style='text-align: center;'>".$reg[4]."</td>";
											echo "<td style='text-align: center;'>".$reg[14]."</td>";

		                         echo "<td title='Activar'><form id='tab' action='../Controlador/TUsuario.php' method='POST'>"."<input type='hidden' id='id_usuario' name='id_usuario' value=".$reg[0]."><button type='submit' class='btn btn-danger' name='OK3' value='Alta'>Na'aks</button></form></td>";
		                                    
		                         echo "<td title='Modificar'><form id='tab' action='../Vista/GUIModificarcuenta.php' method='POST'>"."<input type='hidden' id='Idusuario' name='Idusuario' value=".$reg[0]."><button type='submit' class='btn btn-primary' name='OK1' value='Modificar'>K'eex</button></form></td>";
		                                    //Aqui se tiene que jalar todos los datos para hacer la modificacion
		                                }
		                                ?>

		                            </table>
		                            </div>
		                        </form>
	                    	</div>
                        </div>
					</div>
                </br></br>
                </br></br>
                </div>
            </div>
        </div>
		<?php 
		}
			else{
		?>
		<div class="container">
			<div class="col-md-12">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="text-align: center;">
					<?php //echo("<h1> $nombre</h1>") ;?><h1>Usted</h1>
					<h1>Requiere Permisos</h1>
					<h1>Para visualizar esto</h1>
				</div>					
			</div>
		</div>-->
		<?php 
			}
		?>
    </body>
</html>