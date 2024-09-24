<?php


$tabla = [];
$quantes = 13;
$fins = 60;


for ($i= 1; $i<= $quantes;$i++){
    for ($j=1 ; $j<= $fins; $j++){
        $tabla[$i][$j] = $i * $j;
    }
}

?>

<body>
    
    <table style='border: 1px solid'>
        <thead>
            <tr>
                <th>Multiplicar</th>
                <?php
                for ($j = 1; $j<= $fins ; $j++){
                    ?>
                    <th><?= $j ?>
                <?php } ?>
            </tr>
        </thead>
        <tbody>     
            <?php for ($i = 1; $i<= $quantes ; $i++){ ?>
                <tr>
                <th><?= $i ?></th>
                <?php for ($j=1;$j<= $fins; $j++){ ?>
                    <td><?= $tabla[$i][$j] ?></td>    
                <?php } ?>
                </tr>
            <?php } ?>
        </tbody>        
    </table> 
</body>
</html>

