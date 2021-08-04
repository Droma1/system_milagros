<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
     class docenteModel extends mainModel{
         protected function publish_persona($dato){
             $sql = mainModel::consulta_simple("call resourse_persona('".$dato."');");
             return $sql;
         }
         protected function docente_perfil_model($dato){
             $sql = mainModel::consulta_simple("select * from perfil_docente where codigo_docente = '".$dato."';");
             return $sql;
         }
         protected function upload_resorce($dato){
             $sql = mainModel::consulta_simple("call registro_resource_d('".$dato["file"]."','".$dato["titulo"]."','".$dato["tema"]."',".$dato["grado"].",'".$dato["seccion"]."','".$dato["formato"]."','".$dato["fecha"]."','".$dato["curso"]."','".$dato["usuario"]."','".$dato["descript"]."');");
             return $sql;
         }
     }
?>