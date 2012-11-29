<?php
/*
    Description du tabelau maze :
        maze[cell]['auth'][0|1|2|3]=authorisation
                  ['wall'][0|1|2|3]=murs
                  ['etat'][0|1|2]=états
                  
    Les directions : 
            0 = Nord
            1 = Est
            2 = Sud
            3 = Ouest
                  
    Les différents état du Maze : 
        Pour les authorisation 'auth' :
            0 = non authorisé
            1 = Authorisé
            
        Pour les murs           'wall': 
            0 = pas de mur
            1 = mur
            
        Pour les états          'etat':
            0 = Non visité
            1 = en cours (restera en 'en cours' temps qu'il y aura des cellules a l'état '0')
            2 = construite (Toutes les cellules voisines sont construite alors on passe a la prochaine 'en cours' et on pass ela cellule actuel en construite).
*/
class maze{

    /**********
    *Variables*
    ***********/
    
    var $line;
    var $column;
    var $maze=array();
    var $start_cell;
    var $random_end;
    var $chemin_parcourus = array();//on instancie un array qui contiendra le chemin parcourus.
    
    /*************
    *Constructeur*
    **************/
    
    //Constructue de l'objet Maze. On passe en parametre le nombre de ligne et de colonne que nous voulons.
    public function maze($x,$y) {
         $this->line = $x;
         $this->column = $y;
         
         //Nombre de cellule au total
         $nbr_cell = $this->line*$this->column;
         
         //Création du maze complet, sans le chemin. 
        for($i=0; $i<$nbr_cell; $i++){
            //On met toute les autorisations de naviguer à 1
            for($j=0; $j<4; $j++){
                $this->maze[$i]['auth'][$j] = 1;
            }
            //On check les exceptions pour les cotés du maze
            if($i < $this->column){
                $this->maze[$i]['auth'][0] = 0;//premiere ligne on met les autorisations de monter à 0
            }
            if($i>=($nbr_cell-$this->column)){
                $this->maze[$i]['auth'][2] = 0;//Derniere ligne, on met les autorisations de descendre à 0
            }
            if(($i % $this->column) == 0){
                $this->maze[$i]['auth'][3] = 0;//La colonne de gauche, on met les autorisations de tourner à gauche à 0
            }
            if(($i % $this->column) == ($this->column-1)){
                $this->maze[$i]['auth'][1] = 0;//la colonne de droite, on met les autorisations de tourner à droite à 0
            }
            
            for($j=0; $j<4; $j++){
                $this->maze[$i]['wall'][$j] = 1;//on construit les walls, on remplie TOUTE les cellules avec 4 wall
            }
            
            $this->maze[$i]['etat']=0;//on met l'état de toute les cellules à 0 = 'Non visité'
        }
        
        //Sélection aléatoire du point d'entré et de sortie du Maze.
        $this->start_cell = rand($nbr_cell-$this->column, ($nbr_cell-1));//on random la cellule de dépard sur la derniere ligne.
        $this->maze[$this->start_cell]['wall'][2] = 0;//on ouvre le mur éxtérieure de la première cellule = entré du maze
        $this->random_end = rand(0, $this->column-1);//on random la sortie du maze sur la premiere ligne.
        $this->maze[$this->random_end]['wall'][0] = 0;//on ouvre le mur éxtérieure de la sortie
     }
    
    /********
    *GET/SET*
    *********/
    
    //Retourne l'objet maze en tableau
    public function getMazeArray(){
         return ($this->maze);
     }
    
    //Retourne le nombre de cellules
    public function getNbCells(){
        return (($this->line)*($this->column));
     }
    
    //Retourne la cellule de départ
    public function getStartCell(){
         return $this->start_cell;
     }
    
    //Retroune le nombre de collone
    public function getNbColumn(){
         return $this->column;
     }
    
    //Retourne la cellule d'arrivé
    public function getCellEnd(){
         return ($this->random_end);
     }
    
     //Print_r le tableau maze
    public function toString(){
         echo("<pre>");
         print_r($this->maze);
         echo("</pre>");
     }
    
    /**********
    *Fonctions*
    ***********/
    
    //Construction du tableau javascript à partir des données du tableau PHP
    public function convertPhpToJavascript($maze){
         $nbCell = $maze->getNbCells();
         $startCell = $maze->getStartCell();
         $nbColumn = $maze->getNbColumn();
         $cellEnd = $maze->getCellEnd();
         echo "<script type='text/javascript'> ";
         echo 'position = ';
         echo $startCell;
         echo '; ';
         echo 'positionFixe = ';
         echo $startCell;
         echo '; ';
         echo 'nbColumn = ';
         echo $nbColumn;
         echo '; ';
         echo 'nbCell = ';
         echo $nbCell;
         echo '; ';
         echo 'cellEnd = ';
         echo $cellEnd;
         echo '; ';
         echo'maze = Array();'; 
            for($cell=0;$cell<$nbCell;$cell++){
                echo "maze[$cell] = Array();";
                for( $wall=0;$wall<4;$wall++){
                    $value = $maze->maze[$cell]['wall'][$wall];
                    echo "maze[";
                    echo $cell;
                    echo "][";
                    echo $wall;
                    echo "] = ";
                    echo $value;
                    echo ";";
                }
            }
        echo '</script>';
     }
    
