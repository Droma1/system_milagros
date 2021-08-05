<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
     class alumnoModel extends mainModel{
         protected function publish_persona_($dato){
             $sql = mainModel::consulta_simple("call resourse_persona('".$dato."');");
             return $sql;
         }
         protected function alumno_perfil_model($dato){
             $sql = mainModel::consulta_simple("select * from perfil_alumno where codigo_alumno = '".$dato."';");
             return $sql;
         }
         protected function registro_alumno_($dato){
             $sql = mainModel::consulta_simple("call registro_alumno('".$dato["docente"]."','".$dato["nombre"]."','".$dato["apellido"]."','".$dato["fecha"]."',".$dato["edad"].",'".$dato["genero"]."','".$dato["usuario"]."','".$dato["clave"]."');");
             return $sql;
         }
         protected function lista_alumno_($dato){
             $sql = mainModel::consulta_simple("call lista_alumno('".$dato."');");
             return $sql;
         }
     }
?>