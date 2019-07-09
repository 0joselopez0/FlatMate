<?php

 $enlace = mysqli_connect("localhost", "root", "", "flatmate");

$resultado= $enlace->query("SELECT Remitente FROM solicitudes");
$row= [];
$row2=[];
$row3=[];
        while($r= $resultado->fetch_assoc()) {
            $row= $r;
            $remitente= $r['Remitente'];
            $enlace->query("UPDATE solicitudes SET Estado= 1 WHERE Remitente= $remitente");
            $resultado2= $enlace->query("SELECT ID FROM solicitudes WHERE Remitente= $remitente");
            
            while($r2= $resultado2->fetch_assoc()) {
                $row2=$r2;
                
            }
            $insertarsolicitudenpiso= $row2['ID'];
            $enlace->query("INSERT INTO piso (Solicitud, Configurado) VALUES ('$insertarsolicitudenpiso', 0)");
             $resultado3= $enlace->query("SELECT ID FROM piso WHERE Solicitud= $insertarsolicitudenpiso");
             while($r3= $resultado3->fetch_assoc()) {
                $row3=$r3;
                
            }
            $iddelpiso= $row3['ID'];
            $resultado4= $enlace->query("SELECT Iduser FROM presolicitud WHERE Remitente= $remitente");
            while($r4= $resultado4->fetch_assoc()) {
                $userenpiso=$r4['Iduser'];
                 $enlace->query("INSERT INTO intusersenpiso (Piso, User) VALUES ($iddelpiso, $userenpiso)");
                
            }
        }
?>
