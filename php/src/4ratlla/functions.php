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
    $table .= "<tr>";
    for ($j=1;$j<= COLUMNES;$j++){
        $table .= "<td>$j</td>";
    }
    $table .= "</tr>";
    $table .= "</table>";
    return $table;
}

function ferMoviment(&$graella, $columna, $jugadorActual){
    $fil_buida = 0;
    for ($i = 1; $fil_buida === 0 || $i <= FILES ; $i++){
        if ($graella[$i][$columna] === 0){
            $fil_buida = $i;
        }
    }
    $graella[$fil_buida][$columna] = $jugadorActual;
}