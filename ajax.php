<?php
include('functions.php');

$line = $_POST["line"];
$column = $_POST["column"];

//Cr�ation d'un nouvel objet Maze
$maze = new Maze($line,$column);
//R�cuperation de la cellule de d�part
$start_cell = rand ( 0 , $maze->getNbCells() );
//D�but de la cr�ation du labyrithe
$maze->buildMaze($start_cell);

$maze->render($maze);
?>