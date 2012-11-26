<?php
include('functions.php');


//Nombre de case en X
$column = 10;
//Nombre de case en Y
$line = 10; 


$maze = new Maze($column,$line);
//$maze->createMaze();
//$maze->toString();

?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" media="screen" href="style.css">
        <title>Maze 3000</title>
    </head>
    <body>
        <table>
            <?php
            $maze->render($maze);
            ?>
        </table>
    </body>
</html>