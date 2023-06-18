<?php session_start();

if($_POST){
    include("./bd.php");
     //recepcionamos los valores del formulario
     $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
     $password=(isset($_POST['password']))?$_POST['password']:"";

    //SELECCIONAR REGISTROS
    $sentencia= $conexion->prepare("SELECT *, count(*) as n_usuario
     FROM `tbl_usuarios` 
     WHERE usuario=:usuario
     AND password=:password
     ");
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->execute();

    $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);
  
    if($lista_usuarios['n_usuario']>0){
        $_SESSION['usuario']=$lista_usuarios['usuario'];
        $_SESSION['logueado']=true;
        header("Location: index.php");
    }else{
        $mensaje="ERROR: El usuario o la contraseña son incorrectas";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">        
        <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
    </head>
    <body>
      <div class="container-login">
        <div class="wrap-login">
       <?php if(isset($mensaje)){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         <strong><?php echo $mensaje ?></strong>
       </div>       
       <?php } ?>
            <form action="" method="post" enctype="multipart/form-data">
            <span class="login-form-title">LOGIN</span>
                
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                    <button type="submit" name="" class="login-form-btn">Entrar</button> 
                      
                    </div>
                </div>
            </form>
        </div>
    </div>     
     <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="popper/popper.min.js"></script>    
        
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    
     <script src="codigo.js"></script>    
    </body>

</html>