<?php
    $peticionAjax = true;
    require_once "../Config/Config_general.php";
    require_once "../Controller/resourceController.php";
    $consulta = new resourceController();
    if(isset($_POST['cod_user'])){
        echo  $consulta->filtrer_c();
        
    }elseif(isset($_POST['formato']) && isset($_FILES['file-6']['name']) && isset($_POST['tipo']) && isset($_POST['nombre_file']) && isset($_POST['curso']) && isset($_POST['fecha_s']) && isset($_POST['codigo']) && isset($_POST['decrip_file'])){
        echo $consulta->registro_resource($_FILES['file-6']['name'],$_POST['tipo'],$_POST['nombre_file'],$_POST['curso'],$_POST['fecha_s'],$_POST['codigo'],$_POST['decrip_file'], $_POST['formato']);
    }elseif(isset($_POST['id_a'])){
        echo $consulta->edith_file();
    }else{
        $consulta = new resourceController();
        echo  $consulta->filtrer2();
        
    }
?>