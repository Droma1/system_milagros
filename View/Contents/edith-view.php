<?php
    require_once "./Controller/resourceController.php";
    $name = new resourceController();
    $counts = $name->edith_view($_POST['send']);
    $count = $counts->fetch();
    //var_dump($count);
    switch($count[10]){
        case 1:
            $estatus = "success";
            $status_text = "Publicado";
            $edith = "readonly";
            break;
        case 2:
            $estatus = "warning";
            $status_text = "Observado";
            $edith = "readonly";
            break;
        case 3:
            $estatus = "info";
            $status_text = "Pendiente";
            $edith = "";
            break;
        case 4:
            $estatus = "danger";
            $status_text = "Removido";
            $edith = "";
            break;
    }
?>
<section class="content">
    <div class="container">
        <br>
       <div class="card">
           <div class="card-header">
               <br>
               <h5><?php echo $count[0]; ?> : <span class="badge bg-<?php echo $estatus; ?> rounded-pill"><?php echo $status_text; ?></span></h5>
               <br>
           </div>
           <div class="card-body">
               <form action="<?php echo SERVERURL ?>Ajax/resourcesAjax.php" class="formAjax" method="post">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-4">
                               <label for="">Titulo: </label>
                               <input type="text" value="<?php echo $count[0]; ?>" name="titulo" <?php echo $edith; ?> class="form-control">
                           </div>
                           <div class="col-md-4">
                               <label for="">Tema: </label>
                               <input type="text" name="tema" id="tema" class="form-control" value="<?php echo $count[2]; ?>" readonly>
                           </div>
                           <div class="col-md-4">
                               <label for="">Grado: </label>
                               <input type="text" name="grado" id="grado" class="form-control" value="<?php echo $count[3]; ?>" readonly>
                           </div>
                       </div>
                   </div>
                   <br>
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-4">
                               <label for="">Seccion: </label>
                               <input type="text" class="form-control" readonly name="seccion" value="<?php echo $count[4]; ?>">
                           </div>
                           <div class="col-md-4">
                               <label for="">Formato del Documento: </label>
                               <input type="text" name="formato" id="formato" class="form-control" readonly value="<?php echo $count[1]; ?>">
                           </div>
                           <div class="col-md-4">
                               <label for="">Fecha de subida : </label>
                               <input type="text" name="fecha" id="fecha" class="form-control" readonly value="<?php echo $count[5]; ?>">
                           </div>
                       </div>
                   </div>
                   <br>
                   <div class="form-group">
                       <div class="row">
                           <div class="col">
                               <label for="">Ver archivo: <?php echo $count[7]; ?></label>
                               <button type="button" class="btn btn-info icon icon-doc-text" style="float:none; color:#000; background-color: transparent" data-bs-toggle="modal" data-bs-target="#documento"></button>
                               <div class="modal fade" id="documento" tabindex="-1" aria-labelledby="documento" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="pdf_lector" style="height:700px;">
                                                <object width="100%" height="100%" type="application/pdf" data="<?php echo SERVERURL ?>View/resources/<?php echo $count[7]; ?>" id="pdf_content"><p>Document load was not successful.</p></object>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                       </div>
                   </div>
                   <br>
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label for="">Descripcion: </label>
                               <textarea name="descripcion" id="descripcion" value="" <?php echo $edith; ?> class="form-control"><?php echo $count[8]; ?></textarea>
                           </div>
                       </div>
                   </div>
                   <br>
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-4">
                               <label for="">Materia: </label>
                               <input type="text" name="materia" id="materia" class="form-control" readonly value="<?php echo $count[9]; ?>">
                           </div>
                           <div class="col-md-4">
                               <label for="">Cambiar estado: </label>
                               <select name="estado" id="estado" class="form-select" <?php echo $edith; ?>>
                                   <option value="1">Publicado</option>
                                   <option value="2">Observado</option>
                                   <option value="3">Pendiente</option>
                                   <option value="4">Removido</option>
                               </select>
                           </div>
                           <div class="col-md-4">
                               <label for="">Identificador de archivo:</label>
                               <input type="text" name="id_a" id="id_a" class="form-control" readonly value="<?php echo $_POST['send']; ?>">
                           </div>
                       </div>
                   </div>
                   <br>
                   <div class="form-group">
                       <div class="row">
                           <div class="col">
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