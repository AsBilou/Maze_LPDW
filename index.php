<?php
include('maze.php');
include('fonction.php');

//max=14161
if((isset($_POST['line']))&&(isset($_POST['column']))){
    $line = $_POST['line'];
    $column = $_POST['column'];
    if((($column*$line)<=14161)&&(($column*$line)>=100)){
        //Nombre de colonne (par defaut 20)
        if(is_numeric($column)){
            $column = htmlspecialchars($column);
        }else{
            $column = 20;
        }
        //Nombre de ligne (par defaut 20)
        if(is_numeric($line)){
            $line = htmlspecialchars($line);
        }else{
            $line = 20;
        }
    }else{
        $line = 20;
        $column = 20;
        echo 'Taille incorecte';
    }
}else{
    $line = 20;
    $column = 20;
}

//Création d'un nouvel objet Maze
$maze = new Maze($line,$column);
//Récuperation de la cellule de départ
$start_cell = rand ( 0 , $maze->getNbCells() );
//Début de la création du labyrinthe
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
            <a href="index.php"><img src="img/the-amazing-maze.png" width="385" height="209" alt="The Amazing Maze"/></a>
            <form accept="index.php" method="post">
                <label for="line">Width</label>
                <label for="column">Height</label>
                <br/>                
                <input type="text" maxlength="3" id="column" name="column" value="<?php echo $column; ?>" autocomplete="off"/>
                <input type="text" maxlength="3" id="line" name="line" value="<?php echo $line; ?>" autocomplete="off"/>
                <button type="submit">Generate <span>(G)</span></button>
            </form>
            <div id="messageBox"><span class="big">Seriously?</span><br/>Even my goldfish can solve a maze of this size.<br/><span>(Insert numbers biggers than 4.)</span></div>
            <p class="moves"><span class="moves">MOVES :</span> Z S Q D <span class="moves">/</span> Arrow keys</p>
            <p class="moves" style="display:none;"><span class="moves">MOVES :</span> W S A D <span class="moves">/</span> Arrow keys</p>
            <!-- Affichage des controles -->
            <div id="controls">
                <a id="btnLEFT" onclick="leftPacman()"></a>
                <a id="btnUP" onclick="upPacman()"></a>
                <a id="btnDOWN" onclick="downPacman()"></a>
                <a id="btnRIGHT" onclick="rightPacman()"></a>
                <div class="clear"></div>
            </div>
            <a id="bigRedButton" onclick="resolveMaze();"></a>
            <p id="alertTxt">Don't push this big<br/><span>red button!</span><br/><span id="alertKey">(or R key)</span></p>
        </aside>
        
        <section id="mazeContainer">            
            <!-- Affichage du labyrinthe -->
            <table class="maze" style="min-width:<?php echo $column*27.1 ?>px;">
                <?php $maze->render($maze); ?>
            </table>
        </section>
    </body>
</html>