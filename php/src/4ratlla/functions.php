<?php 
function inicialitzarGraella(&$graella){
    for ($i=1;$i<8;$i++){
        for ($j=1;$j<9;$j++){
            $graella[$i][$j] = 0;
        }
    }
} 
    

function pintarGraella($graella){
    $table = "<table>";
    for ($i=1;$i<8;$i++){
        $table .= "<tr>";
        for ($j=1;$j<9;$j++){
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

function ferMoviment(&$graella, $columna, $jugadorActual){
    $fil_buida = 0;
    for ($i = 1; $fil_buida === 0 || $i < 8 ; $i++){
        if ($graella[$i][$columna] === 0){
            $fil_buida = $i;
        }
    }
    $graella[$fil_buida][$columna] = $jugadorActual;
}