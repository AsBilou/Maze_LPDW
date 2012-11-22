<?php
/*######################################AMAZING MAZE#################################
Le maze est construit � partir d'un tableau unique contenant : 
-les autorisations de d�placement (NORD/EST/SUD/OUEST)
-les murs(NORD/EST/SUD/OUEST)
-l�tat de la cellule (vierge/visit�/construite)

Le principe est de navigu� dans TOUTE les cellules du tableau afin que chaque cellules sois reli�e � TOUTE les autres.
Ainsi, plus besoin de d�finir une fin et un d�but puisque TOUTE les cellules peuvent �tre reli� entre elle, le d�but
et la fin du maze peuvent se trouver n'importe ou.

On commence � cr�er notre tableau de cellule, X*Y.
On calcule les autorisations de navigu� simplement en prenant les X premi�re cellule et en leurs mettant l'autorisation
d'aller au NORD � 0.
On fais la m�me chose pour les X derni�res(SUD), modulo de X pour l'OUEST et modulo de X-1 pour l'EST.

On rempli ensuite les murs sur TOUTE les cellules.

Une fonction unique est n�c�ssaire � la construction du labyrinthe.
On passe la premi�re cellule al�atoirement.
On random sur les directions autoris�.
Et on va directement � la prochaine.

Sur les cellules suivante on ne random plus sur TOUTE les directions mais uniquement sur les cellule qui n'ont JAMAIS
�t� visit�, ainsi on ne peut pas revenir sur des cellules d�ja visit�.
On stock �galement dans un tableau le parcours r�alis�.

Au bout d'un moment, quant la cellule active est entour� de 4 cellule d�ja visit� on reviens sur nos pas, sur la derni�re
cellule auparavant visit�, et on passe la cellule active en CONSTRUITE.
Une cellule construite ne peut en AUCUN CAS �tre parcourus � nouveau.

Un fois qu'aucune cellule vierge ou visit� n'est d�t�ct� � cot� de la cellule active, c'est que TOUTE les cellules ont
�t� visit� 2 fois, le maze est fini.

Il est loin d'�tre parfait, je l'ai fais d'une traite alors beaucoup de chose peuvent �tre niqu�, mais il marche, et la
th�orie fonctionne.

Si je me relis je comprend rien non plus, alors bonne chance !
#####################################################################################*/


session_start();

//Nombre de case en X
$x = 30;
//Nombre de case en Y
$y = 30; 
//Nombre de cellule au total
$nbr_cell = $x*$y;
//On instancie l'array qui contiendra toute les infos du maze
$maze = array();

//CREATION DU FULL MAZE
for($i=0; $i<($x*$y); $i++){
	//On met toute les autorisations de naviguer � 1
	for($j=0; $j<4; $j++){
		$maze[$i]['auth'][$j] = 1;
	}
	//On check les exceptions pour les cot�s du maze
	if($i < $x){
		$maze[$i]['auth'][0] = 0;//premiere ligne on met les autorisations de monter � 0
	}
	if($i>=($nbr_cell-$x)){
		$maze[$i]['auth'][2] = 0;//Derniere ligne, on met les autorisations de descendre � 0
	}
	if(($i % $x) == 0){
		$maze[$i]['auth'][3] = 0;//La colonne de gauche, on met les autorisations de tourner � gauche � 0
	}
	if(($i % $x) == ($x-1)){
		$maze[$i]['auth'][1] = 0;//la colonne de droite, on met les autorisations de tourner � droite � 0
	}
	
	for($j=0; $j<4; $j++){
		$maze[$i]['wall'][$j] = 1;//on construit les walls, on remplie TOUTE les cellules avec 4 wall
	}
	
	$maze[$i]['etat']=0;//on met l'�tat de toute les cellules � 0 = 'Non visit�'
}

//CREATION DU MAZE
$start_cell = rand($nbr_cell-$x, ($nbr_cell-1));//on random la cellule de d�pard
$maze[$start_cell]['wall'][2] = 0;//on ouvre le mur �xt�rieure de la premi�re cellule = entr� du maze
$random_end = rand(0, $x-1);//on random la sortie du maze
$maze[$random_end]['wall'][0] = 0;//on ouvre le mur �xt�rieure de la sortie
$chemin_parcourus 		=array();//on instancie un array qui contiendra le chemin parcourus

createMaze($start_cell, $maze, $x, $y, $chemin_parcourus);//on envoi la premi�re boucle

function createMaze($start_cell, $maze, $x, $y, $chemin_parcourus){
	$maze[$start_cell]['etat'] = 1;//on passe la cellule active en visit�
	
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
		createMaze($next_cell, $maze, $x, $y, $chemin_parcourus);
	}else{
		$_SESSION['maze'] = $maze;
	}
	//#####################################################################################
}
?>
<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" media="screen" href="style.css">
  <title></title>
</head>
<body>
<table>
<?php
for($i=0;$i<$nbr_cell;$i++){
	if(($i % $x) == 0){
		echo '<tr>';
	}
	echo '<td class="';
	if($_SESSION['maze'][$i]['wall'][0] == 1){
			echo 'border_top ';
	}
	if($_SESSION['maze'][$i]['wall'][1] == 1){
			echo 'border_right ';
	}
	if($_SESSION['maze'][$i]['wall'][2] == 1){
			echo 'border_bottom ';
	}
	if($_SESSION['maze'][$i]['wall'][3] == 1){
			echo 'border_left ';
	}
	echo'"></td>';
	if(($i % $x) == ($x-1)){
		echo '</tr>';
	}
}
?>
</table>
</body>
</html>