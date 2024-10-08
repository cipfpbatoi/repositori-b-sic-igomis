<?php
session_start();

// Inicialitzar el carret si no existeix
if (!isset($_SESSION['carret'])) {
    $_SESSION['carret'] = [];
}

// Processar la sol·licitud d'afegir un producte
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producte'])) {
    $producte = $_POST['producte'];
    
    // Afegir el producte al carret o incrementar la quantitat
    if (isset($_SESSION['carret'][$producte])) {
        $_SESSION['carret'][$producte]++;
    } else {
        $_SESSION['carret'][$producte] = 1;
    }
    print_r($_SESSION);
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Selecció de productes</title>
</head>
<body>
    <h1>Afegir productes al carret</h1>
    <form action="tenda.php" method="POST">
        <label for="producte">Tria un producte:</label>
        <select name="producte" id="producte">
            <option value="Poma">Poma</option>
            <option value="Plàtan">Plàtan</option>
            <option value="Taronja">Taronja</option>
        </select>
        <input type="submit" value="Afegir al carret">
    </form>
    <a href="carret.php">Veure carret</a>
</body>
</html>
