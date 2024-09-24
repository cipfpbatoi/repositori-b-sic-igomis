<?php 
function check_letter($word,$letter,&$guessed){
    if (!in_array($letter,$guessed)){
        if (in_array($letter,$word)){
            $found = array_keys($word,$letter);
            foreach ($found as $position){
                $guessed[$position] = $letter;
            }
            return true;
        }
        echo   "La Lletra $letter no forma part de la paraula";
        return false;    
    }
    echo "La lletra $letter ja ha estat introduïda amb anterioritat";
    return false;    
    
}

function print_tauler($guessed){
    echo '<p>';
    for ($i = 0 ; $i < count($guessed) ; $i++){
        echo ' '.$guessed[$i];
    }
    echo "<p/>";
}