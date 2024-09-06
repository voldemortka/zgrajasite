//works surely

var walls = [11,
    25,26, 29,30,31, 34, 37,38,39, 42,43,
    71,72, 74, 79,80,81, 86, 88,89,
    94,95, 97,98,99, 103, 107,108,109, 111,112,
    120, 132,
    139,140, 143, 146,147,148,150,151,152, 155, 158,159,
    162, 169, 175, 182,
    185, 187, 189,190, 192,193,194,195,196,197,198, 200,201, 203, 205,
    210, 213, 223, 226,
    233, 236, 239,240,241,242,243, 246, 249,
    255,256,257, 259, 264, 269, 271,272,273,
    284,285, 289,290];
var food = [];
var points = [];
var MaxPoints = 1560;
var KillPoints = [];

var Killing = false;

var duch1=170;
var duch2=67;
var duch3=130;

var d1Right=true;
var d2Right = false;
var d3Up = false;

var il=0;
var eaten=0;
var first = true;
var go = false;
var where='d';
var teraz=24;
var startOK=true;
var point=0;

var ExistFood=0;

function GetPoint(){
    let t=true;
    for(i=0;i<points.length;i++) {if(points[i]==teraz) {t=false; break;}}
    if(t)
    {
        points.push(teraz);
        point+=10;
        $('#PointsCount').html("Points: "+point);
    }
}

function strzalki(event){
    switch(event.key){
        case 'ArrowUp': {where='g'; $('#p'+teraz).html("<img src='Up.jpg'>"); break;}
        case 'ArrowDown': {where='d'; $('#p'+teraz).html("<img src='Down.jpg'>"); break;}
        case 'ArrowLeft': {where='l'; $('#p'+teraz).html("<img src='Left.jpg'>"); break;}
        case 'ArrowRight': {where='p'; $('#p'+teraz).html("<img src='Right.jpg'>"); break;}
    }
}
document.addEventListener("keydown", strzalki);

function ready(){
    for(i=0; i<23;i++) walls.push(i);
    for(i=299;i<322;i++) walls.push(i);
    for(i=23;i<299;i+=23) walls.push(i);
    for(i=22;i<322;i+=23) walls.push(i);

    for(i=0;i<walls.length;i++) $('#p'+walls[i]).html("<img src='wall.png'>");

    $('#p170').html("<img src='ok.png'>");
    $('#p171').html("<img src='ok.png'>");
    $('#p172').html("<img src='ok.png'>");
    $('#p173').html("<img src='ok.png'>");
    $('#p174').html("<img src='ok.png'>");

    duch1=170;
    duch2=67;
    duch3=130;
    $('#p170').html("<img src='duszek1.png'>");
    $('#p67').html("<img src='duszek2.png'>");
    $('#p130').html("<img src='duszek3.png'>");

    $('#p24').html("<img src='Down.jpg'>");

    first=false;
}

function start(){
    if(startOK){
        startOK=false;
        go=true;
        where='d';
        teraz=24;
        $('.start').addClass("unstart");
    }
}

//169 - 173 nr1
//47 - 67 nr2
//130 - 291 nr3 pion

function duszek1(){
    $('#p'+duch1).html("<img src='ok.png'>");
    //przesuń duszka
    switch(duch1){
        case 174: {d1Right=false; break;}
        case 170: {d1Right=true;}
    }
    if(d1Right) duch1++;
    else duch1--;

    $('#p'+duch1).html("<img src='duszek1.png'>");

    //trup?
    if(duch1==teraz)
    {
        go=false;
        $('#finish').html("DEAD");
    }
}
function duszek2(){
    let t=true;
    for(i=0;i<points.length;i++)
    {
        if(points[i]==duch2)
        {
            t=false;
            $('#p'+duch2).html("<img src='ok.png'>");
            break;
        }
    }
    if(t) $('#p'+duch2).html("<img src='point.png'>");

    switch(duch2){
        case 67: {d2Right=false; break;}
        case 47: {d2Right=true;}
    }
    if(d2Right) duch2++;
    else duch2--;
    $('#p'+duch2).html("<img src='duszek2.png'>");

    if(duch2==teraz)
    {
        go=false;
        $('#finish').html("DEAD");
    }
}
function duszek3(){
    let t=true;
    for(i=0;i<points.length;i++)
    {
        if(points[i]==duch3)
        {
            t=false;
            $('#p'+duch3).html("<img src='ok.png'>");
            break;
        }
    }
    if(t) $('#p'+duch3).html("<img src='point.png'>");

    switch(duch3){
        case 130: {d3Up=false; break;}
        case 291: {d3Up=true;}
    }
    if(d3Up) duch3-=23;
    else duch3+=23;
    $('#p'+duch3).html("<img src='duszek3.png'>");

    if(duch3==teraz)
    {
        go=false;
        $('#finish').html("DEAD");
    }

}

