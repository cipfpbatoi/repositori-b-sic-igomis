<?php

const FILES = 6;
const COLUMNES = 7;

include_once "functions.php";

$graella = array();
$jugador_actual = 1;
inicialitzarGraella($graella);
ferMoviment($graella,2,1);
ferMoviment($graella,2,2);


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    extract($_POST);
    if ($columna>=1 && $columna <= COLUMNES){
        ferMoviment($graella,$columna,$jugador_actual);
        $jugador_actual = 2;
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="4ratlla.css?v=<?php echo time(); ?>">
</head>
<body>
    <?= pintarGraella($graella); ?>
    <div class="formulari-container">
        <h2>Introduïu la columna (1-<?= COLUMNES ?>) Jugador <?= $jugador_actual ?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="columna">Columna:</label>
            <input type="number" id="columna" name="columna" min="1" max="<?= COLUMNES ?>" required>
            <br><br>
            <button type="submit">Inserir fitxa</button>
        </form>
    </div>
</body>
</html> 
