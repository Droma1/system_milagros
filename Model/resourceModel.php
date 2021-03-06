<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
     class resourceModel extends mainModel{
         protected function resources(){
             $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1;");
             return $sql;
         }
         protected function filtrer($dato1,$dato2,$dato3,$dato4){
            if($dato4 == 2){
                if($dato1 == "Todos"){
                    $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1 and nombre_materia like '%".$dato2."%' and nombre_categoria like '%".$dato3."%';");
                 }else{
                    //echo $dato2;
                $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1 and text_grado like '%".$dato1."%' and  nombre_materia like '%".$dato2."%' and nombre_categoria like '%".$dato3."%';");
                 }
            }else{
                $id = mainModel::consulta_simple("call obtener_persona ('".$dato4."');");
                $id2 = $id->fetch();
                if($dato1 == "Todos"){
                    $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1 and nombre_materia like '%".$dato2."%' and nombre_categoria like '%".$dato3."%' and id_persona = ".$id2[0].";");
                 }else{
                    //echo $dato2;
                $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1 and text_grado like '%".$dato1."%' and  nombre_materia like '%".$dato2."%' and nombre_categoria like '%".$dato3."%' and id_persona = ".$id2[0].";");
                 }
            }
             return $sql;
         }
         protected function filtrern($dato1,$dato2,$dato3){
            if($dato1 == "Todos"){
                $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1 and nombre_materia like '%".$dato2."%' and nombre_categoria like '%".$dato3."%';");
             }else{
                //echo $dato2;
            $sql = mainModel::consulta_simple("select * from resourses_view where estado = 1 and text_grado like '%".$dato1."%' and  nombre_materia like '%".$dato2."%' and nombre_categoria like '%".$dato3."%';");
             }
            return $sql;
        }
        protected function tipo_m(){
            $sql = mainModel::consulta_simple("select nombre_categoria from categoria_archivo;");
            return $sql;
        }
        protected function grado_m(){
            $sql = mainModel::consulta_simple("select text_grado from grado order by text_grado desc;");
            return $sql;
        }
        protected function materias_m(){
            $sql = mainModel::consulta_simple("select nombre_materia from materia group by nombre_materia;");
            return $sql;
        }
        protected function category_(){
            $sql = mainModel::consulta_simple("select * from category;");
            return $sql;
        }
        protected function count_resources_M($dato){
            $sql = mainModel::consulta_simple("call count_resources('".$dato."');");
            return $sql;
        }
        protected function my_resources_m($dato1,$dato2){
            $sql = mainModel::consulta_simple("call my_resources('".$dato1."',".$dato2.");");
            return $sql;
        }
        protected function reading_m($dato){
            $sql = mainModel::consulta_simple("select * from reading where id_archivo = ".$dato.";");
            return $sql;
        }
        protected function curso_alumno($dato){
            $sql = mainModel::consulta_simple("call curses('".$dato."');");
            return $sql;
        }
        protected function upload_resource($dato){
            $sql = mainModel::consulta_simple("call registro_resource('".$dato["file"]."','%".$dato["tipo"]."%','".$dato["title"]."',".$dato["curse"].",'".$dato["date"]."','".$dato["user"]."','".$dato["descript"]."','%".$dato["formate"]."%');");
            return $sql;
        }
        protected function edith_v($dato){
            $sql = mainModel::consulta_simple("select * from edith_view where id_archivo = ".$dato.";");
            return $sql;
        }
        protected function counters_(){
            $sql = mainModel::consulta_simple("call counters();");
            return $sql;
        }
        protected function publish_a(){
            $sql = mainModel::consulta_simple("select * from resource_alum where estado = 1;");
            return $sql;
        }
        protected function observerd_a(){
            $sql = mainModel::consulta_simple("select * from resource_alum where estado = 2;");
            return $sql;
        }
        protected function pending_a(){
            $sql = mainModel::consulta_simple("select * from resource_alum where estado = 3;");
            return $sql;
        }
        protected function remov_a(){
            $sql = mainModel::consulta_simple("select * from resource_alum where estado = 4;");
            return $sql;
        }
        protected function grado_r(){
            $sql = mainModel::consulta_simple("select id_grado,text_grado,nro_grado from grado order by nro_grado asc;");
            return $sql;
        }
        protected function edith_file_($dato){
            $sql = mainModel::consulta_simple("call editar_archivo('".$dato["titulo"]."','".$dato["descript"]."','".$dato["fecha"]."',".$dato["estado"].",".$dato["id"].");");
            return $sql;
        }
     }
?>