<?php
include('functions.php');

$line = $_POST["line"];
$column = $_POST["column"];

//Création d'un nouvel objet Maze
$maze = new Maze($line,$column);
//Récuperation de la cellule de départ
$start_cell = rand ( 0 , $maze->getNbCells() );
//Début de la création du labyrithe
$maze->buildMaze($start_cell);

$maze->render($maze);
?>