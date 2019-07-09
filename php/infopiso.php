<?php
session_start();
 $enlace = mysqli_connect("localhost", "root", "", "flatmate");
if(isset($_POST['buscarcolega'])){
     $usuarioabuscar= $_POST['buscarcolega'];
    
    $resultado= $enlace->query("SELECT ID, Username FROM users WHERE Username LIKE '$usuarioabuscar%'");
        
        
    if($resultado->num_rows ==0){
        echo 'nohaycolegas';
    }else{
        $row= [];
        while($r= $resultado->fetch_assoc()) {
        array_push($row,$r);
    }
        echo json_encode($row);
    }
    
}
if(isset($_POST['prepeticion'])){
    $usuariosprepeticion= $_POST['prepeticion'];
    $elconectado= $_SESSION['idconectado'];
     if($enlace->query("INSERT INTO presolicitud (Iduser,Estado, Remitente) VALUES ('$elconectado', 1,'$elconectado')")){} 
    for($i=0; $i<count($usuariosprepeticion); $i++){
        if($_SESSION['idconectado']== $usuariosprepeticion[$i]){
           
        }else{
             if($enlace->query("INSERT INTO presolicitud (Iduser,Estado,Remitente) VALUES ('$usuariosprepeticion[$i]', 0, '$elconectado')")){}  
            
        }
        
        
    }
    echo 'yata';
}
if(isset($_POST['aceptacompanero'])){
    $usuarioqueacepta= $_SESSION['idconectado'];
     if($enlace->query("UPDATE presolicitud SET Estado= 1 WHERE Iduser LIKE '$usuarioqueacepta'")){
         echo 'aceptada';
         
     }
    $resultado= $enlace->query("SELECT Remitente FROM presolicitud WHERE Iduser= $usuarioqueacepta ");
    $row= [];
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
        }
   
    $remitente= $row['Remitente'];
    
     $resultado= $enlace->query("SELECT Estado FROM presolicitud WHERE Remitente= $remitente");
    $row= [];
    
    $confirmacioncompaneros= true;
        while($r= $resultado->fetch_assoc()) {
        if($r['Estado']==0){
            $confirmacioncompaneros= false;
            
        }
        }
    if($confirmacioncompaneros){
        $enlace->query("INSERT INTO solicitudes (Remitente) VALUES ($remitente)");
         $resultado= $enlace->query("SELECT ID FROM solicitudes WHERE Remitente= $remitente");
         $row= [];
    
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
        }
        $idsolicitudfinal= $row['ID'];
        $enlace->query("UPDATE presolicitud SET Solicitud= $idsolicitudfinal WHERE Remitente= $remitente");
    }
    
            
}
if(isset($_POST['yaconfigurado'])){
    $pisoyaconfigurado= json_decode($_POST['yaconfigurado']);
    $usuarioconectado=$_SESSION['idconectado'];
    $resultado= $enlace->query("SELECT Piso FROM intusersenpiso WHERE User= $usuarioconectado");
         $row= [];
    
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
        }
        $idpisosolicitudfinal= $row['Piso'];
    if($pisoyaconfigurado->inventarionevera=="Sólo inventario"){
        $nevera=0;
        $inventario=1;
    }else if($pisoyaconfigurado->inventarionevera=="Sólo nevera"){
        $nevera=1;
        $inventario=0;
    }else if($pisoyaconfigurado->inventarionevera=="Ambos"){
        $nevera=1;
        $inventario=1;
    }else{
         $nevera=0;
        $inventario=0;
    }
    if($pisoyaconfigurado->bote== "Físico"){
        $bote= 1;
    }else if($pisoyaconfigurado->bote=="Débito"){
        $bote= 2;
    }else{
        $bote=0;
    }
    $mensualidad= (int)$pisoyaconfigurado->mensualidad;
    $fechapago= (int)$pisoyaconfigurado->fechadepago;
    $enlace->query("UPDATE piso SET Nombre= '$pisoyaconfigurado->nombrepiso', Bote= $bote, Direccion= '$pisoyaconfigurado->dirpiso', mensualidad= $mensualidad, Fechapago= $fechapago, Inventario= $inventario, Nevera= $nevera, Configurado= 1  WHERE ID= $idpisosolicitudfinal ");
   echo $enlace->error;
    echo $pisoyaconfigurado->tareas[1]->nombre;
    
    for($i=0; $i< sizeof($pisoyaconfigurado->tareas); $i++){
         $nombredetarea=$pisoyaconfigurado->tareas[$i]->nombre;
    $repeticiondetarea=(int)$pisoyaconfigurado->tareas[$i]->repeticiones;
    $pesodetarea=(int)$pisoyaconfigurado->tareas[$i]->peso;
    
     $enlace->query("INSERT INTO inttareasenpiso (Piso, Tarea, Repeticion, Peso) VALUES ($idpisosolicitudfinal, '$nombredetarea', $repeticiondetarea, $pesodetarea)");  
        echo $enlace->error;
    }
    $resultado= $enlace->query("SELECT Remitente FROM presolicitud WHERE Iduser= $usuarioconectado");
         $row= [];
    
        while($r= $resultado->fetch_assoc()) {
        $row= $r;
        }
    $remitenteinsertbote=$row['Remitente'];
     $resultado= $enlace->query("SELECT Iduser FROM presolicitud WHERE Remitente= $remitenteinsertbote");
        
    
        while($r= $resultado->fetch_assoc()) {
        $userinsertarbote= $r['Iduser'];
        $enlace->query("INSERT INTO intusersinbote (Piso, User, Dinero) VALUES ($idpisosolicitudfinal, $userinsertarbote, 0)");  
        }
    
}
if(isset($_POST['cargafullpiso'])){
    
    $pisofuncionando= $_SESSION['pisoenfuncionamiento'];
    
    echo json_encode($pisofuncionando);
}
    
?>
