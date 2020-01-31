<?php
session_start();
if (isset($_SESSION['nombre_usuario'])) {
  $id_usuario=$_SESSION['id_usuario'];
  $perfil=$_SESSION['perfil'];
  $estadoUser= $_SESSION['admin'];
  if ($perfil=="Administrador" && $estadoUser==1) {
    $admin=true;
  }//Administrador de alta (1)
}
  require_once '../Modelo/Genero.php';
  require_once '../Modelo/Producto.php';
  $objPro = new Producto();
  $objGen = new Genero();
?>

<header id="header-container" class="co-fondo">
      <div class="container co-fondo">
      <div class="row justify-content-sm-center justify-content-md-center align-items-center">
          <div title="Logo Tuukul Kuxtal" class="col-3 col-sm-2 fila1-logo">
            <a href="./GUIPublic.php"><img src="../Imagenes/Tuukul-Kuxtal.png" class="img-fluid logo1" alt="Responsive image" width="100px" height="100px"></a>
          </div>
          <div class="col-9 col-sm-5 fila3">
            <div class="titulos">
              <h3 title="Pensamiento vivo" class="title-nav" align="center">Tuukul Kuxtal</h3><br>
              <h6 class="title1-nav" title="Preservación cultural maya" align="center">Kananta’al Maya Miatsil</h6>
            </div>
          </div>
          <div class="col-12 col-sm-5 fila2">
            <div class="login">
              <div class="caja-formu-login" align="center">
                <form class="form-inline mb-3 buscar" action="../Controlador/TBuscarProducto.php" method="POST" style="margin-bottom: 0px!important; margin: 7px 12px 0 0;">
                  <div class="input-group mb-3" style="margin-bottom: 0px!important">
                      <input type="text" type="buscar" class="form-control" placeholder="Kaxan" aria-label="Buscar" aria-describedby="button-addon2" id="palabraClave" name="palabraClave" title="Buscar">
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="submit" id="button-addon2" name="OK2" value="BuscarPalabra" title="Buscar">Kaxan</button>
                    </div>
                  </div>
                </form>
                <?php 
                  if (isset($_SESSION['nombre_usuario'])){
                    require_once '../Modelo/Usuario.php';
                    $objPro = new Usuario();
                    $datos = $objPro->buscarUsuarioId($id_usuario); //Agarra el id de la sesión iniciada
                    $reg = mysqli_fetch_row($datos); //Con el ID se lee todos los datos del USER en BD
                ?>
                <div class="dropdown despliegue">
                    <img title="Peets’ k'a'ate" src="data:image/jpg;base64,<?php echo base64_encode ($reg[7])?> " class="img-fluid img-redondo dropdown-toggle rounded" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" alt="Responsive image" width="50px" height="40px">
                  <div class="dropdown-menu desple-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item menu-item" type="button"><a href="GUICuenta.php" style='text-decoration: none; color:black;'>Mi Perfil </a><i class="fa fa-user-circle" aria-hidden="true"></i></button>
                    <?php
                      if ($reg[2]=='Administrador') {
                        echo "<button class='dropdown-item menu-item' type='button'><a href='GUIGestionArchivos.php' title='Mis archivos' style='text-decoration: none; color:black;'>In noj meyajo'ob</a></button>";
                      }else{
                        echo "<button class='dropdown-item menu-item' type='button'><a href='GUIMisArchivos.php' title='Mis archivos' style='text-decoration: none; color:black;'>In noj meyajo'ob</a></button>";
                      }
                    ?>
                    <button class="dropdown-item menu-item" title="Subir archivo" type="button"><a href="GUICarga.php" style='text-decoration: none; color:black;'>Na’aksaj noj xaak’al </a></button>
                    <button class="dropdown-item menu-item" title="Salir" type="button"><a href="../Salir.php" style='text-decoration: none; color:black;'>Jóok’ol <i class="fas fa-sign-in-alt"></i></a></button>
                </div>
              </div>
                <?php }else{
                ?>
              <ul class="nav nav-tabs despliegue-entrar">
                <li class="nav-item dropdown">
                  <a title="Peets’ k'a'ate" class="nav-link dropdown-toggle flecha-abajo" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-in-alt icono-re"></i></a>
                  <div class="dropdown-menu desple-menu-entrar">
                    <a class="dropdown-item menu-item-entrar" title="Entrar" href="../GUILogin2.php" style='text-decoration: none; color:black;'>Okol</a>
                    <a class="dropdown-item menu-item-entrar" title="Regístrate" href="../Vista/GUIRegistrar.php" style='text-decoration: none; color:black;'>Tsíibtabaj</a>
                  </div>
                </li>
              </ul>
              <?php }?>
              </div>
            </div>
          </div>
      </div>
      <div class="row main-nav">
        <div class="col-12 justify-content-center">
          <nav class="navbar navbar-expand-md navbar-dark co-fondo">
            <a title="Chúumbal" class="navbar-brand" href="GUIPublic.php"><i class="fas fa-home"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <div class="offset-1 offset-md-1">
              <ul class="nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" title="Literatura tradicional maya" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><button type="button" class="btn btn-primary">Nojts’íibil</button></a>
                <div class="dropdown-menu">
                  <?php
                    $datos = $objGen->listarGeneros();
                    while ($reg = mysqli_fetch_row($datos)) {
                      if ($reg[0]!=5  and $reg[0]!=8 and $reg[0]!=16 and $reg[0]!=17){
                      echo "<a class='dropdown-item lista-des' href=listaArchivos.php?id_genero=".$reg[0]."&genero=".$reg[1]."&tipo_producto=".'4'."&archivo=".'Literatura'.">".$reg[1]."</a>";
                      }
                    }
                  ?>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" title="Investigación" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><button type="button" class="btn btn-primary">Noj Xaak’al Ts'íib</button></a>
                <div class="dropdown-menu">
                  <a title="Artículos" class="dropdown-item lista-des" href="listaArchivos.php?tipo_producto=3&archivo=Investigación&genero=Artículo&id_genero=5">Jatsts’íibo'ob</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item lista-des" href="listaArchivos.php?tipo_producto=3&archivo=Investigación&genero=Ensayo&id_genero=8">Ensayos</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><button type="button" class="btn btn-primary">Multimedia</button></a>
                <div class="dropdown-menu">
                  <a class="dropdown-item lista-des" title="Audios" href="listaArchivos.php?tipo_producto=1&archivo=Audios&genero=NG&id_genero=''">Tabsaj u’uyajo'ob</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item lista-des" title="Videos" href="listaArchivos.php?tipo_producto=2&archivo=Videos&genero=NG&id_genero=''">Tabsaj cha’ano'ob</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Vista/contacPublic.php"><button type="button" class="btn btn-primary">Contacto</button></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="aportar.php"><button type="button" title="Aportar" class="btn btn-primary">Ts’aa</button></a>
              </li>
            </ul>
            </div>
            </div>
          </nav>
        </div>
      </div>
      </div>
    </header><br>   <!-- Aqui termina el header -->