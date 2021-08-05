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
        public function registro_archivo(){
            $titulo = mainModel::clear_string($_POST['nombre_file']);
            $tema = mainModel::clear_string($_POST['tipo']);
            $grado = mainModel::clear_string($_POST['grado']);
            $seccion = mainModel::clear_string($_POST['seccion']);
            $formato = mainModel::clear_string($_POST['formato']);
            $fecha = mainModel::clear_string($_POST['fecha_s']);
            $curso = mainModel::clear_string($_POST['curso']);
            $curso = "%".$curso."%";
            $user = mainModel::clear_string($_POST['codigo']);
            $descrip = mainModel::clear_string($_POST['decrip_file']);
            $F1_name = $_FILES['file-6']['name'];
                //echo $F1_name;
                if($F1_name !=""){
                    try{
                        $type=$_FILES['file-6']['type'];
                        $tmp_name = $_FILES['file-6']["tmp_name"];
                        $name = $_FILES['file-6']["name"];
                        $name = preg_replace('/\s+/', '', $name);
                        $nuevo_path= "../View/resources/".$name;
                        //echo $nuevo_path;
                        move_uploaded_file($tmp_name,$nuevo_path);
                        $array=explode('.',$nuevo_path);
                        $ruta1 = $nuevo_path;
                        $arch=$name;
                        $ext= end($array);
                    }catch(Exception $e){
                        $arch = "";
                    }

                }else{
                    $arch = "";
                }
                if($titulo != "" && $tema != "" && $grado !="" && $seccion !="" && $formato !="" && $fecha !="" && $curso !="" && $user!="" && $descrip !=""){
                    $upload = [
                        "file" => $arch,
                        "titulo" => $titulo,
                        "tema" => $tema,
                        "grado" => $grado,
                        "seccion" => $seccion,
                        "formato" => $formato,
                        "fecha" => $fecha,
                        "curso" => $curso,
                        "usuario" => $user,
                        "descript" => $descrip
                    ];
                    $query = docenteModel::upload_resorce($upload);
                    if($query->rowCount()>=1){
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
                        "icon" => "error",
                        "title" => "Error al Procesar formulario",
                        "msg" => "!Verifique que todos los campos del formulario esten completos.¡"
                    ];
                }
                return mainModel::alerts($alerta);
        }
        public function registro_docente(){
            $nombre = mainModel::clear_string($_POST['nombre_d']);
            $apellido = mainModel::clear_string($_POST['apellido_d']);
            $fecha = mainModel::clear_string($_POST['f_nacimiento_d']);
            $edad = mainModel::clear_string($_POST['edad_d']);
            $genero = mainModel::clear_string($_POST['genero_d']);
            $usuario = mainModel::clear_string($_POST['usuario_d']);
            $cl1 = mainModel::clear_string($_POST['cl1_d']);
            $cl2 = mainModel::clear_string($_POST['cl2_d']);
            $seccion = mainModel::clear_string($_POST['seccion_d']);
            $materia = mainModel::clear_string($_POST['materia_d']);
            $materia = "%".$materia."%";
            $grado = mainModel::clear_string($_POST['grado_d']);

            if($nombre !="" && $apellido !="" && $fecha!="" && $edad !="" && $genero !="" && $usuario !="" && $cl1 !="" && $cl2 !="" && $seccion !="" && $materia !="" && $grado!=""){
                if($cl1 == $cl2){
                    $docente = [
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "fecha" => $fecha,
                        "edad" => $edad,
                        "genero" => $genero,
                        "usuario" => $usuario,
                        "clave" => $cl1,
                        "seccion" => $seccion,
                        "materia" => $materia,
                        "grado" => $grado
                    ];
                    $consulta = docenteModel::registro_docente_($docente);
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
        public function lista_docente(){
            $consulta = docenteModel::lista_docente_();
            return $consulta;
        }
    }
?>