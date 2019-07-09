<?php


session_start();

 $enlace = mysqli_connect("localhost", "root", "", "flatmate");



if(isset($_POST['cargausername'])){
    
    echo $_SESSION['usernameconectado'];
    
}
if(isset($_POST['cargahome'])){
    $usuarioabuscar= $_SESSION['idconectado'];
    $resultado= $enlace->query("SELECT Piso FROM intusersenpiso WHERE User LIKE '$usuarioabuscar'");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
    }
    
        
    if($resultado->num_rows ==0){
    $usuarioabuscar= $_SESSION['idconectado'];
    $resultado= $enlace->query("SELECT Estado FROM presolicitud WHERE Iduser LIKE '$usuarioabuscar'");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
    }
        $estadopresolicitud= $row['Estado'];;
         if($resultado->num_rows ==0){
              echo 'solico';
         }else{
            $resultado= $enlace->query("SELECT Remitente FROM presolicitud WHERE Iduser LIKE '$usuarioabuscar'");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
    }
             $remitenteabuscarensolicitudfinal= $row['Remitente'];
             $resultado= $enlace->query("SELECT ID FROM solicitudes WHERE Remitente=  $remitenteabuscarensolicitudfinal");
        
            if($resultado->num_rows ==0){
                echo $estadopresolicitud;
                
            }else{
                echo 3;
            }
             
             
             
             
         }
       
    }else{
        $idpisoacargar= $row['Piso'];
        $resultado= $enlace->query("SELECT Configurado FROM piso WHERE ID = $idpisoacargar");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
    }
        if($row['Configurado']==0){
             echo 4;
        }else{
             $resultado= $enlace->query("SELECT * FROM piso WHERE ID = $idpisoacargar");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
    }
            $_SESSION['pisoenfuncionamiento']= $row;
             echo 5;
        }
       
    }
    
}
if(isset($_POST['conexion'])){
 
   echo 'responde';
}
if(isset($_POST['cierrasesion'])){
 session_destroy();
   echo 'cerrada';
}

?>
