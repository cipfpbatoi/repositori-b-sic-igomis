<?php
session_start();

const MAX_ERR = 6;

include_once "functions.php";


if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
if (isset($_POST['reset'])) {
    inicialitza();
    header("location:/ofegat/index.php");
    exit();
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

    if ($fails >= MAX_ERR){
        echo "You Loose !!!"; 
        inicialitza();
    }

    if (fi_joc($guessed)){
        echo "You win !!";
        inicialitza();
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="ofegat.css?v=<?php echo time(); ?>">
</head>
<body>
<p>Welcome, <?= $_SESSION['user']?> !</p>
<?= print_tauler($guessed,$letters,$fails); ?>    
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="letter">Lletra:</label>
    <input type="text" id="letter" name="letter"><br><br>
    <input type="submit" name="submit_letter" value="Enviar lletra">
    <input type="submit" name="reset" value="Reiniciar joc">
</form>


</body>
</html>