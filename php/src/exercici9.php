<?php
// Arrays de valors per a "Mòdul" i "Estat"
$modules = ["Matemàtiques", "Història", "Ciències", "Literatura"];
$statuses = ["Disponible", "No disponible", "Pròximament"];

// Inicialitzar variables per emmagatzemar els valors introduïts
$module = $publisher = $price = $pages = $status = $comments = $imagePath = "";
$imageError = "";

// Comprovar si el formulari ha estat enviat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module = $_POST['module'];
    $publisher = $_POST['publisher'];
    $price = $_POST['price'];
    $pages = $_POST['pages'];
    $status = $_POST['status'];
    $comments = $_POST['comments'];

    // Gestionar la pujada de la imatge
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // Definir el directori on es pujarà la imatge
        $targetDir = "uploads/";
        // Agafar el nom del fitxer
        $fileName = basename($_FILES["photo"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        $newFileName = substr(str_shuffle($permitted_chars), 0, 10).".$fileType";
        // Definir la ruta completa per guardar la imatge
        $targetFilePath = $targetDir . $newFileName;
        // Comprovar el tipus de fitxer
        
        // Permetre només imatges (formats png, jpg, jpeg, gif)
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Intentar moure la imatge pujada al directori definit
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                $imagePath = $targetFilePath;
            } else {
                $imageError = "No s'ha pogut pujar la imatge.";
            }
        } else {
            $imageError = "Només es permeten arxius de tipus JPG, JPEG, PNG, GIF.";
        }
    } else {
        $imageError = "Si us plau, selecciona una imatge per pujar.";
    }
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
            <?php foreach ($modules as $mod): ?>
                <option value="<?php echo $mod; ?>"><?php echo $mod; ?></option>
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
        <span class="error"><?php echo $imageError; ?></span>
    </div>

    <div>
        <label for="comments">Comentaris:</label>
        <textarea id="comments" name="comments"><?php echo $comments; ?></textarea>
    </div>

    <div>
        <button type="submit">Donar d'alta</button>
    </div>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($imageError)): ?>
    <h2>Dades introduïdes:</h2>
    <table>
        <tr>
            <th>Mòdul</th>
            <th>Editorial</th>
            <th>Preu</th>
            <th>Pàgines</th>
            <th>Estat</th>
            <th>Comentaris</th>
            <th>Imatge</th>
        </tr>
        <tr>
            <td><?php echo $module; ?></td>
            <td><?php echo $publisher; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $pages; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo $comments; ?></td>
            <td>
                <?php if (!empty($imagePath)): ?>
                    <img src="<?php echo $imagePath; ?>" alt="Imatge del llibre" style="width: 100px;">
                <?php else: ?>
                    Sense imatge
                <?php endif; ?>
            </td>
        </tr>
    </table>
<?php endif; ?>

</body>
</html>