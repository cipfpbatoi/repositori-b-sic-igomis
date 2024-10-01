<?php 
 

function inicialitzarGraella(&$graella){
    for ($i=1;$i<= FILES ;$i++){
        for ($j=1;$j<= COLUMNES ;$j++){
            $graella[$i][$j] = 0;
        }
    }
} 
    

function pintarGraella($graella){
    $table = "<table>";
    $table .= "<tr>";
    for ($j=1;$j<= COLUMNES;$j++){
        $table .= "<td><input type='submit' name='columna' value='$j' /></td>";
    }
    $table .= "</tr>";
    for ($i=1;$i<= FILES ;$i++){
        $table .= "<tr>";
        for ($j=1;$j<= COLUMNES ;$j++){
            $table .= match ($graella[$i][$j]){
                0 => '<td class="buid"></td>',
                1 => '<td class="player1"></td>',
                2 => '<td class="player2"></td>'
            }  ; 
        }
        $table .=  "</tr>";
    }
    
    $table .= "</table>";
    return $table;
}

function ferMoviment(array &$graella,int $columna,int $jugadorActual){
    $fil_buida = 0;
    for ($i = 1; $fil_buida === 0 || $i <= FILES ; $i++){
        if ($graella[$i][$columna] === 0){
            $fil_buida = $i;
        }
    }
    $graella[$fil_buida][$columna] = $jugadorActual;
    return array($fil_buida,$columna);
}

function inicialitza(){
    $graella = array();
    $_SESSION['jugador_actual'] = 1;
    inicialitzarGraella($graella);
    $_SESSION['graella'] = $graella;
    
}




function fi_joc($graella,$coord){
    $x = $coord[0];
    $y = $coord[1];
    $jugador = $graella[$x][$y];
    $punts = array();
    inicialitzarGraella($punts);
    $punts[$x][$y] = 1;
    
    for ($i=1;$i<=4;$i++){
        foreach (ADJ as $coordAfegeix){
            $zx = $i*$coordAfegeix[0] + $x;
            $zy = $i*$coordAfegeix[1] + $y;
            $antx = ($i-1)*$coordAfegeix[0] + $x;
            $anty = ($i-1)*$coordAfegeix[1] + $y;
            if ($zx > 0 && $zx <= FILES && $zy > 0 && $zy <= COLUMNES){
                if ($graella[$zx][$zy] === $jugador ) {
                    $punts[$zx][$zy] = $punts[$antx][$anty] + 1;
                    if ($punts[$zx][$zy] == 4 ){ 
                        return true;}
                }    
            }
            if ($i == 1){
                foreach (TWIN as $twins){ 
                    $tx1  = $twins[0][0] + $x;
                    $ty1  = $twins[0][1] + $y;
                    $tx2  = $twins[1][0] + $x;
                    $ty2  = $twins[1][1] + $y;
                    
                    if ($tx1 > 0 && $tx1 <= FILES && $ty1 > 0 && $ty1 <= COLUMNES &&
                        $tx2 > 0 && $tx2 <= FILES && $ty2 > 0 && $ty2 <= COLUMNES && 
                        $punts[$tx1][$ty1] == $punts[$tx2][$ty2] &&  $punts[$tx2][$ty2] == 2){
                        $punts[$tx1][$ty1] = $punts[$tx2][$ty2] = 3;
                    }
                }
            }
        }
    }
    return false;
}

 
