<?php
session_start();

// Comprovar si hi ha productes al carret
if (!isset($_SESSION['carret']) || empty($_SESSION['carret'])) {
    $carret_buit = true;
} else {
    $carret_buit = false;
}

// Processar la sol·licitud d'eliminar un producte
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $producte_a_eliminar = $_POST['eliminar'];
    unset($_SESSION['carret'][$producte_a_eliminar]);
    // Si el carret està buit, eliminar la variable de sessió
    if (empty($_SESSION['carret'])) {
        unset($_SESSION['carret']);
    }
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Carret de compres</title>
</head>
<body>
    <h1>Contingut del carret</h1>
    
    <?php if ($carret_buit): ?>
        <p>El teu carret està buit.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($_SESSION['carret'] as $producte => $quantitat): ?>
                <li>
                    <?php echo htmlspecialchars($producte); ?>: <?php echo htmlspecialchars($quantitat); ?>
                    <form action="carret.php" method="POST" style="display:inline;">
                        <input type="hidden" name="eliminar" value="<?php echo htmlspecialchars($producte); ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="tenda.php">Tornar a la selecció de productes</a>
</body>
</html>
