<?php
  require_once "./Controller/docenteController.php";
  $name = new docenteController();
  $datos = $name->perfil_docente($_SESSION["tipo_user"]);
  $perfil = $datos->fetch();
?>
<section class="content header_main">
  <div class="container header" style="">
    <form action="#" class="search_box">
      <input type="text" class="search_text" name="search" id="search" placeholder="Buscar Documento...">
      <button class="icon-search search_btn"></button>
    </form>
    <a href="home" class="logo">
      <img src="<?php echo SERVERURL; ?>View/Scripts/img/logo_inicio.png" alt="inico">
    </a>
    <div class="action-btns">
      <div class="col"  style="display:inline-flex;"><a href="perfil" class="btn_user icon-user" id="btn-login"></a><p id="btn-text-login" class="text-white" style="margin:10px;"><?php echo $perfil[0]; ?></p></div>
      <a href="#" class="btn_user icon-menu" id="btn-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="visibility: hidden;" aria-hidden="true">
                <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel">Menú</h5>
                  <button type="button" class="btn-close btn-close-menu text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <form action="#" class="search_box sb2">
                    <input type="text" class="search_text" name="search-phone" id="search-phone" placeholder="Buscar Documento...">
                    <button class="icon-search search_btn"></button>
                  </form>
                  <br>
                  <div class="menu-phone">
                    <ul>
                      <li><a href="home">Inicio</a></li>
                      <li><a href="perfil">Perfil</a></li>
                      <li><a href="resourses">Recursos</a></li>
                      <li><a href="registro">Registro</a></li>
                      <li><a href="Out">salir</a></li>
                    </ul>
                  </div>
                </div>
              </div>
          </div>
    </div>
  </div>
  <hr style="color:#fff;height:2px;opacity:0.7;margin:0px;">
  <div class="container navigation-menu">
    <ul>
      <li><a href="home">Inicio</a></li>
      <li><a href="resourses">Recursos</a></li>
      <li><a href="registro">Registro</a></li>
      <li><a href="Out">salir</a></li>
    </ul>
  </div>
</section>

