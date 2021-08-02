<?php
    require_once "./Controller/resourceController.php";
    $name = new resourceController();
    $counts = $name->count_resources($_SESSION['tipo_user']);
    $count = $counts->fetch();
    $resources = $name->my_resources($_SESSION['tipo_user'],3);
    $veri = $name->my_resources($_SESSION['tipo_user'],3);
    $verify = $veri->fetch();
    //var_dump($count);
?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6>Operaicones</h6>
                        <ol class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="registro"><i class="icon-doc-add"></i> Registrar</a>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="publish"><i class="icon-publish text-success"></i> Publicados</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[0]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="observed"><i class="icon-eye text-warning"></i> Observados</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[1]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="pending"><i class="icon-clock text-info"></i> Pendientes</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[2]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="removed"><i class="icon-doc-remove text-danger"></i> Removidos</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[3]; ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6>Mis recursos pendientes de publicacion</h6>
                        <br>
                        <!----------------------------------- inicio de listado ---------------------------------------------------->
                        <?php if($resources->rowCount()>0 && $verify[0] != "no data"){ ?>
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Curso</th>
                                    <th>Fecha de subida</th>
                                    <th>Fecha de publicacion</th>
                                    <th>Estado</th>
                                    <th>Tipo</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php while($lista = $resources->fetch()){ ?>
                                <tr>
                                    <td><?php echo $lista[0]; ?></td>
                                    <td><?php echo $lista[1]; ?></td>
                                    <td><?php echo $lista[2]; ?></td>
                                    <td><?php echo $lista[3]; ?></td>
                                    <td><i class="badge bg-info rounded-pill">Pendiente (code <?php echo $lista[4]; ?>)</i></td>
                                    <?php 
                                        if($lista[5] == 'Docx.'){
                                            $icon = 'word';
                                        }else if($lista[5] == 'PDF.'){
                                            $icon = 'pdf';
                                        }else{
                                            $icon = 'excel';
                                        }
                                    ?>
                                    <td><i class="icon-file-<?php echo $icon; ?>"></i></td>
                                    <td><i class="icon-spin1 animate-spin"></i></td>
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