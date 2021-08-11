<?php 
//echo "hello home page";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</link>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<?php include "./View/Contents/scripts.php"; ?>
    <title><?php echo COMPANY; ?></title>
</head>
<body>
<?php
    $peticionAjax = false;
    require_once "./Controller/ViewController.php";

        $vt = new viewController();
		$vistasR=$vt->view_Controller();
        session_start(['name'=>'RSM']);
        //echo $vistasR;
        #$_SESSION["beta"] = "beta";
        #echo $_SESSION["beta"];
        #echo $_SESSION['tipo_user'];
        if(!isset($_SESSION['tipo_user']) && $vistasR!=null){
            #var_dump( $_SESSION['tipo_user']);
            include "./View/Contents/inicio.php";
            switch($vistasR){
                case 'home':
                include "./View/Contents/category.php";
                /********************************** */
                break;
                default:
                include $vistasR;
                break;
            }
            
        }else{
            if($_GET['page'] == "Out"){
                $_SESSION["tipo_user"] = null;
                
                echo '<script> window.location="'.SERVERURL.'" </script>';
                
            }
            if(substr($_SESSION['tipo_user'],0,2) == "DC"){
                include "./View/Contents/admin-view.php";
                switch($vistasR){
                    case 'home':
                        include "./View/Contents/category.php";
                    break;
                    case 'docente':
                        include "./View/Contents/category.php";
                    break;
                    default:
                    include $vistasR;
                    break;
                }
            }elseif(substr($_SESSION['tipo_user'],0,2) == "AL"){
                include "./View/Contents/alumno-view.php";
                switch($vistasR){
                    case 'home':
                        include "./View/Contents/category.php";
                    break;
                    case 'docente':
                        include "./View/Contents/category.php";
                    break;
                    default:
                    include $vistasR;
                    break;
                }
            }else{
                echo "admin";
            }
            
        }
?>
    
</body>
<div>
<br></br><br></br><br></br>
</div>
  <footer
          class="footer"
         
          >
     <!--  class="text-center text-lg-start text-white"
          style="background-color: #8c64da "
             
         style="background-image: url('../img/pattren-top.png')"-->
   
    <div class="container p-4 pb-0" >
  
      <section class="">
     
        <div class="row">
         
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              Colegio Milagros
            </h6>
            <p style="text-align:justify">
            La Institución educativa Colegio Señor De Los Milagros,
             es hablar más que una Institución, es un contexto de 
             familia, un equipo de profesionales altamente eficientes.
            </p>
          </div>
     

          <hr class="w-100 clearfix d-md-none" />

   

          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
            <p><i class="fas fa-home mr-3"></i> Av. Circunvalacion 456</p>
            <p><i class="fas fa-envelope mr-3"></i> milagroscoleg@gmail.edu.pe</p>
            <p><i class="fas fa-phone mr-3"></i>956858</p>
            <p><i class="fas fa-print mr-3"></i>958649847</p>
          </div>
 
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Siguenos</h6>

            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #3b5998"
               href="#!"
               role="button"
               ><i class="fab fa-facebook-f"></i
              ></a>

          
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #55acee"
               href="#!"
               role="button"
               ><i class="fab fa-twitter"></i
              ></a>

            
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #dd4b39"
               href="#!"
               role="button"
               ><i class="fab fa-google"></i
              ></a>

            
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #ac2bac"
               href="#!"
               role="button"
               ><i class="fab fa-instagram"></i
              ></a>

            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #0082ca"
               href="#!"
               role="button"
               ><i class="fab fa-linkedin-in"></i
              ></a>
          
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #333333"
               href="#!"
               role="button"
               ><i class="fab fa-github"></i
              ></a>
          </div>
        </div>
       
      </section>
      
    </div>
   

    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2021 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/"
         >Unamad</a
        >
    </div>
    
  </footer>
  

</html>