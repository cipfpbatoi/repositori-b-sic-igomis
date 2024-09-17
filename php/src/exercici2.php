<html>
    <body>
        <ul>
            <?php
            for($i=2;$i<20;$i=$i+2){
            ?>    
                <li><?= $i ?></li>
            <?php    
            }
            ?>
            <?php
           
            do {
                echo "<li>$i</li>";
                $i = $i -2;
            } while ($i>0)
            ?>
        </ul>
    </body>
</html>