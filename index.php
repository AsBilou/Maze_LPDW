<?php
include('functions.php');


//Nombre de case en X
if(isset($_GET['column'])){
    $column = $_GET['column'];
}else{
    $column = 10;
}

//Nombre de case en Y
if(isset($_GET['line'])){
    $line = $_GET['line'];
}else{
    $line = 10;
}


$maze = new Maze($column,$line);
$start_cell = $maze->getStartCell();
$maze->buildMaze($start_cell);
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