<?php sleep(1.5); 

require_once "./Controller/resourceController.php";
$name = new resourceController();
$datos = $name->category();


?>
<section class="content-wrappper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <br>
                    <h1>Contenidos</h1>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!------------------------------------------------------>
                <?php while($respuesta = $datos->fetch()){ ?>
                <div class="col-md-3 col-sm-6 col-12 ">                    
                    <div class="card bg-mellore mb-3" style="">
                        <div class="card-body">
                            <div class="inner">
                                <h3><?php echo $respuesta[0]; ?></h3>
                                <p><?php echo $respuesta[1]; ?></p>
                            </div>
                            <a href="resourses"><div class="icon">
                                <i class="icon-folder-open"></i>
                            </div></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!------------------------------------------------------>
                
            </div>
        </div>
    </div>
</section>