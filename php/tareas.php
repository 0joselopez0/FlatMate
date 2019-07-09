<?php
session_start();
$enlace = mysqli_connect("localhost", "root", "", "flatmate");

if(isset($_POST['cargatareas'])){
     $fullpiso= $_SESSION['pisoenfuncionamiento'];
    $pisoabuscar= $fullpiso['ID'];
    $resultado= $enlace->query("SELECT * FROM intasignaciones WHERE Piso= $pisoabuscar ");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
         array_push($row, $r);
    }
    
   echo json_encode($row); 
}
    
  if(isset($_POST['cargatareasuseractivo'])){
     $fullpiso= $_SESSION['pisoenfuncionamiento'];
    $pisoabuscar= $fullpiso['ID'];
    $userabuscar= $_SESSION['idconectado'];
    $resultado= $enlace->query("SELECT * FROM intasignaciones WHERE User= $userabuscar ");
        $row= [];
        while($r= $resultado->fetch_assoc()) {
         array_push($row, $r);
    }
    
   echo json_encode($row); 
}  
    
    
    ?>