<?php
include('functions.php');


//Nombre de case en X
if((isset($_POST['column']))&&(is_numeric($_POST['column']))){
    $column = $_POST['column'];
}else{
    $column =15;
}

//Nombre de case en Y
if((isset($_POST['line']))&&(is_numeric($_POST['line']))){
    $line = $_POST['line'];
}else{
    $line = 15;
}


$maze = new Maze($line,$column);
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
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-36652122-1']);
            _gaq.push(['_trackPageview']);
            
            (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body onkeyup="touche(Event);">
        <script  type="text/javascript" src="deplacement.js"></script>
        <h3>Utilisez z,s,q,d pour vous déplacer</h6>
        <h6>changer la taille du tableau</h6>
        <form accept="index.php" method="post">
            <label for="line">Ligne</label>
            <textarea id="line" name="line"></textarea>
            <label for="column">Colonne</label>
            <textarea id="column" name="column"></textarea>
            <button type="submit">Générer</button>
        </form>
        <button type="submit" onclick="resolveMaze();">Resolve</button>
        <table class="maze">
            <?php
            $maze->render($maze);
            ?>
        </table>
        <table class="controls">
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
