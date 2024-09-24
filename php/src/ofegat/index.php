<?php
include_once "functions.php";

$paraula = "fcbarcelona";
$word = str_split($paraula);
$guessed = array();
for ($i = 0 ; $i < count($word) ; $i++){
    $guessed[] = "_";
}
$letters = array();
$fails = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $letter = strtolower(substr($_POST['letter'],0,1));
    if (!in_array($letter, $letters)){
        $letters[] = $letter;
        $fails += check_letter($word,$letter,$guessed);
    } else {
        $fails++;
    }
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



