<?php
include('functions.php');

session_start();

//Nombre de case en X
$x = 30;
//Nombre de case en Y
$y = 30; 


$maze = new Maze($x,$y);
$maze->createMaze();


?>