function disablePac(id){
    id_img = 'img_'+id;
    document.getElementById(id_img).style.display ="none";
    element = document.getElementById(id);
    styleCell = element.className;
    styleCell = styleCell+" color"
    element.setAttribute("class", styleCell);
}

function activatePac(id){
    id_img = 'img_'+id;
    document.getElementById(id_img).style.display="block";
}

function alertText($message){
    alert($message);
}

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

function testVictoire(){
    if(position==cellEnd)
    {
        alert("Gagné !");
    }
}