    //Crée l'affichage du maze
    public function render($maze){
        $column = $maze->getNbColumn();
        $nbCell = $maze->getNbCells();
        
        //On parcour toutes les lignes du tableaux pour l'afficher.
        for($i=0;$i<$nbCell;$i++){
            if(($i % $column) == 0){
                echo '<tr>';
            }
            echo '<td id="';
            echo $i;
            echo '" class="';
            if($maze->maze[$i]['wall'][0] == 1){
                    echo 'border_top ';
            }
            if($maze->maze[$i]['wall'][1] == 1){
                    echo 'border_right ';
            }
            if($maze->maze[$i]['wall'][2] == 1){
                    echo 'border_bottom ';
            }
            if($maze->maze[$i]['wall'][3] == 1){
                    echo 'border_left ';
            }
            if($i == $this->start_cell){
                echo 'colorStart ';
            }elseif($i == $this->random_end){
                echo 'colorEnd ';
            }
            echo'"><img ';
            echo 'id = "img_';
            echo $i;
            echo '" ';
            echo'class=" '; 
            //Si la cellule en cours est la cellule de départ, alors on affiche le personnage.
            $status=($this->start_cell==$i?'':'disable');
            echo($status);
            echo'" src="img/Cat" /></td>';
            if(($i % $column) == ($column-1)){
                echo '</tr>';
            }
        }
     }
    
    //Construit le labyrinthe
    public function buildMaze($start_cell){
         //On commence de la cellule de départ
         $cell_auth=array(); //Tableau qui contiendra toutes les directions disponibles.
         foreach($this->maze[$start_cell]['auth'] as $key=>$value){
            if($value == 1){
                array_push($cell_auth, $key);
            }
        }
        
        //On répertorie les cellules voisines et leur état et on mets dnas des tableaux
        $possible_cell_virgin   = array();
        $possible_cell_visited  = array();
        $possible_cell_built    = array();
        
        foreach($cell_auth as $key=>$possible_direction){
            switch ($possible_direction){
                case 0:     //Quand on monte
                    $next_possible_cell = $start_cell - $this->column;
                    //On repertorie l'état des cellule voisine.
                    switch ($this->maze[$next_possible_cell]['etat']) {
                        case 0:
                            array_push($possible_cell_virgin, $next_possible_cell);
                            break;
                        case 1:
                            array_push($possible_cell_visited, $next_possible_cell);
                            break;
                        case 2:
                            array_push($possible_cell_built, $next_possible_cell);
                            break;
                    }
                    break;
                case 1:     //Quand on va a droite
                    $next_possible_cell = $start_cell +1;
                    switch ($this->maze[$next_possible_cell]['etat']) {
                        case 0:
                            array_push($possible_cell_virgin, $next_possible_cell);
                            break;
                        case 1:
                            array_push($possible_cell_visited, $next_possible_cell);
                            break;
                        case 2:
                            array_push($possible_cell_built, $next_possible_cell);
                            break;
                    }
                    break;
                case 2:     //Quand on descend.
                    $next_possible_cell = $start_cell + $this->column;
                    switch ($this->maze[$next_possible_cell]['etat']) {
                        case 0:
                            array_push($possible_cell_virgin, $next_possible_cell);
                            break;
                        case 1:
                            array_push($possible_cell_visited, $next_possible_cell);
                            break;
                        case 2:
                            array_push($possible_cell_built, $next_possible_cell);
                            break;
                    }
                    break;
                case 3:     //Quand on va a gauche
                    $next_possible_cell = $start_cell -1;
                    switch ($this->maze[$next_possible_cell]['etat']) {
                        case 0:
                            array_push($possible_cell_virgin, $next_possible_cell);
                            break;
                        case 1:
                            array_push($possible_cell_visited, $next_possible_cell);
                            break;
                        case 2:
                            array_push($possible_cell_built, $next_possible_cell);
                            break;
                    }
                    break;
            }
        }
        
        //Si des cellules sont vierges alors on random pour choisir une direction
        if(!empty($possible_cell_virgin)){
            $this->maze[$start_cell]['etat'] = 1;
            $rand_keys = array_rand($possible_cell_virgin, 1);
            $next_cell = $possible_cell_virgin[$rand_keys];
            array_push($this->chemin_parcourus,$start_cell);
        }
        if(empty($possible_cell_virgin)){
            $this->maze[$start_cell]['etat'] = 2;
            $next_cell = end($this->chemin_parcourus);
            array_pop($this->chemin_parcourus);
        }
        if(empty($possible_cell_virgin) && empty($possible_cell_visited)){
            $continue = 0;
        }
        if(!isset($continue)){
            //########################ON BRECK LES WALLS ENTRE CES CELLULES########################
            if($next_cell == ($start_cell-$this->column)){//NORD
                $this->maze[$start_cell]['wall'][0] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][2] = 0;//on casse le mur de la prochaine cellule
            }
            if($next_cell == ($start_cell+$this->column)){//SUD
                $this->maze[$start_cell]['wall'][2] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][0] = 0;//on casse le mur de la prochaine cellule
            }
            if($next_cell == ($start_cell+1)){//EST
                $this->maze[$start_cell]['wall'][1] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][3] = 0;//on casse le mur de la prochaine cellule
            }
            if($next_cell == ($start_cell-1)){//OUEST
                $this->maze[$start_cell]['wall'][3] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][1] = 0;//on casse le mur de la prochaine cellule
            }
            $start_cell=$next_cell;

            //#####################################################################################
            $this->buildMaze($start_cell);
        }
     }
}
?>