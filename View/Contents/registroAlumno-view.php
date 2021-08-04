<?php
    /*require_once "./Controller/resourceController.php";
    $name = new resourceController();
    $counts = $name->count_resources($_SESSION['tipo_user']);
    $count = $counts->fetch();
    $resources = $name->my_resources($_SESSION['tipo_user'],1);
    $veri = $name->my_resources($_SESSION['tipo_user'],1);
    $verify = $veri->fetch();
    //var_dump($count);
    if(substr($_SESSION['tipo_user'],0,2) == "DC"){
        $contadores = $name->counters();
        $val = $contadores->fetch();
    }*/
?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <div class="card">
                    <div class="card-body">
                    <h6>Operaciones</h6>
                        <ol class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="registroAlumno"><i class="icon-doc-add"></i> Registrar Alumno</a>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="listaAlumno"><i class="icon-publish text-primary"></i>Lista de Alumnos</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php //echo $count[0]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="registroDocente"><i class="icon-doc-add text-warning"></i> Registrar Docente</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php //echo $count[1]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="listaDocente"><i class="icon-clock text-warning"></i> Lista de Docentes</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php //echo $count[2]; ?></span>
                            </li>
                        </ol>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6>Registrar Alumno</h6>
                        <br>
                        
                        <form action="<?php echo SERVERURL ?>Ajax/alumnoAjax.php" method="post" class="formAjax">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nombres Alumno:</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellidos Alumno: </label>
                                        <input type="text" name="apellido" id="apellido" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Fecha de nacimiento</label>
                                        <input type="date" name="f_nacimiento" id="f_nacimiento" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Edad:</label>
                                        <input type="number" name="edad" id="edad" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Genero: </label>
                                        <select name="genero" id="genero" class="form-select">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Usuario</label>
                                        <input type="email" name="usuario" id="usuario" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Clave: </label>
                                        <input type="password" name="cl1" id="cl1" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Confirmar Clave: </label>
                                        <input type="password" name="cl2" id="cl2" class="form-control">
                                    </div>
                                    <div class="col-md-4" stile="display:none;">
                                        <label for="">docente code: </label>
                                        <input type="text" readonly name="code_docente" id="code_docente" value="<?php echo $_SESSION['tipo_user']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" value="Registrar" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                            <div class="RespuestaAjax"></div>
                        </form>
                        <!---------------------------------------- fin de listado ----------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>