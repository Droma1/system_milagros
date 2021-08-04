<?php 
	class viewModel{
		protected function view_Model($vistas){
			$listaBlanca=["home","search","login","index","resourses","perfil","registro","publish","observed","pending","removed","reading","edith","publishAlumno","observedAlumno","pendingAlumno","removedAlumno","registroAlumno","registroDocente","listaAlumno","listaDocente"];
			$listaAlmacen=[];
			
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./View/Contents/".$vistas."-view.php")){
					$contenido="./View/Contents/".$vistas."-view.php";
				}else{
					$contenido="home";
				}
			}else{
				$contenido="./View/Contents/404.php";
			}
			return $contenido;
		}
	}
?>