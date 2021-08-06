<?php
    require_once "./Controller/docenteController.php";
    $name = new docenteController();
    $lista = $name->lista_docente();
    
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
                                <a href="registroAlumno"><i class="icon-doc-add"></i>Registro de Alumnos</a>
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
                        <h6>Lista de Docentes</h6>
                        <br>
                        
                        <?php if($lista->rowCount()>0){ ?>
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Edad</th>
                                    <th>Estado</th>
                                    <th>genero</th>
                                    <th>usuario</th>
                                    <th>Grado</th>
                                    <th>Seccion</th>
                                    <th>Materia</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php while($listado = $lista->fetch()){ ?>
                                <tr>
                                    <td><?php echo $listado[0]; ?></td>
                                    <td><?php echo $listado[1]; ?></td>
                                    <td><?php echo $listado[2]; ?></td>
                                    <td><?php echo $listado[3]; ?></td>
                                    <td><?php echo $listado[4]; ?></td>
                                    <?php 
                                        if($listado[5] == 1){
                                            $icon = 'success';
                                            $text = "Activo";
                                        }else{
                                            $icon = 'danger';
                                            $text = "Suspendido";
                                        }
                                    ?>
                                    <td><i class="icon-circle text-<?php echo $icon; ?>"></i> <span><?php echo $text; ?></span></td>
                                    <td><?php echo $listado[6]; ?></td>
                                    <td><?php echo $listado[7]; ?></td>
                                    <td><?php echo $listado[8]; ?></td>
                                    <td><?php echo $listado[9]; ?></td>
                                    <td><?php echo $listado[10]; ?></td>
                                    <td><form action="edithUser" method="post">
                                            <label for="<?php echo $listado[11]; ?>" class="icon-pencil text-warning"></label>
                                            <input type="text" name="code" id="code" class="form-control" style="display:none;" value="<?php echo $listado[0]; ?>">
                                            <input style="display:none;" type="submit" value="<?php echo $listado[11]; ?>" name="send" id="<?php echo $listado[11]; ?>">
                                        </form></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <script>
                                $(document).ready(function(){
                                $("#myInput").on("keyup", function() {
                                    var value = $(this).val().toLowerCase();
                                    $("#myTable tr").filter(function() {
                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                                });
                        </script>
                        <?php }else{ ?>
                            <p> <i class='icon-warning text-warning'></i> !No se encontraron Resultados...¡</p>
                        <?php } ?>
                        
                        <!---------------------------------------- fin de listado ----------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>