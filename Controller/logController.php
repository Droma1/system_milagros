<?php
    if($peticionAjax){
        require_once "../Model/logModel.php";
    }else{
        require_once "./Model/logModel.php";
    }

    class logController extends logModel{
        public function log_Controller(){
            $usuario = mainModel::clear_string($_POST['usuario_log']);
            $clave = mainModel::clear_string($_POST['clave_log']);

            if($clave != "" && $usuario!=""){
                $clave_c = mainModel::consulta_simple("select clave from persona where usuario = '$usuario';");
                if($clave_c->rowCount() >=1){
                    $verif_c = $clave_c->fetch();
                    $verif = (array) $verif_c;
                    #echo $verif['clave'];
                    $clave_v = $verif['clave'];
                    if($clave == $verif['clave']){
                        #echo $usuario;
                        #echo $clave;
                        //session_start(['name'=>'RSM']);
                        $tipo_usuario = logModel::log_Model($usuario);
                        $tipo_usuario2 = (array) $tipo_usuario->fetch();
                        $_SESSION['tipo_user'] = $tipo_usuario2[0];

                        if(substr($_SESSION['tipo_user'],0,2) == "DC"){
                            $url = SERVERURL."home";
                        }else if(substr($_SESSION['tipo_user'],0,2) == "AL"){
                            $url = SERVERURL."home";
                        }else{
                            $url = SERVERURL."home";
                        }
                        $alerta = [
                            "Alerta" => "msg",
                            "icon" => "success",
                            "title" => "Accediendo",
                            "msg" => "Verificación de datos exitosa."
                        ];
                        return $urllocation =  mainModel::alerts($alerta).'<script> window.location="'.$url.'" </script>';
                        
                        
                    }else{
                        $alerta = [
                            "Alerta" => "msg",
                            "icon" => "warning",
                            "title" => "Error inesperado",
                            "msg" => "Las contraseñas no coinciden."
                        ];
                    }
                }else{
                    $alerta = [
                        "Alerta" => "msg",
                        "icon" => "error",
                        "title" => "Operacion Fallida",
                        "msg" => "No se encontraron coincidencias."
                    ];
                }
                
            }else{
                $alerta = [
                    "Alerta" => "msg",
                    "icon" => "warning",
                    "title" => "Error inesperado",
                    "msg" => "Complete los campos para la verificacion."
                ];
            }
            return mainModel::alerts($alerta);
        }
    }
?>