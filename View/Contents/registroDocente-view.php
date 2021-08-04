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
                        
                        
                        <!---------------------------------------- fin de listado ----------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>