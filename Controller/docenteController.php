<?php
    if($peticionAjax){
        require_once "../Model/docenteModel.php";
    }else{
        require_once "./Model/docenteModel.php";
    }
    class docenteController extends docenteModel{
        public function publish_personaC($dato){
            $resultado = docenteModel::publish_persona($dato);
            return $resultado;
        }
        public function perfil_docente($dato){
            $resultado = docenteModel::docente_perfil_model($dato);
            return $resultado;
        }
    }
?>