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
                        
                        <form action="#" method="post" class="formAjax">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nombre Docente:</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellidos Docente: </label>
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
                                        <label for="">Seccion: </label>
                                        <select name="seccion" id="seccion" class="form-select">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Materia: </label>
                                        <select name="materia" id="materia" class="form-select">
                                            <option value="1">Matematicas</option>
                                            <option value="2">Comunicacion</option>
                                            <option value="3">Arte</option>
                                            <option value="4">Computacion</option>
                                            <option value="5">Historia</option>
                                            <option value="6">Geografia</option>
                                            <option value="7">Quimica</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="">Grado: </label>
                                        <select name="grado" id="grado" class="form-select">
                                            <option value="1">Primero</option>
                                            <option value="2">Segundo</option>
                                            <option value="3">Tercero</option>
                                            <option value="4">Cuarto</option>
                                            <option value="5">Quinto</option>
                                        </select>
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
                        </form>
                        <!---------------------------------------- fin de listado ----------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>