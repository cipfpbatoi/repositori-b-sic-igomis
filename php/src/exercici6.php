<html>
    <body>
        <?php
     $nota = 7;

    $categoria = match (true) {
        $nota === 10 => 'Excel.lent',
        $nota >= 8 && $nota < 10 => 'Molt bé',
        $nota >= 5 && $nota < 8 => 'Bé',
        default => 'Insuficient',
    };

    echo $categoria;
    ?>
    </body>
</html>