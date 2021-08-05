<?php 
    $peticionAjax = true;
    require_once "../Config/Config_general.php";
    require_once "../Controller/docenteController.php";
    $registro = new docenteController();
    if(isset($_POST['formato']) && isset($_POST['grado']) && isset($_POST['seccion']) && isset($_FILES['file-6']['name']) && isset($_POST['tipo']) && isset($_POST['nombre_file']) && isset($_POST['curso']) && isset($_POST['fecha_s']) && isset($_POST['codigo']) && isset($_POST['decrip_file'])){
        
        echo $registro->registro_archivo();
    }elseif(isset($_POST['nombre_d']) && isset($_POST['apellido_d']) && isset($_POST['f_nacimiento_d']) && isset($_POST['edad_d']) && isset($_POST['genero_d']) && isset($_POST['usuario_d']) && isset($_POST['cl1_d']) && isset($_POST['cl2_d']) && isset($_POST['seccion_d']) && isset($_POST['materia_d']) && isset($_POST['grado_d'])){
        echo $registro->registro_docente();
    }else{
        echo "Problemas al procesar formulario";
    }
?>