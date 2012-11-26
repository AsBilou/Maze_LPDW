<?php
include('functions.php');


//Nombre de case en X
if(isset($_GET['column'])){
    $column = $_GET['column'];
}else{
    $column = 30;
}

//Nombre de case en Y
if(isset($_GET['line'])){
    $line = $_GET['line'];
}else{
    $line = 30;
}


$maze = new Maze($column,$line);
$start_cell = $maze->getStartCell();
$maze->buildMaze($start_cell);

?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" media="screen" href="style.css">
        <title>Maze 3000</title>
        <?php $maze->convertPhpToJavascript($maze); ?>
        <script type="text/javascript">
            
            function disablePac("id"){
                document.getElementById("id").style.display ="none";
            }
            
            function activatePac('id'){
                document.getElementById('id').style.display="block";
            }
    </script>
    </head>
    <body>
        <table>
            <?php
            $maze->render($maze);
            ?>
        </table>
        <button type="submit" onclick="javascript:activatePac('4')">Active pacman</button>
    </body>
    
</html>

<?php
    //$maze->toString();
?>
