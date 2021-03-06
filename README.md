The Amazing Maze
==============

The amazing maze est un générateur de labyrinth. Les langages utilisé sont le PHP pour la génération et le JavaScript pour le déplacement et la résolution.

Utilisation
===========

Quand le visiteur arrive sur notre site, le serveur lui genère un labyrinthe d'une taille 20*20 par défaut.
Grace au formulaire disponible sur la gauche du site, il peut demander à avoir un labyrinthe d'une taille diférente. Des valeurs minimal et maximal sont cependant apposé.
Il ne peux pas générer un labyrinthe de moins de 100 cases (10 lignes et 10 colonnes) ou de plus de 14161 (119lignes et 119 colonnes).
Cette limite est la resultante des limite fixé par OVH qui limite la mémoire disponible sur leur serveur. Sur un serveur local, en modifiant les données de configuration de PHP nous pouvons générer des labyrinthes d'une taille supérieur a 500*500.

Une fois le labyrinthe créé, le visiteur peux ce balader dedans grace a une petit personnage.
Il existe différente façon de ce déplacer. Les touche directionelles ou les touche Z,S,Q et D.
Une fois le labyrinthe résolue, la solution apparait. 

Pour regénérer un nouveau labyrinthe un simple clic sur le bouton "Generate" permet d'en obtenir un nouveau.

Génération
==========

La génération du maze ce fait coté serveur. 
Une classe "maze" contenu dans le fichier "maze.php" permet de créer un nouvel objet maze. On lui passe les parametres comme les lignes et colonnes désiré. 
Cette classe est constitué d'attributs et de méthodes : 


    Attributs : 
    ===========
    
    - line : Nombre de lignes dans le labyrinthe.
    - column : Nombre de colonne dans le labyrinthe.
    - maze : Tableau qui contient toutes les inforations sur le labyrinthe.
    - start_cell : Cellule de départ du labyrinthe.
    - random_end : Cellule de fin du labyrinthe.
    - chemin_parcourus : Tableau qui contient le chemins de la génération du labyrinthe. 
    
    
    Méthodes : 
    ==========
    
    maze($x,$y) : Constructeur de la classe. Elle prend en parametre le nombre de ligne et de colonne pour créer un tableau non construit.
    buildMaze($ramdom_start_cell) : Fonction qui permet de creuser le labyrinthe dans le tableau générer par le constructeur.
    render($maze) : crée l'affichage du labyrinthe a partir de son objet.
    convertPhpToJavascript($maze) : Converti le tableau PHP en tableau JavaScript en filtrant certaine information devenu inutile.
    
    
    Assesseur/Mutateur :
    ====================
    
    getMazeArray() : Retourne le tableau contenant les informations du labyrinthe.
    getNbCells() : Retourne le nombre de cellule dans le labyrinthe.
    getStartCell() : Retourne la cellule de départ.
    getNbColumn() : Retourne le nombre de colonne du labyrinthe.
    getCellEnd() : Retourne la cellule de fin du labyrnthe.
    toString() : Affiche le contenu du tabelau maze.


Résolution
==========

La résolution du labyrinthe ce passe coté client. Le langage utilisé est le JavaScript. 
Les fonctions permetant de gérer la résolution ce trouve dans le fichier "deplacement.js".
L'algorithme de résolution est un dérivé de l'algo de génération du maze. Il a été adapté pour enlever le recursif, qui est limité dans les navigateurs internet, et ne choisi plus aléatoirement sa direction mais maintenant commencera toujours par tester la case au dessus de lui, puis celle de droite, celle du bas et finalement celle de gauche.
Si jamais l'algorithme tombe dans un cul de sac, il retournera directement au dernière endrois qui dispose d'un nouveu choix de direction. 
Une fois le chemin final trouvé, une fonction parcoure ce chemin et change le fond de chaque cellule.


Déplacement
===========

Le déplacement de personnage ce fait en JavaScript. Les focntions permetant de gérer ce déplacement ce trouve dans le fichier "deplacement.js"
Le deplacement ce base sur le tableau Javascript qui découle du tableau PHP. Lors d'une demande de déplacement, le javascript vérifie si un mur est présent ou non sur la route. Le déplacement est validé ou non.
Une fois arrivé, la résolution automatique du labyrinthe est lancé pour afficher le chemin final.
