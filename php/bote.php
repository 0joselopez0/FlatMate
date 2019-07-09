<?php

session_start();
 $enlace = mysqli_connect("localhost", "root", "", "flatmate");
if(isset($_POST['cargabote'])){
    $usuarioconectado= $_SESSION['idconectado'];
    $row=[];
     $resultado= $enlace->query("SELECT Dinero FROM intusersinbote WHERE User= $usuarioconectado");
    echo $enlace->error;
        while($r= $resultado->fetch_assoc()) {
       $row =$r;
        
    }
    $dinerodelconectado= $row['Dinero'];
    $_SESSION['dinerodelconectado']= $dinerodelconectado;
    $row= [];
    $fullpiso= $_SESSION['pisoenfuncionamiento'];
    $idpiso= $fullpiso['ID'];
    $bote= array('Tipodebote' => $fullpiso['Bote']);
    array_push($row, $bote);
    $resultado= $enlace->query("SELECT intusersinbote.Dinero, intusersinbote.User, users.Username  FROM intusersinbote INNER JOIN users ON intusersinbote.User = users.ID WHERE Piso= $idpiso");
    echo $enlace->error;
        while($r= $resultado->fetch_assoc()) {
        array_push($row, $r);
        
    }
echo json_encode($row);

}


if(isset($_POST['ingreso'])){
    $usuarioqueingresa= $_SESSION['idconectado'];
    $modificarpasta= $_POST['ingreso'] +$_SESSION['dinerodelconectado'];
    $enlace->query("UPDATE intusersinbote SET Dinero= $modificarpasta WHERE User= $usuarioqueingresa");
    
}
if(isset($_POST['extraccion'])){
    $pisoconectado= $_SESSION['pisoenfuncionamiento'];
    $idpisoconectado= $pisoconectado['ID'];
    $resta= $_POST['extraccion']/2;
    
     $enlace->query("UPDATE intusersinbote SET Dinero= Dinero-$resta WHERE Piso= $idpisoconectado");
    echo $enlace->error;
}

?>