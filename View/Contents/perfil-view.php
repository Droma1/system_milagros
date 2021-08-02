<?php
    if(substr($_SESSION['tipo_user'],0,2) == "DC"){
        require_once "./Controller/docenteController.php";
        $name = new docenteController();
        $name_ = $name->publish_personaC($_SESSION["tipo_user"]);
        $datos = $name->perfil_docente($_SESSION["tipo_user"]);
        $perfil = $datos->fetch();
        $name_view = $name_->fetchAll();
        $type = "Docente";
    }elseif(substr($_SESSION['tipo_user'],0,2) == "AL"){
        require_once "./Controller/alumnoController.php";
        $name = new alumnoController();
        $name_ = $name->publish_personaA($_SESSION["tipo_user"]);
        $datos = $name->perfil_alumno($_SESSION["tipo_user"]);
        $perfil = $datos->fetch();
        $name_view = $name_->fetchAll();
        $type = "Alumno";
    }
    //echo $_SESSION["tipo_user"];
    //echo var_dump($name_view);
    
    if($name_view[0][0] == "no data" || $name_view[0][0] == null || $name_view[0][0] == "" ){
        $name_view[0][0] = 0;
        $name_view[1][0] = 0;
        $name_view[2][0] = 0;
    } 
    if(!isset($name_view[1][0],$name_view[2][0])){
        $name_view[1][0] = 0;
        $name_view[2][0] = 0;
    }
    //var_dump($perfil);
    //echo $name_view[1][0];
    $total = $name_view[0][0] + $name_view[1][0] + $name_view[2][0];
    //var_dump($name_view);

    switch($perfil[4]){
        case 1:
            $icon = "success";
            $estado = "Activo";
        break;
        case 2:
            $icon = "warning";
            $estado = "Restringido";
        break;
        case 3:
            $icon = "danger";
            $estado = "Inhabilitado";
        break;
    }
?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h3>Perfíl</h3>
                        <div class="row">
                            <div class="col"><i class="icon-user-circle-o" style="font-size:100px;"></i></div>
                            <div class="col">
                                <h6><?php echo $perfil[0]." ".$perfil[1]; ?></h6>
                                <label for=""><?php echo $perfil[6]; ?></label>
                                <br>
                                <label for=""><i class="icon-circle text-<?php echo $icon; ?>"></i><?php echo $estado; ?></label>
                            </div>
                            <div class="col">
                                <label for="">Tipor de Usuario : <?php echo $type; ?></label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5>Datos Personales</h5>
                                <hr>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Fecha de Nacimiento:</th>
                                            <td><?php echo $perfil[2]; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Edad:</th>
                                            <td><?php echo $perfil[3]; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Genero:</th>
                                            <td><?php echo $perfil[5]; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Código <?php echo $type; ?>:</th>
                                            <td><?php echo $perfil[7]; ?></td>
                                        </tr>
                                        <?php if(substr($_SESSION['tipo_user'],0,2) == "DC"){?>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Materia Tutora:</th>
                                            <td><?php echo $perfil[8]; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Sección:</th>
                                            <td><?php echo $perfil[9]; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Grado:</th>
                                            <td><?php echo $perfil[10]; ?></td>
                                        </tr>
                                        <?php }elseif(substr($_SESSION['tipo_user'],0,2) == "AL"){?>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Sección:</th>
                                            <td><?php echo $perfil[8]; ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Grado:</th>
                                            <td><?php echo $perfil[9]; ?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6>Publicaciones</h6>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Investigacion:</th>
                                    <td><?php echo $name_view[0][0];?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Libro:</th>
                                    <td><?php echo $name_view[1][0];?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Trabajos:</th>
                                    <td><?php echo $name_view[2][0];?></td>
                                </tr>
                                <tr style="border-top:1px solid #e2e2e3;">
                                    <th scope="row">Total de publicaciones: </th>
                                    <td><?php echo $total;?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>