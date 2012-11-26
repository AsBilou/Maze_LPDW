<?php
include('functions.php');

session_start();

//Nombre de case en X
$column = 10;
//Nombre de case en Y
$line = 10; 


$maze = new Maze($column,$line);
//$maze->createMaze();
$_SESSION['maze']=$maze->getMazeArray();

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
            for($i=0;$i<$maze->getNbCells();$i++){
                if(($i % $column) == 0){
                    echo '<tr>';
                }
                echo '<td class="';
                if($_SESSION['maze'][$i]['wall'][0] == 1){
                        echo 'border_top ';
                }
                if($_SESSION['maze'][$i]['wall'][1] == 1){
                        echo 'border_right ';
                }
                if($_SESSION['maze'][$i]['wall'][2] == 1){
                        echo 'border_bottom ';
                }
                if($_SESSION['maze'][$i]['wall'][3] == 1){
                        echo 'border_left ';
                }
                echo'"><img class="'; 
                echo 'disable';
                echo'" src="img/pacman.gif"</td>';
                if(($i % $column) == ($column-1)){
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </body>
</html>