<?php
    if($peticionAjax){
        require_once "../Model/resourceModel.php";
    }else{
        require_once "./Model/resourceModel.php";
    }
    class resourceController extends resourceModel{
        public function resources_c(){
            $resultado = resourceModel::resources();
            return $resultado;
        }
        public function tipo(){
            $resultado = resourceModel::tipo_m();
            return $resultado;
        }
        public function grado(){
            $resultado = resourceModel::grado_m();
            return $resultado;
        }
        public function materias(){
            $resultado = resourceModel::materias_m();
            return $resultado;
        }
        public function category(){
            $sql = resourceModel::category_();
            return $sql;
        }
        public function filtrer_c($dato1,$dato2,$dato3,$dato4){
            $grado = mainModel::clear_string($dato1);
            $materia = mainModel::clear_string($dato2);
            $tipo = mainModel::clear_string($dato3);
            $codigo = mainModel::clear_string($dato4);
            $resultado = resourceModel::filtrer($grado,$materia,$tipo,$codigo);
            return $resultado;
        }
        public function filtrer2($dato1,$dato2,$dato3){
            $grado = mainModel::clear_string($dato1);
            $materia = mainModel::clear_string($dato2);
            $tipo = mainModel::clear_string($dato3);
            try{
                $resultado = resourceModel::filtrern($grado,$materia,$tipo);
            }catch (Ecaption $e){
                echo $e;
            }

            return $resultado;
        }
        public function count_resources($dato){
            $codigo = mainModel::clear_string($dato);
            $resultado = resourceModel::count_resources_M($codigo);
            return $resultado;
        }
        public function my_resources($dato1,$dato2){
            $code = mainModel::clear_string($dato1);
            $type = mainModel::clear_string($dato2);
            $resultado = resourceModel::my_resources_m($code,$type);
            return $resultado;
        }
        public function reading($dato){
            $id = mainModel::clear_string($dato);
            $resultado = resourceModel::reading_m($id);
            return $resultado;
        }
        public function curse($dato){
            $cod = mainModel::clear_string($dato);
            $resp = resourceModel::curso_alumno($cod);
            return $resp;
        }
        public function registro_resource($dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$dato7,$dato8){
            //$file = mainModel::clear_string($dato1);
            $tipo = mainModel::clear_string($dato2);
            $title = mainModel::clear_string($dato3);
            $curse = mainModel::clear_string($dato4); // se envia el ID del curso
            $date_upload = mainModel::clear_string($dato5); 
            $code_user = mainModel::clear_string($dato6); //codigo del usuario que registra el recurso
            $descrtipt = mainModel::clear_string($dato7);
            $formato = mainModel::clear_string($dato8);

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
                if($tipo !="" && $title !="" && $curse != "" && $date_upload != "" && $code_user != "" && $descrtipt != "" && $formato != ""){
                    $upload = [
                        "file" => $arch,
                        "tipo" => $tipo,
                        "title" => $title,
                        "curse" => $curse,
                        "date" => $date_upload,
                        "user" => $code_user,
                        "descript" => $descrtipt,
                        "formate" => $formato
                    ];
                    $sending = resourceModel::upload_resource($upload);
                    if($sending->rowCount()>=1){
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
        public function edith_view($dato){
            $consulta = resourceModel::edith_v($dato);
            return $consulta;
        }
        public function counters(){
            $consulta = resourceModel::counters_();
            return $consulta;
        }
    }
?>