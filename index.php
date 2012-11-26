<?php
/*######################################AMAZING MAZE#################################
Le maze est construit à partir d'un tableau unique contenant : 
-les autorisations de déplacement (NORD/EST/SUD/OUEST)
-les murs(NORD/EST/SUD/OUEST)
-létat de la cellule (vierge/visité/construite)

Le principe est de navigué dans TOUTE les cellules du tableau afin que chaque cellules sois reliée à TOUTE les autres.
Ainsi, plus besoin de définir une fin et un début puisque TOUTE les cellules peuvent étre relié entre elle, le début
et la fin du maze peuvent se trouver n'importe ou.

On commence à créer notre tableau de cellule, X*Y.
On calcule les autorisations de navigué simplement en prenant les X première cellule et en leurs mettant l'autorisation
d'aller au NORD à 0.
On fais la même chose pour les X dernières(SUD), modulo de X pour l'OUEST et modulo de X-1 pour l'EST.

On rempli ensuite les murs sur TOUTE les cellules.

Une fonction unique est nécéssaire à la construction du labyrinthe.
On passe la première cellule aléatoirement.
On random sur les directions autorisé.
Et on va directement à la prochaine.

Sur les cellules suivante on ne random plus sur TOUTE les directions mais uniquement sur les cellule qui n'ont JAMAIS
été visité, ainsi on ne peut pas revenir sur des cellules déja visité.
On stock également dans un tableau le parcours réalisé.

Au bout d'un moment, quant la cellule active est entouré de 4 cellule déja visité on reviens sur nos pas, sur la dernière
cellule auparavant visité, et on passe la cellule active en CONSTRUITE.
Une cellule construite ne peut en AUCUN CAS être parcourus à nouveau.

Un fois qu'aucune cellule vierge ou visité n'est détécté à coté de la cellule active, c'est que TOUTE les cellules ont
été visité 2 fois, le maze est fini.

Il est loin d'être parfait, je l'ai fais d'une traite alors beaucoup de chose peuvent être niqué, mais il marche, et la
théorie fonctionne.

Si je me relis je comprend rien non plus, alors bonne chance !
#####################################################################################*/

include('functions.php');

session_start();

//Nombre de case en X
$x = 30;
//Nombre de case en Y
$y = 30; 

//On instancie l'array qui contiendra toute les infos du maze

$maze = new Maze($x,$y);
$maze->createMaze();//on envoi la première boucle


?>