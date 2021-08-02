<?php //echo $_POST['send'];
    require_once "./Controller/resourceController.php";
    $name = new resourceController();
    $view_resurce = $name->reading($_POST['send']);
    $view = $view_resurce->fetch();
?>
<section class="content">
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if($view[0] == "PDF."){
                        ?>
                        <div id="pdf-content">
                        <div id="pdf_lector" style="height:600px;">
                            <object width="100%" height="100%" type="application/pdf" data="<?php echo SERVERURL ?>View/resources/<?php echo $view[3] ?>#zoom=55&toolbar=0&navpanes=true" id="pdf_content"><p>Document load was not successful.</p></object>
                        </div>
                        </div>
                        <?php }else{ ?>
                            <div class="card mb-4" style="max-width: 740px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <i class="icon-doc-alt img-fluid rounded-start" style="font-size:140px;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Fallo al visualizar</h5>
                                            <p class="card-text">Nuestro visualizador de documentos solo admite formatos ".PDF".</p>
                                            <?php
                                                if(isset($_SESSION['tipo_user'])){
                                                    ?>
                                                    <p class="card-text">Puede descargar el archivo sin preocupaciones, ya fue verificada la integridad del contenido.</p>
                                                    <?php
                                                }else{
                                            ?>
                                            <p class="card-text">Para descargar el contenido es necesario que acceda a su cuenta.</p>
                                            <?php } ?>
                                            <p class="card-text"><small class="text-muted">Ultima Actualización : <?php echo date('l jS \of F Y h:i:s A'); ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <hr>
                        <div class="form-group">
                            <h5>Titulo: <?php echo $view[2]; ?></h5>
                            <h6><i class="icon-user-circle-o" style="font-size:30px;"></i> <?php echo $view[10]." ".$view[11]; ?></h6>
                            <?php
                                if(isset($_SESSION['tipo_user'])){
                                    ?>
                                    <a href="<?php echo SERVERURL ?>View/resources/<?php echo $view[3]; ?>" download="<?php echo $view[2]; ?>" class="btn btn-success"> <i class="icon-download"></i> Decargar</a><br>
                                    <?php
                                }
                            ?>
                            <label for=""> <strong>Curso: </strong> <?php echo $view[9]; ?></label> &nbsp;&nbsp;
                            <label for=""> <strong>Grado: </strong><?php echo $view[7]; ?></label> &nbsp;&nbsp;
                            <label for=""><strong>Seccion: </strong><?php echo $view[12]; ?></label>&nbsp;&nbsp;
                            <label for=""><strong>Fecha de Publicacion: </strong><?php echo $view[4]; ?></label>
                            <br>
                            <label for=""> <strong>Descripcion</strong> : <?php echo $view[13]; ?>.</label>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</section>
