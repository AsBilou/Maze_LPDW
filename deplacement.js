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
    if((maze[position][0]==0)&&((position-nbColumn)>=0))
    {
        newPosition = position-nbColumn;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire()
}

//Fait aller a gauche le bonhomme
function leftPacman(){
    var newPosition;
    if(maze[position][3]==0)
    {
        newPosition = position-1;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire()
}

//Fait descendre le bonhomme
function downPacman(){
    var newPosition;
    if((maze[position][2]==0)&&((position+nbColumn)<nbCell))
    {
        newPosition = position+nbColumn;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire()
}

//Fait aller a droite le bonhomme
function rightPacman(){
    var newPosition;
    if(maze[position][1]==0)
    {
        newPosition = position+1;
        disablePac(position);
        activatePac(newPosition);
        position = newPosition;
    }

    testVictoire()
}

//Vérifie si le bonhomme est sur la case final du maze
function testVictoire(){
    if(position==cellEnd)
    {
        alert("Gagné !");
    }
}