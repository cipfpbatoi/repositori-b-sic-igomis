<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
 echo " <p>Welcome,   {$_SESSION['user']}  !</p>";

include_once "functions.php";
function inicialitza(){
    $paraula = "fcbarcelona";
    $word = str_split($paraula);
    $guessed = array();
    $numberLetters = count($word);
    for ($i = 0 ; $i < $numberLetters ; $i++){
        $guessed[] = "_";
    }
    $_SESSION['paraula'] = $paraula;
    $_SESSION['guessed'] = $guessed;
    $_SESSION['letters'] = array() ;
    $_SESSION['fails'] = 0;
}


if (!isset($_SESSION['guessed'])) {
    inicialitza();
}
extract($_SESSION);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = str_split($_SESSION['paraula']);
    $letter = strtolower(substr($_POST['letter'],0,1));
    if (!in_array($letter, $letters)){
        $letters[] = $letter;
        $fails += check_letter($word,$letter,$guessed);
    } else {
        $fails++;
    }
    $_SESSION['letters'] = $letters;
    $_SESSION['fails'] = $fails;
    $_SESSION['guessed'] = $guessed;
}





?>

<html>
<head>
    <link rel="stylesheet" href="ofegat.css?v=<?php echo time(); ?>">
</head>
<body>
<?= print_tauler($guessed,$letters,$fails); ?>    
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="letter">Lletra:</label>
    <input type="text" id="letter" name="letter" required><br><br>
    <input type="submit" value="Enviar">
</form>
</body>
</html>