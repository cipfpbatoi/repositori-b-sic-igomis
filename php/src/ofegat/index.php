<?php
include_once "functions.php";

$paraula = "fcbarcelona";
$word = str_split($paraula);
$guessed = array();
for ($i = 0 ; $i < count($word) ; $i++){
    $guessed[] = "_";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $letter = strtolower(substr($_POST['letter'],0,1));
    check_letter($word,$letter,$guessed);
}


print_tauler($guessed);


?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="letter">Lletra:</label>
    <input type="text" id="letter" name="letter" required><br><br>
    <input type="submit" value="Enviar">
</form>



