<?php
class maze{
    var $line;
    var $column;
    var $maze=array();
    var $start_cell;
    var $random_end;
    
    public function maze($x,$y) {
         $this->line = $x;
         $this->column = $y;
         
         //Nombre de cellule au total
         $nbr_cell = $this->line*$this->line;
         
         //CREATION DU FULL MAZE
        for($i=0; $i<($this->line*$this->line); $i++){
            //On met toute les autorisations de naviguer à 1
            for($j=0; $j<4; $j++){
                $this->maze[$i]['auth'][$j] = 1;
            }
            //On check les exceptions pour les cotés du maze
            if($i < $this->line){
                $this->maze[$i]['auth'][0] = 0;//premiere ligne on met les autorisations de monter à 0
            }
            if($i>=($nbr_cell-$this->line)){
                $this->maze[$i]['auth'][2] = 0;//Derniere ligne, on met les autorisations de descendre à 0
            }
            if(($i % $this->line) == 0){
                $this->maze[$i]['auth'][3] = 0;//La colonne de gauche, on met les autorisations de tourner à gauche à 0
            }
            if(($i % $this->line) == ($this->line-1)){
                $this->maze[$i]['auth'][1] = 0;//la colonne de droite, on met les autorisations de tourner à droite à 0
            }
            
            for($j=0; $j<4; $j++){
                $this->maze[$i]['wall'][$j] = 1;//on construit les walls, on remplie TOUTE les cellules avec 4 wall
            }
            
            $this->maze[$i]['etat']=0;//on met l'état de toute les cellules à 0 = 'Non visité'
        }
        //CREATION DU MAZE

        $this->start_cell = rand($nbr_cell-$x, ($nbr_cell-1));//on random la cellule de dépard
        $maze[$this->start_cell]['wall'][2] = 0;//on ouvre le mur éxtérieure de la première cellule = entré du maze
        $this->random_end = rand(0, $x-1);//on random la sortie du maze
        $maze[$this->random_end]['wall'][0] = 0;//on ouvre le mur éxtérieure de la sortie
        $chemin_parcourus       =array();//on instancie un array qui contiendra le chemin parcourus
     }
     
     public function getMazeArray(){
         return ($this->maze);
     }
     
     public function getNbCells(){
        return (($this->line)*($this->column));
     }
      
     /*
public function createMaze(){
        $this->maze[$this->start_cell]['etat'] = 1;//on passe la cellule active en visité
        
        //##############################RANDOM DE LA DIRECTION#################################
        $cell_auth = array();
        foreach($this->maze[$this->start_cell]['auth'] as $key=>$value){
            if($value == 1){
                array_push($cell_auth, $key);
            }
        }
        $rand_keys = array_rand($cell_auth, 1);
        $direction = $cell_auth[$rand_keys];
        //#####################################################################################
        //########################LISTE DES CELLULES ADJACENTE ACCESSIBLE######################
        $possible_cell_virgin   = array();
        $possible_cell_visited  = array();
        $possible_cell_built    = array();
        
        foreach($cell_auth as $key=>$possible_direction){
            switch ($possible_direction){
                case 0:
                    $next_possible_cell = $this->start_cell - $this->column;
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
                case 1:
                    $next_possible_cell = $this->start_cell +1;
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
                case 2:
                    $next_possible_cell = $this->start_cell + $x;
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
                case 3:
                    $next_possible_cell = $this->start_cell -1;
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
        //#####################################################################################
        //########################ON CHECK SI CELLULE VIERGE ET ON RANDOM######################
        if(!empty($possible_cell_virgin)){
            $rand_keys = array_rand($possible_cell_virgin, 1);
            $next_cell = $possible_cell_virgin[$rand_keys];
            array_push($chemin_parcourus, $this->start_cell);
        }
        if(empty($possible_cell_virgin)){
            $this->maze[$this->start_cell]['etat'] = 2;
            $next_cell = end($chemin_parcourus);
            array_pop($chemin_parcourus);
        }
        if(empty($possible_cell_virgin) && empty($possible_cell_visited)){
            $continue = 0;
        }
        if(!isset($continue)){
            //########################ON BRECK LES WALLS ENTRE CES CELLULES########################
            if($next_cell == ($this->start_cell-$this->column)){//NORD
                $this->maze[$this->start_cell]['wall'][0] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][2] = 0;//on casse le mur de la prochaine cellule
            }
            if($next_cell == ($this->start_cell+$this->column)){//SUD
                $this->maze[$this->start_cell]['wall'][2] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][0] = 0;//on casse le mur de la prochaine cellule
            }
            if($next_cell == ($this->start_cell+1)){//EST
                $this->maze[$this->start_cell]['wall'][1] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][3] = 0;//on casse le mur de la prochaine cellule
            }
            if($next_cell == ($this->start_cell-1)){//OUEST
                $this->maze[$start_cell]['wall'][3] = 0;//on casse le wall de la cellule
                $this->maze[$next_cell]['wall'][1] = 0;//on casse le mur de la prochaine cellule
            }
            //#####################################################################################
        }else{
            $_SESSION['maze'] = $this->maze;
        }
        //#####################################################################################
    }
*/
}
?>