function FindGhost(x){
    if(duch1==x || duch2==x || duch3==x) 
    {
        $('#finish').html("DEAD");
        return true;
    }
    return false;
}

function FindWall(x){
    for(i=0;i<walls.length;i++) {if(walls[i]==x) return true;}
    return false;
}

function Food(){
    for(i=0;i<food.length;i++) {
        if(food[i]==teraz){
            alert ("food");
            eaten++;
            $('#licznik').html("Eaten fruts count: "+eaten);
            food.splice(i,1);
            ExistFood--;
            break;
        }
    }
}

function ustaw(){
    switch(where){
        case 'd':
        {
            if(FindGhost(teraz+23)) go=false;
            else if (!FindWall(teraz+23))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz+=23;
                $('#p'+teraz).html("<img src='Down.jpg'>");
                GetPoint();
                Food();
            }
            break;
        }
        case 'g':
        {
            if(FindGhost(teraz-23)) go=false;
            else if (!FindWall(teraz-23))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz-=23;
                $('#p'+teraz).html("<img src='Up.jpg'>");
                GetPoint();
                Food();
            }
            break;
        }
        case 'p':
        {
            if(FindGhost(teraz+1)) go=false;
            else if (!FindWall(teraz+1))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz+=1;
                $('#p'+teraz).html("<img src='Right.jpg'>");
                GetPoint();
                Food();
            }
            break;
        }
        case 'l':
        {
            if(FindGhost(teraz-1)) go=false;
            else if (!FindWall(teraz-1))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz-=1;
                $('#p'+teraz).html("<img src='Left.jpg'>");
                GetPoint();
                Food();
            }
        }
    }
}


function pacy(){
    if(first) ready();
    if(go) {ustaw(); if(go && il%2==0){duszek1(); duszek2(); duszek3();}}

    if(ExistFood<3 && point%200==0){
        let ran = Math.floor(Math.random() * (320 - 0 + 1)) + 24;
        let t=true;
        for(i=0;i<walls.length;i++){ if(walls[i]==ran) t=false;}
        if(t && ran!=teraz) $("#p"+ran).html("<img src='food"+ExistFood+".png'>");
        ExistFood++;
    }
    il++;
    if(points.length == MaxPoints)
    {
        $('#finish').html("WIN");
        go=false;
    }
    setTimeout("pacy()",100);
}var walls = [11,
    25,26, 29,30,31, 34, 37,38,39, 42,43,
    71,72, 74, 79,80,81, 86, 88,89,
    94,95, 97,98,99, 103, 107,108,109, 111,112,
    120, 132,
    139,140, 143, 146,147,148,150,151,152, 155, 158,159,
    162, 169, 175, 182,
    185, 187, 189,190, 192,193,194,195,196,197,198, 200,201, 203, 205,
    210, 213, 223, 226,
    233, 236, 239,240,241,242,243, 246, 249,
    255,256,257, 259, 264, 269, 271,272,273,
    284,285, 289,290];
var food = [];
var points = [];
var MaxPoints = 1560;
var KillPoints = [];

var Killing = false;

var duch1=170;
var duch2=67;
var duch3=130;

var d1Right=true;
var d2Right = false;
var d3Up = false;

var il=0;
var eaten=0;
var first = true;
var go = false;
var where='d';
var teraz=24;
var startOK=true;
var point=0;

var ExistFood=0;

function GetPoint(){
    let t=true;
    for(i=0;i<points.length;i++) {if(points[i]==teraz) {t=false; break;}}
    if(t)
    {
        points.push(teraz);
        point+=10;
        $('#PointsCount').html("Points: "+point);
    }
}

function strzalki(event){
    switch(event.key){
        case 'ArrowUp': {where='g'; $('#p'+teraz).html("<img src='Up.jpg'>"); break;}
        case 'ArrowDown': {where='d'; $('#p'+teraz).html("<img src='Down.jpg'>"); break;}
        case 'ArrowLeft': {where='l'; $('#p'+teraz).html("<img src='Left.jpg'>"); break;}
        case 'ArrowRight': {where='p'; $('#p'+teraz).html("<img src='Right.jpg'>"); break;}
    }
}
document.addEventListener("keydown", strzalki);

function ready(){
    for(i=0; i<23;i++) walls.push(i);
    for(i=299;i<322;i++) walls.push(i);
    for(i=23;i<299;i+=23) walls.push(i);
    for(i=22;i<322;i+=23) walls.push(i);

    for(i=0;i<walls.length;i++) $('#p'+walls[i]).html("<img src='wall.png'>");

    $('#p170').html("<img src='ok.png'>");
    $('#p171').html("<img src='ok.png'>");
    $('#p172').html("<img src='ok.png'>");
    $('#p173').html("<img src='ok.png'>");
    $('#p174').html("<img src='ok.png'>");

    duch1=170;
    duch2=67;
    duch3=130;
    $('#p170').html("<img src='duszek1.png'>");
    $('#p67').html("<img src='duszek2.png'>");
    $('#p130').html("<img src='duszek3.png'>");

    $('#p24').html("<img src='Down.jpg'>");

    first=false;
}

