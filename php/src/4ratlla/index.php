<?php
include_once "functions.php";

$graella = array();
inicialitzarGraella($graella);
ferMoviment($graella,2,1);
ferMoviment($graella,2,2);

?>
<html>
<head>
    <link rel="stylesheet" href="4ratlla.css">
</head>
<body>
    <?= pintarGraella($graella); ?>
    <form
</body>
</html> 
