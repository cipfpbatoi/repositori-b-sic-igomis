<?php
// Llista d'usuaris predefinits amb contrasenyes en text pla
$users = [
    'igomis@cipfpbatoi.es' => '1234',
    'admin@cipfpbatoi.es' => '4321',
];

// Convertir les contrasenyes a un format encriptat
foreach ($users as $email => $password) {
    $users[$email] = password_hash($password, PASSWORD_BCRYPT);
}

// Formulari d'autenticació
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($users[$email]) && password_verify($password, $users[$email])) {
        // L'usuari està autenticat
        session_start();
        $_SESSION['user'] = $email;
        header('Location: /ofegat/ofegat.php');
    } else {
        // Credencials incorrectes
        echo "Invalid email or password.";
    }
}
?>
<h1>Joc de l'ofegat</h1>
<form method="post">
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
</form>
