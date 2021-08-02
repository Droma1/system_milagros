<?php 
//echo "hello home page";
?>
<!DOCTYPE html>
<html lang="es">
<head>
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
</html>