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
         protected function registro_docente_($dato){
             $sql = mainModel::consulta_simple("call registro_docente('".$dato["nombre"]."','".$dato["apellido"]."','".$dato["fecha"]."',".$dato["edad"].",'".$dato["genero"]."','".$dato["usuario"]."','".$dato["clave"]."','".$dato["seccion"]."','".$dato["materia"]."',".$dato["grado"].");");
             return $sql;
         }
         protected function lista_docente_(){
             $sql = mainModel::consulta_simple("select * from lista_docente;");
             return $sql;
         }
         protected function edith_us($dato){
            $sql = mainModel::consulta_simple("call editar_u('".$dato["nombre"]."','".$dato["apellido"]."','".$dato["nacimiento"]."',".$dato["edad"].",".$dato["estado"].",'".$dato["genero"]."','".$dato["usuario"]."','".$dato["codigo"]."','".$dato["pass"]."',".$dato["tipo"].");");
            return $sql;
        }
     }
?>