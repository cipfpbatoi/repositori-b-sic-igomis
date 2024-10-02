<?php
session_start();

// Logout  (si s'ha passat el paràmetre logout=yes)
if (isset($_GET['logout']) && $_GET['logout'] == 'yes') {
    var_dump('holA');
    session_destroy();  // Destruir la sessió
    header('Location: /index.php');  // Redirigir a la pàgina d'inici després del logout
    exit();
}
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

        $_SESSION['user'] = $email;

    } else {
        // Credencials incorrectes
        echo "Invalid email or password.";
    }
}
?>
<h1>Jocs del CIPFP Batoi</h1>
<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?= $_SESSION['user'] ?>!</p>
    <a href="/index.php?logout=yes">Logout</a>
<?php else: ?>
    <form method="post">
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
</form>
<?php endif; ?>

<h3><a href="/ofegat">Joc del Penjat</a></h3>
<h3><a href="/4ratlla">Joc del 4 en ratlla</a></h3>