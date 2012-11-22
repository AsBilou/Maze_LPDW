<?php

class MyClass{
	 public function __construct() { }
	  
	public function createMaze($start_cell, $maze, $x, $y, $nbr_cell, $nbr_parcours, $chemin_parcourus){
		$final_maze=array();
		$maze[$start_cell]['etat'] = 1;//on passe la cellule en visité
		
		//##############################RANDOM DE LA DIRECTION#################################
		$cell_auth = array();
		foreach($maze[$start_cell]['auth'] as $key=>$value){
			if($value == 1){
				array_push($cell_auth, $key);
			}
		}
		$rand_keys = array_rand($cell_auth, 1);
		$direction = $cell_auth[$rand_keys];
		//#####################################################################################
		//########################LISTE DES CELLULES ADJACENTE ACCESSIBLE######################
		$possible_cell_virgin	= array();
		$possible_cell_visited 	= array();
		$possible_cell_built 	= array();
		
		foreach($cell_auth as $key=>$possible_direction){
			switch ($possible_direction){
				case 0:
					$next_possible_cell = $start_cell - $x;
					switch ($maze[$next_possible_cell]['etat']) {
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
					$next_possible_cell = $start_cell +1;
					switch ($maze[$next_possible_cell]['etat']) {
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
					$next_possible_cell = $start_cell + $x;
					switch ($maze[$next_possible_cell]['etat']) {
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
					$next_possible_cell = $start_cell -1;
					switch ($maze[$next_possible_cell]['etat']) {
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
			array_push($chemin_parcourus, $start_cell);
		}
		if(empty($possible_cell_virgin)){
			$maze[$start_cell]['etat'] = 2;
			$next_cell = end($chemin_parcourus);
			array_pop($chemin_parcourus);
		}
		if(empty($possible_cell_virgin) && empty($possible_cell_visited)){
			$continue = 0;
		}
		if(!isset($continue)){
			//########################ON BRECK LES WALLS ENTRE CES CELLULES########################
			if($next_cell == ($start_cell-$x)){//NORD
				$maze[$start_cell]['wall'][0] = 0;//on casse le wall de la cellule
				$maze[$next_cell]['wall'][2] = 0;//on casse le mur de la prochaine cellule
			}
			if($next_cell == ($start_cell+$x)){//SUD
				$maze[$start_cell]['wall'][2] = 0;//on casse le wall de la cellule
				$maze[$next_cell]['wall'][0] = 0;//on casse le mur de la prochaine cellule
			}
			if($next_cell == ($start_cell+1)){//EST
				$maze[$start_cell]['wall'][1] = 0;//on casse le wall de la cellule
				$maze[$next_cell]['wall'][3] = 0;//on casse le mur de la prochaine cellule
			}
			if($next_cell == ($start_cell-1)){//OUEST
				$maze[$start_cell]['wall'][3] = 0;//on casse le wall de la cellule
				$maze[$next_cell]['wall'][1] = 0;//on casse le mur de la prochaine cellule
			}
			//#####################################################################################
			createMaze($next_cell, $maze, $x, $y, $nbr_cell, $nbr_parcours, $chemin_parcourus);
		}else{
		echo 'blabla';
		}
		//#####################################################################################
	}
}
?>