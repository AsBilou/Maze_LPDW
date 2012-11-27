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
        <link rel="stylesheet" media="screen" href="bootstrap.css">
        <title>Maze 3000</title>
        <?php $maze->convertPhpToJavascript($maze); ?>
    </head>
    <body onkeyup="touche(Event);">
        <script  type="text/javascript" src="deplacement.js"></script>
        <h6>Utilisez z,s,q,d pour vous déplacer</h6>
        <table>
            <?php
            $maze->render($maze);
            ?>
        </table>
        <table>
            <tbody>
                <tr>
                    <td>
                    </td>
                    <td>
                        <button type="submit" onclick="upPacman()">UP</button>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" onclick="leftPacman()">LEFT</button>
                    </td>
                    <td>
                        <button type="submit" onclick="downPacman()">DOWN</button>
                    </td>
                    <td>
                        <button type="submit" onclick="rightPacman()">RIGHT</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
    
</html>

<?php
    //$maze->toString();
?>
