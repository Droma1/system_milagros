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
                        <h6>Registrar Docente</h6>
                        <br>
                        
                        <form action="<?php echo SERVERURL ?>Ajax/docenteAjax.php" method="post" class="formAjax">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nombre Docente:</label>
                                        <input type="text" name="nombre_d" id="nombre_d" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellidos Docente: </label>
                                        <input type="text" name="apellido_d" id="apellido_d" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Fecha de nacimiento</label>
                                        <input type="date" name="f_nacimiento_d" id="f_nacimiento_d" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Edad:</label>
                                        <input type="number" name="edad_d" id="edad_d" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Genero: </label>
                                        <select name="genero_d" id="genero_d" class="form-select">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Usuario</label>
                                        <input type="email" name="usuario_d" id="usuario_d" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Seccion: </label>
                                        <select name="seccion_d" id="seccion_d" class="form-select">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Materia: </label>
                                        <select name="materia_d" id="materia_d" class="form-select">
                                            <option value="Matematicas">Matematicas</option>
                                            <option value="Fisica">Fisica</option>
                                            <option value="Arte">Arte</option>
                                            <option value="Computacion">Computacion</option>
                                            <option value="Historia">Historia</option>
                                            <option value="Geografia">Geografia</option>
                                            <option value="Quimica">Quimica</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="">Grado: </label>
                                        <select name="grado_d" id="grado_d" class="form-select">
                                            <option value="3">Primero</option>
                                            <option value="4">Segundo</option>
                                            <option value="5">Tercero</option>
                                            <option value="6">Cuarto</option>
                                            <option value="1">Quinto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Clave: </label>
                                        <input type="password" name="cl1_d" id="cl1_d" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Confirmar Clave: </label>
                                        <input type="password" name="cl2_d" id="cl2_d" class="form-control">
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