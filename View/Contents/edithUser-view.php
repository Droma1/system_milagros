<?php
    require_once "./Controller/alumnoController.php";
    $name = new alumnoController();
    if(substr($_POST['code'],0,2) == "DC"){
        $type=2;
        $link = "docenteAjax.php";
    }else{
        $type=1;
        $link = "alumnoAjax.php";
    }
    $counts = $name->edithUser_view($_POST['send'],$type);
    $count = $counts->fetch();
    //var_dump($count);
    switch($count[4]){
        case 1:
            $estatus = "success";
            $status_text = "Activo";
            break;
        case 2:
            $estatus = "danger";
            $status_text = "Suspendido";
            break;
    }
?>
<section class="content">
    <div class="container">
        <br>
        <div class="card">
            
            <div class="card-body">
            <h6><?php echo $count[0]; ?> <?php echo $count[1]; ?>   <span class="badge bg-<?php echo $estatus ?> rounded-pill"> <?php echo $status_text; ?></span></h6>
            <hr>
                <form action="<?php echo SERVERURL ?>Ajax/<?php echo $link; ?>" class="formAjax" method="POST">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nombres: </label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $count[0]; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="">Apellidos: </label>
                                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $count[1]; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="">Fecha de Nacimiento: </label>
                                <input type="date" name="f_nacimiento" id="f_nacimiento" class="form-control" value="<?php echo $count[2]; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Edad: </label>
                                <input type="number" name="edad" id="edad" class="form-control" value="<?php echo $count[3]; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="">Estado del usuario</label>
                                <select name="estado" id="estado" class="form-select">
                                    <option value="1">Activo</option>
                                    <option value="2">Suspendido</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Genero Actual:  </label>
                                <input type="text" name="genero" id="genero" value="<?php echo $count[5]; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Usuario: </label>
                                <input type="email" name="user_" id="user_" class="form-control" value="<?php echo $count[6]; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="">codigo de usuario: </label>
                                <input type="text" name="id" id="id" value="<?php echo $_POST['code']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="">Contraseña:</label>
                                <input type="text" name="pass" id="pass" class="form-control">
                            </div>
                            <div class="col-md-4" style="display:none;">
                                <input type="text" name="type" id="type" value="<?php echo $type; ?>" readonly class="form-control">
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="submit" value="Guardar" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                    <div class="RespuestaAjax"></div>
                </form>
            </div>
        </div>
    </div>
</section>