function disablePac(id){
    document.getElementById(id).style.display ="none";
}

function activatePac(id){
    document.getElementById(id).style.display="block";
}

function alertText($message){
    alert($message);
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
    else{
        alert('mur');
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
    else{
        alert('mur');
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
    else{
        alert('mur');
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
    else{
        alert('mur');
    }
    testVictoire()
}

function testVictoire(){
    if(position==cellEnd)
    {
        alert("Gagné");
    }
}