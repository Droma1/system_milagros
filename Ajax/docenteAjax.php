<?php 
    $peticionAjax = true;
    require_once "../Config/Config_general.php";
    require_once "../Controller/docenteController.php";
    if(isset($_POST['formato']) && isset($_POST['grado']) && isset($_POST['seccion']) && isset($_FILES['file-6']['name']) && isset($_POST['tipo']) && isset($_POST['nombre_file']) && isset($_POST['curso']) && isset($_POST['fecha_s']) && isset($_POST['codigo']) && isset($_POST['decrip_file'])){
        $registro = new docenteController();
        echo $registro->registro_archivo();
    }else{
        echo "Problemas al procesar formulario";
    }
?>