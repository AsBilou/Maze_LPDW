<?php
include('functions.php');

//Nombre de colonne (par defaut 20)
if((isset($_POST['column']))&&(is_numeric($_POST['column']))){
    $column = htmlspecialchars($_POST['column']);
}else{
    $column = 20;
}

//Nombre de ligne (par defaut 20)
if((isset($_POST['line']))&&(is_numeric($_POST['line']))){
    $line = htmlspecialchars($_POST['line']);
}else{
    $line = 20;
}

//Création d'un nouvel objet Maze
$maze = new Maze($line,$column);
//Récuperation de la cellule de départ
$start_cell = rand ( 0 , $maze->getNbCells() );
//Début de la création du labyrithe
$maze->buildMaze($start_cell);
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" media="screen" href="style.css">
        <title>The Amazing Maze | A maze generator</title>
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <!-- Conversion du tableau maze php en tabeau javascript avec filtre des données. -->
        <?php $maze->convertPhpToJavascript($maze); ?>
        <!-- Google Analytics -->
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
    <body>
    
        <script  type="text/javascript" src="plugin/jquery.js"></script> <!-- Plugin jQuery -->
        <script  type="text/javascript" src="deplacement.js"></script>   <!-- Gestion déplacement -->
        
        <aside id="control">
            <a href="#"><img src="img/the-amazing-maze.png" width="385" height="209" alt="The Amazing Maze"/></a>
            <form accept="index.php" method="post">
                <label for="line">Width</label>
                <label for="column">Height</label>
                <br/>                
                <input type="text" maxlength="3" id="column" name="column" value="<?php echo $column; ?>" autocomplete="off"/>
                <input type="text" maxlength="3" id="line" name="line" value="<?php echo $line; ?>" autocomplete="off"/>
                <button type="submit">Generate</button>
            </form>
            <p class="moves"><span class="moves">MOVES :</span> Z Q S D <span class="moves">/</span> Arrow keys</p>            
            <!-- Affichage des controles -->
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
            <a id="bigRedButton" href="#" onclick="resolveMaze();"></a>
            <p>Don't push this big<br/><span>red button!</span></p>
        </aside>
        
        <section id="mazeContainer">            
            <!-- Affichage du labyrinthe -->
            <table class="maze" style="min-width:<?php echo $column*27.1 ?>px;">
                <?php $maze->render($maze); ?>
            </table>
        </section>
    </body>
</html>