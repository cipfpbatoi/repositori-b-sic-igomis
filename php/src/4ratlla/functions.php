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
    if ($columna > 0 && $columna <= COLUMNES){
        $fil_buida = calc_fila_moviment($graella,$columna);
        if ($fil_buida) {
            $graella[$fil_buida][$columna] = $jugadorActual;
            return array($fil_buida,$columna);
        }
        return false;
    }
    return false;
}

function inicialitza(){
    $graella = array();
    $_SESSION['jugador_actual'] = 1;
    inicialitzarGraella($graella);
    $_SESSION['graella'] = $graella;
    
}

function tauler_ple($graella){
    foreach ($_SESSION['graella'] as $fila) {
        if (in_array(0, $fila)) {
            return false; // Encara hi ha espai
        }
    }
    return true; // Tauler ple
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
            if (calculate_square($i,$x,$y,$coordAfegeix,$graella,$jugador,$punts)){
                return true;
            }
            if ($i === 1) {
                checkTwins($x,$y,$punts);
            }

        }
    }
    return false;
}


function calculate_square($increment,$x,$y,$coordAfegeix,$graella,$jugador,&$punts){
    $zx = $increment*$coordAfegeix[0] + $x;
    $zy = $increment*$coordAfegeix[1] + $y;
    $antx = ($increment-1)*$coordAfegeix[0] + $x;
    $anty = ($increment-1)*$coordAfegeix[1] + $y;
    if ($zx > 0 && $zx <= FILES && $zy > 0 && $zy <= COLUMNES){
        if ($graella[$zx][$zy] === $jugador ) {
            $punts[$zx][$zy] = $punts[$antx][$anty] + 1;
            if ($punts[$zx][$zy] == 4 ){
                return true;
            }
        }
    }
    return false;
}

/**
 *
 * @param mixed $x
 * @param mixed $y
 * @param array $punts
 *
 */
function checkTwins( int  $x, int $y, array &$punts)
{
    foreach (TWIN as $twins) {
        $tx1 = $twins[0][0] + $x;
        $ty1 = $twins[0][1] + $y;
        $tx2 = $twins[1][0] + $x;
        $ty2 = $twins[1][1] + $y;

        if ($tx1 > 0 && $tx1 <= FILES && $ty1 > 0 && $ty1 <= COLUMNES && $tx2 > 0 && $tx2 <= FILES && $ty2 > 0 && $ty2 <= COLUMNES && $punts[$tx1][$ty1] == $punts[$tx2][$ty2] && $punts[$tx2][$ty2] == 2) {
            $punts[$tx1][$ty1] = $punts[$tx2][$ty2] = 3;
        }
    }
 }

 function jugar(&$graella,$jugadorActual){
   
        $opponent = $jugadorActual === 1 ? 2 : 1;
    
        // Comprovar si pots guanyar
        for ($col = 1; $col <= COLUMNES; $col++) {
            if (isValidMove($graella, $col)) {
                $tempBoard = $graella;
                $coord = ferMoviment($tempBoard, $col, $jugadorActual);
                
                if (fi_joc($tempBoard, $coord)) {
                    return ferMoviment($graella,$col,$jugadorActual); // Guanyar immediatament
                }
            }
        }
    
        // Comprovar si l'oponent pot guanyar i bloquejar
        for ($col = 1; $col <= COLUMNES; $col++) {
            if (isValidMove($graella, $col)) {
                $tempBoard = $graella;
                $coord = ferMoviment($tempBoard, $col, $opponent);
                if (fi_joc($tempBoard, $coord )) {
                    return ferMoviment($graella,$col,$jugadorActual); // Bloquejar
                }
            }
        }
    
        // Estratègia: buscar el millor moviment
        // Podem afegir més lògica aquí per seleccionar el millor moviment
        $possibles = array();
        for ($col = 1; $col <= COLUMNES; $col++) {
            if (isValidMove($graella, $col)) {
                $possibles[] = $col; 
            }
        }
        if (count($possibles)>2) {
            $random = rand(-1,1);
        }
        $middle = (int) (count($possibles) / 2)+$random;
        $inthemiddle = $possibles[$middle];
        return ferMoviment($graella, $inthemiddle, $jugadorActual); 
    
        return -1; // Totes les columnes estan plenes
    }
 

 function isValidMove($board, $col) {
    return $board[1][$col] === 0;
}

 function calc_fila_moviment($graella,$columna){
    $fil_buida = null;
    for ($i = 1; $fil_buida === 0 || $i <= FILES ; $i++){
        if ($graella[$i][$columna] === 0){
            $fil_buida = $i;
        }
    }
    return $fil_buida;

 }

 
