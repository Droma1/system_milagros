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
        public function registro_alumno(){
            $nombre = mainModel::clear_string($_POST['nombre']);
            $apellido = mainModel::clear_string($_POST['apellido']);
            $fecha = mainModel::clear_string($_POST['f_nacimiento']);
            $edad = mainModel::clear_string($_POST['edad']);
            $genero = mainModel::clear_string($_POST['genero']);
            $usuario = mainModel::clear_string($_POST['usuario']);
            $cl1 = mainModel::clear_string($_POST['cl1']);
            $cl2 = mainModel::clear_string($_POST['cl2']);
            $codigo_d = mainModel::clear_string($_POST['code_docente']);

            if($nombre !="" && $apellido !="" && $fecha!="" && $edad !="" && $genero !="" && $usuario !="" && $cl1 !="" && $cl2 !="" && $codigo_d !=""){
                if($cl1 == $cl2){
                    $alumno = [
                        "docente" => $codigo_d,
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "fecha" => $fecha,
                        "edad" => $edad,
                        "genero" => $genero,
                        "usuario" => $usuario,
                        "clave" => $cl1
                    ];
                    $consulta = alumnoModel::registro_alumno_($alumno);
                    if($consulta->rowCount() >= 1){
                        $alerta = [
                            "Alerta" => "limpiar",
                            "icon" => "success",
                            "title" => "Registro exitoso!",
                            "msg" => "!Su registro fue procesado exitosamente¡."
                        ];
                    }else{
                        $alerta = [
                            "Alerta" => "simple",
                            "icon" => "warning",
                            "title" => "Error al Procesar formulario",
                            "msg" => "se produjo un error al registrar el formulario, profavor verifique en su tabla de esperas..."
                        ];
                    }
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "icon" => "warning",
                        "title" => "Las contraseñas no coinciden",
                        "msg" => "!Verifique que escribio la misma contraseña.¡"
                    ];
                }

            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "icon" => "error",
                    "title" => "Error al Procesar formulario",
                    "msg" => "!Verifique que todos los campos del formulario esten completos.¡"
                ];
            }
            return mainModel::alerts($alerta);
        }
    }
?>