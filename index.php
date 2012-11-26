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

include('functions.php');

session_start();

//Nombre de case en X
$x = 30;
//Nombre de case en Y
$y = 30; 

//On instancie l'array qui contiendra toute les infos du maze

$maze = new Maze($x,$y);
$maze->createMaze();//on envoi la premi�re boucle


?>