<?php
// Arrays de valors per a "Mòdul" i "Estat"
$modules = ["mat" => "Matemàtiques","his" => "Història","cie" => "Ciències", "lit"=>"Literatura"];
$statuses = ["Disponible", "No disponible", "Pròximament"];

// Inicialitzar variables per emmagatzemar els valors introduïts
$module = $publisher = $price = $pages = $status = $comments = "";

// Comprovar si el formulari ha estat enviat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module = $_POST['module'];
    $publisher = $_POST['publisher'];
    $price = $_POST['price'];
    $pages = $_POST['pages'];
    $status = $_POST['status'];
    $comments = $_POST['comments'];
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Alta Llibre</title>
    <style>
        .error {
            color: red;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="module">Mòdul:</label>
        <select id="module" name="module">
            <?php foreach ($modules as $key => $mod): ?>
                <option value="<?php echo $key; ?>"><?php echo $mod; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div>
        <label for="publisher">Editorial:</label>
        <input type="text" id="publisher" name="publisher" value="<?php echo $publisher; ?>">
    </div>

    <div>
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="<?php echo $price; ?>">
    </div>

    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="<?php echo $pages; ?>">
    </div>

    <div>
        <label for="status">Estat:</label>
        <?php foreach ($statuses as $stat): ?>
            <input type="radio" name="status" value="<?php echo $stat; ?>" <?php if ($status == $stat) echo "checked"; ?>>
            <?php echo $stat; ?>
        <?php endforeach; ?>
    </div>

    <div>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo">
    </div>

    <div>
        <label for="comments">Comentaris:</label>
        <textarea id="comments" name="comments"><?php echo $comments; ?></textarea>
    </div>

    <div>
        <button type="submit">Donar d'alta</button>
    </div>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <h2>Dades introduïdes:</h2>
    <table>
        <tr>
            <th>Mòdul</th>
            <th>Editorial</th>
            <th>Preu</th>
            <th>Pàgines</th>
            <th>Estat</th>
            <th>Comentaris</th>
        </tr>
        <tr>
            <td><?php echo $modules[$module]; ?></td>
            <td><?php echo $publisher; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $pages; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo $comments; ?></td>
        </tr>
    </table>
<?php endif; ?>

</body>
</html>