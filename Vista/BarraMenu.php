<link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/normalize.css" rel="stylesheet">
<script src="../Bootstrap/js/jquery.min.js"></script>
<script src="../Bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../Bootstrap/fonts/glyphicons-halflings-regular.svg">
<link rel="stylesheet" type="text/css" href="css/estilobody.css">
<link rel="stylesheet" type="text/css" href="../css/estiloBarra.css">
<link href="https://fonts.googleapis.com/css?family=Niramit" rel="stylesheet">
<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
	$admin=false;
	require_once '../Modelo/Genero.php';
	require_once '../Modelo/Producto.php';
	require_once '../Modelo/Comentario.php';
	$objCom = new Comentario();
	$objPro = new Producto();
	$objGen = new Genero();
if (isset($_SESSION['nombre_usuario'])) {
    $id_usuario=$_SESSION['id_usuario'];
	$perfil=$_SESSION['perfil'];
	$estadoUser= $_SESSION['admin'];
	if ($perfil=="Administrador" && $estadoUser==1) {
		$admin=true;
	}//Administrador de alta (1)
?>
<!--version para pantallas grandes de pc y notebook-->
<nav class="navbar navbar-inverse barra-nav">
	<div class="container nav-menu">
		<center><h3 title="Pensamiento vivo" class="titulo-nav">Tuukul Kuxtal</h3></center>
		<center><h4 title="Preservación cultural maya" class="titulo2-nav">Kananta’al Maya Miatsil</h4></center>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Menu</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a title="Inicio" class="navbar-brand" href="GUIPublic.php"><strong>Chúumbal</strong></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<div class="row" style="margin-left: 0px; margin-right: 0px;">
				<div class="col-md-offset-2">
					<ul class="nav justify-content-center navbar-nav lista-menu">
						<!-- <li><a href="GUIMisArchivos.php"><span class="glyphicon glyphicon-home"></span></a></li> -->
						<?php 
						if($admin){
						?>
						<li class="dropdown">
							<a class="dropdown" role="button">Perfil <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="GUICuenta.php">Mi Cuenta</a></li>		
								<!-- <li><a href="GUIMisArchivos.php">Mis Archivos</a></li> -->
								<li title="Administrar trabajos"><a href="GUIGestionArchivos.php">Belankun noj meyajo'ob</a></li>
								<li title="Administrar a usuarios"><a href="GUINuevoUsuario.php">Belankun wíiniko'ob</a></li>		
							</ul>
						</li>
						<?php }else{ 
						?>
						<li class="dropdown">
							<a class="dropdown" role="button">Perfil<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="GUICuenta.php">Mi Cuenta</a></li>		
								<li title="Mis trabajos" ><a href="GUIMisArchivos.php">In meyajo'ob</a></li>
							</ul>
						</li>
					<?php }?>
						<!--Opcion Literatura -->
						<li class="dropdown">
							<a title="Literatura Tradicional Maya" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
								Noj ts'íibil
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<?php
								$datos = $objGen->listarGeneros();
								while ($reg = mysqli_fetch_row($datos)) {
									if ($reg[0]!=5  and $reg[0]!=8 and $reg[0]!=16 and $reg[0]!=17){
									echo "<li><a href=GUILibro.php?id_genero=".$reg[0]."&genero=".$reg[1].">".$reg[1]."</a></li>";
									}
								}
								?>
							</ul>
						</li>
						<!-- Fin Opcion Literatura -->
						<!-- Opcion Investigación -->
						<li class="dropdown">
							<a title="Investigación" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
								Noj Xaak’al Ts'íib
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li title="Artículos"><a href=GUILibro.php?id_genero=5&genero=Artículos>Jatsts’íibo'ob</a></li>
								<li><a href=GUILibro.php?id_genero=8&genero=Ensayos>Ensayos</a></li>
							</ul>
						</li>
						<!-- Fin Opcion Investigacion -->
						<!--Opcion Multimedia -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
								Multimedia
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li title="Audios" ><a href="GUIMultimedia.php?id_tipo=1&tipo=audios">Tabsaj u’uyajo'ob</a></li>
								<li title="Videos"><a href="GUIMultimedia.php?id_tipo=2&tipo=videos">Tabsaj cha’ano'ob</a></li>
							</ul>
						</li>
						<!-- Fin Opcion Multimedia -->
						<li ><a href="GUIContacto.php">Contacto</a></li>
						<li title="Cargar Archivo"><a href="GUICarga.php">Na’aksaj noj xaak’al</a></li>
						<?php 
							if (isset($_SESSION['nombre_usuario'])){
						?>
						<li title="Salir" class="left"><a href="../Salir.php">Jóok'ol</a></li>
						<?php	}else{
						?>
						<li title="Entrar" class="left"><a href="../GUILogin2.php">Okol</a></li>
						<?php }?>
					</ul>
				</div>
			</div>
			<!-- =================================================================================== -->
			<!-- Version responsiva del menu (cuando es pequeño) -->
			<!-- =================================================================================== -->
			<ul class="nav navbar-nav navbar-right">
				<ul class="dropdown-menu">
					<!-- <li><a href="GUIMisArchivos.php"><span class="glyphicon glyphicon-home"></span></a></li> -->
				<?php 
				if($admin){
				?>
				<li class="dropdown">
					<a class="dropdown" role="button">Perfil <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="GUICuenta.php">Mi Cuenta</a></li>		
						<!-- <li><a href="GUIMisArchivos.php">Mis Archivos</a></li> -->
						<li title="Ver Usuarios"><a href="GUINuevoUsuario.php">Il wíiniko'ob</a></li>		
					</ul>
				</li>
				<?php }else{ 
				?>
				<li class="dropdown">
					<a class="dropdown" role="button">Perfil<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="GUICuenta.php">Mi Cuenta</a></li>		
						<!-- <li><a href="GUIMisArchivos.php">Mis Archivos</a></li>		 -->
					</ul>
				</li>
			<?php }?>
				<!--Opcion Literatura -->
				<li title="Literatura Tradicional Maya" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
						Noj ts'íibil
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php
						$datos = $objGen->listarGeneros();
						while ($reg = mysqli_fetch_row($datos)) {
							if ($reg[0]!=5  and $reg[0]!=8 and $reg[0]!=16 and $reg[0]!=17){
							echo "<li><a href=GUILibro.php?id_genero=".$reg[0]."&genero=".$reg[1].">".$reg[1]."</a></li>";
							}
						}
						?>
					</ul>
				</li>
				<!-- Fin Opcion Literatura -->
				<!-- Opcion Investigación -->
				<li class="dropdown">
					<a title="Investigación" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
						Noj Xaak’al Ts'íib
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li title="Artículos" ><a href=GUILibro.php?id_genero=5&genero=Artículos>Jatstsíibo'ob</a></li>
						<li><a href=GUILibro.php?id_genero=8&genero=Ensayos>Ensayos</a></li>
					</ul>
				</li>
				<!-- Fin Opcion Investigacion -->
				<!--Opcion Multimedia -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
						Multimedia
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li title="Audios"><a href="GUIMultimedia.php?id_tipo=1&tipo=audios">Tabsaj u'uyajo'ob</a></li>
						<li title="Videos"><a href="GUIMultimedia.php?id_tipo=2&tipo=videos">Tabsaj cha'ano'ob</a></li>
					</ul>
				</li>
				<!-- Fin Opcion Multimedia -->
				<li ><a href="GUIContacto.php">Contacto</a></li>
				<li title="Subir archivo"><a href="GUICarga.php">Na'asaj noj xaak'al</a></li>
				<?php 
					if (isset($_SESSION['nombre_usuario'])){
				?>
				<li title="Salir" class="left"><a href="../Salir.php">Jóokol</a></li>
				<?php	}else{
				?>
				<li title="Okol" class="left"><a href="../GUILogin2.php">Entrar</a></li>
				<?php }?>
				</ul>
			</ul>
		</div>
	</div>
</nav>
<?php }else {
	header("Location:../GUILogin2.php");
} ?>
