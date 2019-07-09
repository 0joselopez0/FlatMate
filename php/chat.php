<?php

session_start();
$enlace = mysqli_connect("localhost", "root", "", "flatmate");

if(isset($_POST['cargarchats'])){
    mysqli_set_charset($enlace,"utf8");
    $userabuscar= $_SESSION['idconectado'];
    $resultado= $enlace->query("SELECT * FROM chat WHERE Destino= $userabuscar OR Remitente= $userabuscar ");
    
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        
        array_push($row, $r);
        
            
    }
$retorno= json_encode($row, JSON_UNESCAPED_UNICODE );
    echo $retorno;
    
}
if(isset($_POST['enviarmsj'])){
    $destino= $_POST['destino'];
    $usuarioconectado= $_SESSION['idconectado'];
    $msg= $_POST['msj'];
    if($enlace->query("INSERT INTO chat (Remitente, Destino, Mensaje) VALUES ($usuarioconectado, $destino, '$msg')")){
        echo 'chachi';
    }
                    
    
    
}
    
    ?>