<?php 
    $peticionAjax = true;
    require_once "../Config/Config_general.php";
    require_once "../Controller/alumnoController.php";
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['f_nacimiento']) && isset($_POST['edad']) && isset($_POST['genero']) && isset($_POST['usuario']) && isset($_POST['cl1']) && isset($_POST['cl2']) ){
        $registro = new alumnoController();
        echo $registro->registro_alumno();
    }else{
        echo "Problemas al procesar formulario";
    }
?>