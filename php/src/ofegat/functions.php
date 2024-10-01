<?php 
function check_letter($word,$letter,&$guessed){
    if (!in_array($letter,$guessed)){
        if (in_array($letter,$word)){
            $found = array_keys($word,$letter);
            foreach ($found as $position){
                $guessed[$position] = $letter;
            }
            return 0;
        }
        echo "<span class='incorrect'>La Lletra $letter no forma part de la paraula</span>";
        return 1;    
    }
    echo "<span class='incorrect'>La lletra $letter ja ha estat introduïda amb anterioritat</span>";
    return 1;    
    
}

function print_tauler($guessed,$letters,$fails){
    $tauler = '<p>';
    for ($i = 0 ; $i < count($guessed) ; $i++){
        $tauler .= ' '.$guessed[$i];
    }
    foreach ($letters as $letter){
        if (in_array($letter,$guessed)){
            $tauler .= " <em class='correct'>$letter</em>";
        } else {
            $tauler .= " <em class='incorrect'>$letter</em>";
        }

    }
    $tauler .= " $fails Errades";
    $tauler .= "<p/>";
    return $tauler;
}

function inicialitza(){
    $paraula = "fcbarcelona";
    $word = str_split($paraula);
    $guessed = array();
    $numberLetters = count($word);
    for ($i = 0 ; $i < $numberLetters ; $i++){
        $guessed[] = "_";
    }
    $_SESSION['paraula'] = $paraula;
    $_SESSION['guessed'] = $guessed;
    $_SESSION['letters'] = array() ;
    $_SESSION['fails'] = 0;
}

function fi_joc($guessed) {
    if (!in_array("_",$guessed)){
        return true;
    }
}