function start(){
    if(startOK){
        startOK=false;
        go=true;
        where='d';
        teraz=24;
        $('.start').addClass("unstart");
    }
}

//169 - 173 nr1
//47 - 67 nr2
//130 - 291 nr3 pion

function duszek1(){
    $('#p'+duch1).html("<img src='ok.png'>");
    //przesuń duszka
    switch(duch1){
        case 174: {d1Right=false; break;}
        case 170: {d1Right=true;}
    }
    if(d1Right) duch1++;
    else duch1--;

    $('#p'+duch1).html("<img src='duszek1.png'>");

    //trup?
    if(duch1==teraz)
    {
        go=false;
        $('#finish').html("DEAD");
    }
}
function duszek2(){
    let t=true;
    for(i=0;i<points.length;i++)
    {
        if(points[i]==duch2)
        {
            t=false;
            $('#p'+duch2).html("<img src='ok.png'>");
            break;
        }
    }
    if(t) $('#p'+duch2).html("<img src='point.png'>");

    switch(duch2){
        case 67: {d2Right=false; break;}
        case 47: {d2Right=true;}
    }
    if(d2Right) duch2++;
    else duch2--;
    $('#p'+duch2).html("<img src='duszek2.png'>");

    if(duch2==teraz)
    {
        go=false;
        $('#finish').html("DEAD");
    }
}
function duszek3(){
    let t=true;
    for(i=0;i<points.length;i++)
    {
        if(points[i]==duch3)
        {
            t=false;
            $('#p'+duch3).html("<img src='ok.png'>");
            break;
        }
    }
    if(t) $('#p'+duch3).html("<img src='point.png'>");

    switch(duch3){
        case 130: {d3Up=false; break;}
        case 291: {d3Up=true;}
    }
    if(d3Up) duch3-=23;
    else duch3+=23;
    $('#p'+duch3).html("<img src='duszek3.png'>");

    if(duch3==teraz)
    {
        go=false;
        $('#finish').html("DEAD");
    }

}

function FindGhost(x){
    if(duch1==x || duch2==x || duch3==x) 
    {
        $('#finish').html("DEAD");
        return true;
    }
    return false;
}

function FindWall(x){
    for(i=0;i<walls.length;i++) {if(walls[i]==x) return true;}
    return false;
}

function Food(){
    for(i=0;i<food.length;i++) {
        if(food[i]==teraz){
            alert ("food");
            eaten++;
            $('#licznik').html("Eaten fruts count: "+eaten);
            food.splice(i,1);
            ExistFood--;
            break;
        }
    }
}

function ustaw(){
    switch(where){
        case 'd':
        {
            if(FindGhost(teraz+23)) go=false;
            else if (!FindWall(teraz+23))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz+=23;
                $('#p'+teraz).html("<img src='Down.jpg'>");
                GetPoint();
                Food();
            }
            break;
        }
        case 'g':
        {
            if(FindGhost(teraz-23)) go=false;
            else if (!FindWall(teraz-23))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz-=23;
                $('#p'+teraz).html("<img src='Up.jpg'>");
                GetPoint();
                Food();
            }
            break;
        }
        case 'p':
        {
            if(FindGhost(teraz+1)) go=false;
            else if (!FindWall(teraz+1))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz+=1;
                $('#p'+teraz).html("<img src='Right.jpg'>");
                GetPoint();
                Food();
            }
            break;
        }
        case 'l':
        {
            if(FindGhost(teraz-1)) go=false;
            else if (!FindWall(teraz-1))
            {
                $('#p'+teraz).html("<img src='ok.png'>");
                teraz-=1;
                $('#p'+teraz).html("<img src='Left.jpg'>");
                GetPoint();
                Food();
            }
        }
    }
}


function pacy(){
    if(first) ready();
    if(go) {ustaw(); if(go && il%2==0){duszek1(); duszek2(); duszek3();}}

    if(ExistFood<3 && point%200==0){
        let ran = Math.floor(Math.random() * (320 - 0 + 1)) + 24;
        let t=true;
        for(i=0;i<walls.length;i++){ if(walls[i]==ran) t=false;}
        if(t && ran!=teraz) $("#p"+ran).html("<img src='food"+ExistFood+".png'>");
        ExistFood++;
    }
    il++;
    if(points.length == MaxPoints)
    {
        $('#finish').html("WIN");
        go=false;
    }
    setTimeout("pacy()",100);
}