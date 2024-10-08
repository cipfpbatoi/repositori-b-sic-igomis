<?php
session_start();
const FILES = 6;
const COLUMNES = 7;
const ADJ = array ([-1,-1],[-1,0],[-1,1],[0,-1],[0,1],[1,-1],[1,0],[1,1]);
const TWIN = array(array([-1,-1],[1,1]),array([-1,0],[1,0]),array([-1,1],[1,-1]),array([0,-1],[0,1]));

include_once "functions.php";


if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
if (isset($_POST['reset'])) {
    inicialitza();
    header("location:/4ratlla/index.php");
    exit();
}

if (!isset($_SESSION['graella'])) {
    inicialitza();
}

extract($_SESSION);


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    extract($_POST);
    if ($columna>=1 && $columna <= COLUMNES){
        $last = ferMoviment($graella,$columna,$jugador_actual);
        
        if ($last) {
            if (fi_joc($graella, $last)) {
                echo "Jugador $jugador_actual  win !!";
            }   
            if (tauler_ple($graella)) {
                echo "Ja no es pot jugar més"; 
            } 
    
            $jugador_actual = 1?2:1;
    
            $last = jugar($graella,$jugador_actual);
           
    
            if (fi_joc($graella, $last)) {
                echo "Jugador $jugador_actual  win !!";
            }   
            if (tauler_ple($graella)) {
                echo "Ja no es pot jugar més"; 
            } 
    
            $_SESSION['graella'] = $graella;
            $_SESSION['jugador_actual'] = $jugador_actual == 1?2:1;

        } else {
            echo "Moviment no vàlid";

        }
        
        
        
    }
    
}
?>
<html>
<head>
    <link rel="stylesheet" href="4ratlla.css?v=<?php echo time(); ?>">
</head>
<body>
    <?= $_COOKIE['jugador1']??'' ?> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?= pintarGraella($graella); ?>
    <input type="submit" name="reset" value="Reiniciar joc">
    </form>
</form>
</body>
</html> 
