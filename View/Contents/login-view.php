<section class="content-login">
    <div class="container container-login">
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-login border-0">
                    <div class="card-header">
                        <img src="<?php echo SERVERURL; ?>View/scripts/img/icon.png" alt="">
                    </div>
                    <div class="card-body">
                        <form action="" data-form="" method="POST" class="logForm" autocomplete="off">
                            <div class="mb-3">
                                <input type="email" name="usuario_log" id="usuario" placeholder="Correo" class="box-info">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="clave_log" id="contra" placeholder="Password" class="box-info">
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" name="check" id="check" class="form-check-input eye">
                                <label for="check" id="text-eye">Mostrar Contraseña</label>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Ingresar" class="btn-send box-info">
                            </div>
                            <div class="RespuestaAjax"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
            if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
                require_once "./Controller/logController.php";
                $log = new logController();
                echo $log->log_Controller();
                //echo $_SESSION['tipo_user'];
            }
        ?>