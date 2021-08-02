<?php
    require_once "./Controller/resourceController.php";
    $name = new resourceController();
    if(isset($_POST['grado']) && isset($_POST['curso']) && isset($_POST['tipo'])){
       if(isset($_POST['lista'])){
           $datos = $name->filtrer_c($_POST['grado'],$_POST['curso'],$_POST['tipo'],$_POST['lista']);
       }else{
            $datos = $name->filtrer2($_POST['grado'],$_POST['curso'],$_POST['tipo']);
       }
        //var_dump($datos->fetch());
    }else{
        $datos = $name->resources_c();
        //var_dump($datos->fetch());
    }
    $tipo = $name->tipo();
    $grado = $name->grado();
    $materias = $name->materias();
    //var_dump($datos->fetchall());
?>
<section class="content">
    <div class="container" style="border-bottom:1px solid #7f61b9;">
        <br>
        <form action="resourses" method="POST">
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <div class="form-group row mb-3">
                            <div class="col-md-3 col-sm-3">
                                <label for="">Grado: </label>
                            </div>
                                <div class="col-md-8 col-sm-8">
                                    <select name="grado" class="form-select" id="grado">
                                        <?php while($grade = $grado->fetch()){ ?>
                                        <option value="<?php echo $grade[0] ;?>"><?php echo $grade[0] ;?></option>
                                        <?php } ?>
                                    </select>
                                </div> 
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group row mb-3">
                            <div class="col-md-3 col-sm-3">
                                <label for="">Materia:</label>
                            </div>
                                <div class="col-md-8 col-sm-8">
                                <select name="curso" class="form-select" id="curso">
                                        <?php while($materia = $materias->fetch()){ ?>
                                            <option value="<?php echo $materia[0] ;?>"><?php echo $materia[0] ;?></option>
                                        <?php } ?>
                                    </select>
                                </div> 
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group row mb-3">
                            <div class="col-md-3 col-sm-3">
                                <label for="">Tipo:</label>
                            </div>
                                <div class="col-md-8 col-sm-8">
                                    <select name="tipo" id="tipo" class="form-select">
                                        <?php while($type = $tipo->fetch()){ ?>
                                            <option value="<?php echo $type[0] ;?>"><?php echo $type[0] ;?></option>
                                        <?php } ?>
                                    </select>
                                </div> 
                    </div>
                </div>
                <!--******************************************************************************-->
                <?php if(isset($_SESSION['tipo_user'])){ ?>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group row mb-3">
                            <div class="col-md-3 col-sm-3">
                                <label for="">Listar:</label>
                            </div>
                                <div class="col-md-8 col-sm-8">
                                    <select name="lista" id="lista" class="form-select">
                                    <option value="2">Todos</option>
                                        <option value="<?php echo $_SESSION['tipo_user']; ?>">Mis recursos</option>
                                        
                                    </select>
                                </div> 
                    </div>
                </div>
                <input style="display:none;" type="text" name="cod_user" id="cod_user" value="<?php echo $_SESSION["tipo_user"]; ?>">
                <?php } ?>
                <!--******************************************************************************-->
                
                <div class="col-md-2 col-sm-6 col-xs-6">
                                <div class="form-group mb-3">
                                    <input type="submit" value="Filtrar" class="btn btn-warning filtrar icon-filter" name="filtrar">
                                </div>
                            </div>
            </div>

        </form>
    </div>
    <div class="container">
        <br>
            <div class="row row-cols-1 row-cols-md-5 g-4 RespuestaAjax">
                <?php if($datos->rowCount()>0){ ?>
                    <?php while($resorce = $datos->fetch()){ ?>
                <div class="col">
                    <form action="reading" method="post">
                        <label for="<?php echo $resorce[8]; ?>" style="display:block;">
                    <div class="card h-100 text-center">
                        <div class="card-header"><strong><h6><?php echo $resorce[0]; ?></h6></strong></div>
                        <?php if($resorce[3]=="PDF."){
                            $icon = "pdf";
                            
                        }elseif($resorce[3] == "Docx."){
                            $icon = "word";
                            echo "<div class='tarjet'><p class='text-tarjet'>Descargar</p></div>";
                        }elseif($resorce[3] == "xlsx."){
                            $icon = "excel";
                            echo "<div class='tarjet'><p class='text-tarjet'>Descargar</p></div>";
                        } ?>
                        <div class="card-body icon-file-<?php echo $icon; ?>" style="font-size:100px"></div>
                        
                        <div class="card-footer"><i style="font-size:12px;">Publicado el: <?php echo $resorce[1]; ?></i></div>
                    </div>
                    </label>
                    <input style="display:none;" type="submit" value="<?php echo $resorce[8]; ?>" name="send" id="<?php echo $resorce[8]; ?>">
                    </form>
                </div>
                <?php } 
                }else{
                    echo "<p> <i class='icon-warning text-warning'></i> !No se encontraron Resultados...¡</p>";
                } ?>
                
                
            </div>
        </div>
</section>