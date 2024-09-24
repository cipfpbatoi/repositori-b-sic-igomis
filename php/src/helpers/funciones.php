<?php

function sumar(int $a , int $b): int {
    return $a + $b;
}

function media(Array $numeros){
    return array_sum($numeros) / count($numeros);
}

function contar_vocales($sentence){
    $vocales = ['a','e','i','o','u'];
    $total = 0;
    foreach ($vocales as $vocal){
        $total += substr_count($sentence,$vocal);
    }
    return $total;
}