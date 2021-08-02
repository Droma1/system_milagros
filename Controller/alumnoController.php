<?php
    if($peticionAjax){
        require_once "../Model/alumnoModel.php";
    }else{
        require_once "./Model/alumnoModel.php";
    }
    class alumnoController extends alumnoModel{
        public function publish_personaA($dato){
            $resultado = alumnoModel::publish_persona_($dato);
            return $resultado;
        }
        public function perfil_alumno($dato){
            $resultado = alumnoModel::alumno_perfil_model($dato);
            return $resultado;
        }
    }
?>