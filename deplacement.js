/*
    Description du tabelau maze :
        maze[cell][0|1|2|3]=murs
                  
    Les directions : 
            0 = Nord
            1 = Est
            2 = Sud
            3 = Ouest
                  
    Les différents état du Maze : 
        Pour les murs           'wall': 
            0 = pas de mur
            1 = mur
*/

/*******************
*Variables globales*
********************/

//Contient le chemin final.
var chemin_parcouru = Array();
//Contient toute les cases visitée/traité
var tabVisite = Array();

/*********
*Listener*
**********/

//Fonction appeler lors de l'appui d'une touche
$(document).keydown(function(e){
    nom = e.keyCode;
    if((nom == 38)||(nom == 90)){
        upPacman();
    }
    if((nom == 40)||(nom == 83)){
        downPacman();
    }
    if((nom == 37)||(nom == 81)){
        leftPacman();
    }
    if((nom == 39)||(nom == 68)){
        rightPacman();
    }
});

/**********
*Fonctions*
***********/

//Cache le bonhomme et crée une trainé de couleur
function disablePac(id){
    id_img = 'img_'+id;
    document.getElementById(id_img).style.display ="none";

}
//Affiche le bonhomme
function activatePac(id){
    id_img = 'img_'+id;
    document.getElementById(id_img).style.display="block";
}

//Verifie si l'on peux bouger
function canMove(positionActuelle, direction) {
    var nextCell = getNextCell(positionActuelle, direction);//On recupere la prochaine cellule.
    if(nextCell < 0 || nextCell >= (nbCell))//Si elle sort du labyrinthe on bloque le déplacement.
        return false;
    
    if(maze[positionActuelle]!= undefined)//Et si la cellule existe alors on authorise le déplacement.
        return !maze[positionActuelle][direction];
    else
        return false;
}

//Fait monter le bonhomme
function upPacman(){
    var newPosition;
    if((maze[position][0]==0)&&((position-nbColumn)>=0)&&(testVictoire()==false))
    {
        newPosition = position-nbColumn;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire();
    return position;
}

//Fait aller a gauche le bonhomme
function leftPacman(){
    var newPosition;
    if((maze[position][3]==0)&&(testVictoire()==false))
    {
        newPosition = position-1;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire();
    return position;
}

//Fait descendre le bonhomme
function downPacman(){
    var newPosition;
    if((maze[position][2]==0)&&((position+nbColumn)<nbCell)&&(testVictoire()==false))
    {
        newPosition = position+nbColumn;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire();
    return position;
}

//Fait aller a droite le bonhomme
function rightPacman(){
    var newPosition;
    if((maze[position][1]==0)&&(testVictoire()==false))
    {
        newPosition = position+1;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire();
    return position;
}

//Vérifie si le bonhomme est sur la case final du maze
function testVictoire(){
    if(position==cellEnd)
    {
        return true;
    }
    else{
        return false;
    }
}

//Retourne le numero de la cellule suivante
function getNextCell(currentCell,direction){
    switch(direction) {
        case 0:
            nextCell=currentCell-nbColumn;
            break;
        case 1:
            nextCell=currentCell+1;
            break;
        case 2:
            nextCell=currentCell+nbColumn;
            break;
        case 3:
            nextCell=currentCell-1;
            break;
    }
    return nextCell;
}

//Retourne le numero de la cellule suivante et déplace le bonhomme
function getNextCellAndMove(currentCell,direction){
    switch(direction) {
        case 0:
            nextCell=upPacman();
            
            break;
        case 1:
            nextCell=rightPacman();
            break;
        case 2:
            nextCell=downPacman();
            
            break;
        case 3:
            nextCell=leftPacman();
            break;
    }
    return nextCell;
}

//resolution du maze automatiquement
function resolveMaze(){
    tryMaze(positionFixe);
    traceRoad(chemin_parcouru,"color2");
    traceRoad(tabVisite);

}

//Fonction qui parcours le tableau lors de la résolution du labyrinthe
function tryMaze(startCell) {

    //On verifi que l'on a bien passé une cellule en parametre.
    if(startCell == undefined)
        return -1;
    //On met la cellule dans le tableau des cellules visité. 
    tabVisite.push(startCell);
    //On test toute les direction en commencant par le haut
    for(var i=0;i<4;i++) {
        if(canMove(startCell,i)) {// Si il n'y a pas de mur
            var celluleCible = getNextCell(startCell,i);
            if(celluleCible == undefined)
                continue;
            if(!tabVisite.inArray(celluleCible)){ // On a pas encore visiter la case
                if(celluleCible == cellEnd) {
                    chemin_parcouru.push(startCell);
                    return 1;
                }
                else {
                    if(tryMaze(celluleCible) == 1) {// si la cellule est celle trouvée 
                        chemin_parcouru.push(startCell);
                        return 1
                    }
                }
            }
        }
    }
}

//réinitialise la résolution du maze
function reinit(){
    //on reinit le bonhomme
    disablePac(position);
    activatePac(positionFixe);
    //On reinitialise la position
    position=positionFixe;
}

//Trace la route (tableau) passé en parametre 
function traceRoad(chemin_parcouru,color) {
    if( color == undefined)
        color = "color";
    //Pour chaque element dans le tableau 'chemin_trace' colorer la case.
        for(var y=0;y<chemin_parcouru.length-1;y++){
            element = document.getElementById(chemin_parcouru[y]);
            styleCell = element.className;
            styleCell = styleCell+" "+color;
            element.setAttribute("class", styleCell);
        }
}

/*******************
*Fonctions ajoutées*
********************/

//Fonction in_array() php
Array.prototype.inArray = function (value) {
     // Returns true if the passed value is found in the
     // array. Returns false if it is not.
     var i;
     for (i=0; i < this.length; i++) {
        if (this[i] == value) {
            return true;
        }
     }
     return false;
};

//Fonction qui permet de retirer un element d'un tableau
Array.prototype.unset = function(value){
    var index = this.indexOf(value);
    if(index > -1){
        this.splice(index,1);
    }
}