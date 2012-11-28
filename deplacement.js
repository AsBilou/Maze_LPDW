//Variable globale
var chemin_parcouru = Array(); 

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

//Fonction appeler lors de l'appui d'une touche
function touche(e){

    var touche = event.keyCode;
    
    var nom = String.fromCharCode(touche);
    if((nom == "Z")||(nom == "&")){
        upPacman()
    }
    if((nom == "S")||(nom == "(")){
        downPacman()
    }
    if((nom == "Q")||(nom == "%")){
        leftPacman()
    }
    if((nom == "D")||(nom == "'")){
        rightPacman()
    }
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
        //alert("Gagné !");
        return true;
    }
    else{
        return false;
    }
}

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
function tryMaze(startCell) {
    //recuperer la cellule actuel
    
    //recuperer les cellule accésible
    
    var possible_direction = Array();
    for(var i=0;i<4;i++) {
        if(maze[startCell][i]==0) {
            //On verrifie qu'on ne sort pas du maze au niveau des entrée et sortie.
            if(((i==2)&&(startCell+nbColumn>nbCell))||((i==0)&&(startCell-nbColumn<0))||(chemin_parcouru.inArray(getNextCell(startCell,i)))) {
                //On ne permet pas d'y aller
            }else {
                possible_direction.push(i);
                //alert(possible_direction);
            }
        }
    }
    
    if(possible_direction.length>0){
        //faire un ramdom des direction disponible
        var rndVal=possible_direction[Math.floor(Math.random()*possible_direction.length)];
        //On sauvegarde la position actuel dans un tableau
        chemin_parcouru.push(startCell);
        //On cherche la cellule qui correspond au sens choisi.
        nextCell = getNextCellAndMove(startCell,rndVal);
        //alert(nextCell);
        if(testVictoire()) {
            alert('Maze résolu');
            chemin_parcouru.push(nextCell);
            return 1;
        }else{
            return tryMaze(nextCell);
        }
    }else{
        reinit();
        chemin_parcouru=Array();
        return 0;
    }
}

function resolveMaze(){
    var tryAgain = 0; 
    var status=0;
    var beginCell;
    var nbEssai=0;
    while(tryAgain==0){
        beginCell = positionFixe;
        status=tryMaze(beginCell);
        if(status==1){
            //alert('passage a 1');
            tryAgain=1;
        }
        nbEssai++;
    }
    alert("Nombre d'essai : "+nbEssai);
    traceRoad(chemin_parcouru);

}

//réinitialise la résolution du maze
function reinit(){
    //on reinit le bonhomme
    disablePac(position);
    activatePac(positionFixe);
    //On reinitialise la position
    position=positionFixe;
}

function traceRoad(chemin_parcouru) {
    //Pour chaque element dans le tableau 'chemin_trace' colorer la case.
        for(var y=0;y<chemin_parcouru.length-1;y++){
            element = document.getElementById(chemin_parcouru[y]);
            styleCell = element.className;
            styleCell = styleCell+" color"
            element.setAttribute("class", styleCell);
        }
}

function colorCell(currentCell) {
    //Pour chaque element dans le tableau 'chemin_trace' colorer la case.
            element = document.getElementById(currentCell);
            styleCell = element.className;
            styleCell = styleCell+" color"
            element.setAttribute("class", styleCell);
}

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