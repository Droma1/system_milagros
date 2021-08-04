<?php
    $peticionAjax = true;
    require_once "../Config/Config_general.php";
    require_once "../Controller/resourceController.php";

    if(isset($_POST['cod_user'])){
        $consulta = new resourceController();
        echo  $consulta->filtrer_c();
        
    }elseif(isset($_POST['formato']) && isset($_FILES['file-6']['name']) && isset($_POST['tipo']) && isset($_POST['nombre_file']) && isset($_POST['curso']) && isset($_POST['fecha_s']) && isset($_POST['codigo']) && isset($_POST['decrip_file'])){
        $consulta = new resourceController();
        echo $consulta->registro_resource($_FILES['file-6']['name'],$_POST['tipo'],$_POST['nombre_file'],$_POST['curso'],$_POST['fecha_s'],$_POST['codigo'],$_POST['decrip_file'], $_POST['formato']);
    }else{
        $consulta = new resourceController();
        echo  $consulta->filtrer2();
        
    }
?>