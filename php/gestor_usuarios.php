<?php 

$enlace = mysqli_connect("localhost", "root", "", "flatmate");

if(isset($_POST['usuariologeo'])){
    $usuarioabuscar= $_POST['usuariologeo'];
$clave= md5($_POST['passlogeo']);
    if($enlace){
        
        
     $resultado= $enlace->query("SELECT ID, Username, Pass FROM users WHERE Username LIKE '$usuarioabuscar'");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
    }
        
    if($resultado->num_rows !=0 && $row['Pass']== $clave){
        echo 'Entra al sistema';
        session_start();
        $_SESSION['usernameconectado']= $row['Username'];
        $_SESSION['idconectado']= $row['ID'];
    
       
    }else if($resultado->num_rows !=0 && $row['Pass']!= $clave){
         echo 'Usuario o contraseña incorrectos';
    }else{
        
        echo 'Usuario no existente';
    }
        
        
        
    }else{
        
        echo 'Hubo un problema con la red, ¡inténtalo otra vez!';
    }
    
    
    
    
    
}
if(isset($_POST['pideid'])){
    session_start();
    $idconected= $_SESSION['idconectado'];
    echo $idconected ;
    
    
}
if(isset($_POST['usuarioregistro'])){
     $usuarioabuscar= $_POST['usuarioregistro'];
$clave= md5($_POST['passregistro']);
    $mail= $_POST['mailregistro'];
    if($enlace){
        
        
     $resultado= $enlace->query("SELECT ID, Username, Pass FROM users WHERE Username LIKE '$usuarioabuscar'");
        
        
    if($resultado->num_rows !=0){
       echo 'El usuario ya existe';
    
       
    }else{
        
    if($enlace->query("INSERT INTO users (Username,Mail,Pass) VALUES ('$usuarioabuscar','$mail', '$clave')")){
      echo 'Todo correcto, ¡Bienvenido a FlatMate!';  
    }else{
        echo 'Hubo un problema con el registro ¡Inténtalo de nuevo!';
    }
    }
        
        
        
    }else{
        
        echo 'Hubo un problema con la red, ¡inténtalo otra vez!';
    }
    
    
    
    
    
}

if(isset($_POST['comprobarsesion'])){
    

}


?>
