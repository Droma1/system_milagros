
<?php
	if($peticionAjax){
		require_once "../Config/ConfigDB.php";
	}else{
		require_once "./Config/ConfigDB.php";
	}
	
class mainModel{
		protected function conectar(){
			try{
				$link = new PDO(SGBD,USER,PASS);
			}catch (Exeption $e){
                echo "Error al conectar a la base de datos error: ".$e;
                //sleep(10000);
			}
			return $link;
		}
		protected function consulta_simple($consulta){
			$respuesta = self::conectar()->prepare($consulta);
            $respuesta->execute();
            //echo var_dump($respuesta);
            //sleep(50);   
			return $respuesta;
		}
		protected function encryption($string){
			$pass = password_hash($string,PASSWORD_DEFAULT,['cost'=>12]);
			return $pass;
		}
		protected function verify($string,$data){
			$pass = password_verify($string,$data);
			return $pass;
		}
		protected function clear_string($cadena){
			$cadena = trim($cadena);
            $cadena = stripcslashes($cadena);
            $cadena = str_ireplace("<script>","",$cadena);
            $cadena = str_ireplace("</script>","",$cadena);
            $cadena = str_ireplace("<script src","",$cadena);
            $cadena = str_ireplace("<script type=","",$cadena);
            $cadena = str_ireplace("SELECT * FROM","",$cadena);
            $cadena = str_ireplace("DELETE FROM","",$cadena);
            $cadena = str_ireplace("INSERT INTO","",$cadena);
            $cadena = str_ireplace("--","",$cadena);
            $cadena = str_ireplace("^","",$cadena);
            $cadena = str_ireplace("[","",$cadena);
            $cadena = str_ireplace("]","",$cadena);
			$cadena = str_ireplace("==","",$cadena);
			$cadena = str_ireplace("=","",$cadena);

            return $cadena;
		}

		protected function alerts($datos){
			if($datos['Alerta']=="simple"){
				$alerta = "
					<script>
                        Swal.fire({
                            icon: '".$datos['icon']."',
                            title: '".$datos['title']."',
                            text: '".$datos['msg']."'
                        });                   
					</script>
				";
			}elseif ($datos['Alerta']=="recargar") {
				
				$alerta = "
					<script>
						swal.fire({
							title:'".$datos['title']."',
							text:'".$datos['msg']."',
							icon:'".$datos['icon']."',
							confirmButtonText:'Aceptar'
						}).then(function(){
							location.reload();
							});
					</script>
				";
			}elseif ($datos['Alerta']=="limpiar") {
				$alerta = "
					<script>
						swal.fire({
							title:'".$datos['title']."',
							text:'".$datos['msg']."',
							icon:'".$datos['icon']."',
							confirmButtonText:'Aceptar'
						}).then(function(){
							$('.formAjax')[0].reset();
							});
					</script>
				";
			}elseif($datos['Alerta'] == "msg"){
				$alerta = "<script>
							Swal.fire({
								position: 'center',
								icon: '".$datos['icon']."',
								title: '".$datos['title']."',
								text:'".$datos['msg']."',
								showConfirmButton: false,
								timer: 1500
							});
				</script>";
			}
			return $alerta;
		}

    }
    //echo "documento main";
?>