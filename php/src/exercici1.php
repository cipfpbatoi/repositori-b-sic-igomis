<html>
<?php 
    $a = 10;
    $b = 5;
    $c = 3;
?>    
<body>
    
    <table style='border: 1px solid'>
        <thead>
            <tr>
                <th>Operació</th>
                <th>a i b</th>
                <th>b i c</th>
                <th>a i c</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>+</td>
                <td><?= $a+$b ?></td>
                <td><?= $b+$c ?></td>
                <td><?= $a+$c ?></td>
            </tr> 
            <tr><td>-</td><td><?= $a-$b ?></td><td><?= $b-$c ?></td><td><?= $a-$c ?></td></tr> 
            <tr><td>*</td><td><?= $a*$b ?></td><td><?= $b*$c ?></td><td><?= $a*$c ?></td></tr> 
            <tr><td>/</td><td><?= $a/$b ?></td><td><?= $b/$c ?></td><td><?= $a/$c ?></td></tr> 
        </tbody>        
    </table> 

</body>
</html>
