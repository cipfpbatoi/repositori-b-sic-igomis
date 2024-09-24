<?php

// Funció per processar l'entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Inicialitzar variables d'error i missatge de confirmació
$error = array();
$name = $email = $password = $confirmPassword = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar el nom
    if (empty($_POST["name"])) {
        $error['name'] = "El nom és obligatori";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validar el correu electrònic
    if (empty($_POST["email"])) {
        $error['email'] = "El correu electrònic és obligatori";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "El format del correu electrònic no és vàlid";
        }
    }

    // Validar la contrasenya
    if (empty($_POST["password"])) {
        $error['password'] = "La contrasenya és obligatòria";
    } else {
        $password = test_input($_POST["password"]);
        // Comprovar la complexitat de la contrasenya (mínim 8 caràcters, majúscula, minúscula i un número)
        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/", $password)) {
            $error['password'] = "La contrasenya ha de tenir almenys 8 caràcters, una majúscula, una minúscula i un número";
        }
    }

    // Validar la confirmació de la contrasenya
    if (empty($_POST["confirm_password"])) {
        $error['confirm_password'] = "Has de confirmar la contrasenya";
    } else {
        $confirmPassword = test_input($_POST["confirm_password"]);
        if ($password !== $confirmPassword) {
            $error['confirm_password'] = "Les contrasenyes no coincideixen";
        }
    }

    // Si no hi ha errors, mostrar missatge d'èxit
    if (!count($error)) {
        $successMessage = "L'usuari s'ha registrat correctament!";
    }
}




?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de registre</title>
</head>
<body>

<h2>Formulari de registre</h2>

<!-- Mostrar missatge d'èxit si l'usuari s'ha registrat -->
<?php if ($successMessage): ?>
    <p style="color: green;"><?= $successMessage; ?></p>
<?php else: ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Nom: <input type="text" name="name" value="<?= $name; ?>">
    <span style="color: red;"><?= $error['name']??''; ?></span>
    <br><br>

    Correu electrònic: <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color: red;"><?php echo $error['email']??''; ?></span>
    <br><br>

    Contrasenya: <input type="password" name="password">
    <span style="color: red;"><?php echo $error['password']??''; ?></span>
    <br><br>

    Confirmar contrasenya: <input type="password" name="confirm_password">
    <span style="color: red;"><?php echo $error['confirm_password']??''; ?></span>
    <br><br>

    <input type="submit" value="Registrar">
</form>
<?php endif; ?>

</body>
</html>