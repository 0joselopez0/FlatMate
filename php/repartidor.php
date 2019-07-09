<?php
$enlace = mysqli_connect("localhost", "root", "", "flatmate");

$resultado= $enlace->query("SELECT User FROM intusersenpiso WHERE Piso= 6");
        $usuarios= [];
        while($r= $resultado->fetch_assoc()) {
         array_push($usuarios, $r['User']);
    }


$resultado= $enlace->query("SELECT Tarea,Repeticion,Peso FROM inttareasenpiso WHERE Piso= 6");
        $tareas= [];
        while($r= $resultado->fetch_assoc()) {
         array_push($tareas, $r);
    }




function cmp($a, $b)
{
    return ($a['Peso'] > $b['Peso']) ? -1 : 1;
}
usort($tareas, "cmp");

function distribuir($tareas, $numerousers, $usuarios)
{
    
$turno=rand(0, $numerousers-1);
   $user=[];
	for($i=0; $i<count($tareas); $i++){
        
        for($j=0; $j<(int)$tareas[$i]['Repeticion']; $j++){
           
            $newtarea= $tareas[$i];
            $newtarea['user']=$usuarios[$turno];
           
        unset($newtarea['Peso']);
           array_push($user, $newtarea);
            
            if($turno==($numerousers-1)){
                $turno=0;
            }else{
                $turno= $turno+1;
            }
            
        }
 
        
    }
    return $user;
}

$tareasainsertar= distribuir($tareas,count($usuarios), $usuarios);
for( $t=0; $t<count($tareasainsertar); $t++){
    $tempinsercionuser= $tareasainsertar[$t]['user'];
    $tempinserciontarea= $tareasainsertar[$t]['Tarea'];
    $hoy= date("Y-m-d");
   $semanaqueviene= date('Y-m-d',strtotime('+7 day', strtotime($hoy)));
   
    
    $enlace->query("INSERT INTO intasignaciones (Tarea, User, desde, hasta, validada) VALUES (' $tempinserciontarea', $tempinsercionuser, '$hoy', '$semanaqueviene', 0)");
    
}

?>