var go=false;  //check czy wgl ryszać wężem
var teraz=0;
var what='p';   //p, l, g, d
var fail=false;
let v = [0]; //kolejka z wężem
var licznik=0;
var robal = []; //spis robali
var bugs=0;
var first=true;

function FINISH_GAME() {
    //alert("weszło");
    const DaneZGry = { pkt: bugs };
    fetch('stats.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(DaneZGry)
    })
    .then(response => response.text()) // Pobierz odpowiedź jako tekst, aby zobaczyć jej zawartość
    .then(data => {
        console.log('Odpowiedź z serwera:', data); // Wyświetl odpowiedź w konsoli
        return JSON.parse(data); // Spróbuj sparsować odpowiedź jako JSON
    })    .catch(error => {
        console.error('Error:', error);
        //alert('Wystąpił błąd podczas wysyłania danych.');
    });
}

function strzalki(event){
    switch(event.key){
        case "ArrowUp": {if(what!='d') what='g'; break;}
        case "ArrowDown": {if(what!='g') what='d'; break;}
        case "ArrowLeft": {if(what!='p') what='l'; break;}
        case "ArrowRight": {if(what!='l') what='p'; break;}
    }
}
document.addEventListener("keydown", strzalki);


function start(){
    if(!first)
    {
        go=false;
        $('#start').addClass('zak');
        FINISH_GAME();
    }
    else 
    {
        //rozpocznij
        
        for(i=0;i<v.length;i++)
            $('#p'+v[i]).html("<img src='pusty.png'>");
        for(i=0;i<robal.length;i++)
            $('#p'+v[i]).html("<img src='pusty.png'>");

        first=false;
        teraz=0;
        v = [];
        robal = [];
        what='p';
        licznik=0;
        bugs=0;
        $('#count').html("Eaten bugs count: 0");    
        go=true;
        $('#start').html("Zakończ");
    }
}

function findv(co){
    for(i=0;i<v.length;i++){
        if(v[i]==co) return i;
    }
    return -1;
}

function findR(co){
    for(i=0;i<robal.length;i++){
        if(robal[i]==co) return i;
    }
    return -1;
}


function ustaw(){
    let R = findR(teraz);
    if(R!=-1){
        //zjadł robala
        bugs++;
        $('#count').html("Eaten bugs count: "+bugs);
        $('#p'+teraz).html("<img src='head.png'>");
        robal.splice(R, 1);
       // v.push(teraz);
    }
    //let V = findv(teraz);
    else if(findv(teraz)==-1)
    {
        $('#p'+v[0]).html("<img src='pusty.png'>");
        v.shift();

        $('#p'+teraz).html("<img src='head.png'>");
        //v.push(teraz);
    }
    else {$('#p'+teraz).html("<img src='head.png'>"); go=false; FINISH_GAME();}
    //if(R==-1 && V!=-1) {fail=true; go=false;}
}

function wonsz(){
    if(go){
        switch(what){
            case 'p':
            {
                v.push(teraz); 
                $('#p'+teraz).html("<img src='wonsz.png'>");
                if(teraz%17==16) teraz-=16;
                else teraz+=1;
                ustaw();
                break;
            }
            case 'l': 
            {
                v.push(teraz); 
                $('#p'+teraz).html("<img src='wonsz.png'>");
                if(teraz%17==0) teraz+=16;
                else teraz-=1;
                ustaw();
                break;
            }
            case 'g': 
            {
                v.push(teraz); 
                $('#p'+teraz).html("<img src='wonsz.png'>");
                if(teraz<17) teraz+=170;
                else teraz-=17;
                ustaw();
                break;
            }
            case 'd': 
            {
                v.push(teraz); 
                $('#p'+teraz).html("<img src='wonsz.png'>");
                if(teraz>169) teraz-=170;
                else teraz+=17;
                ustaw();
            }
            if(fail) {}//komunikat czy coś
        }
        if(licznik%30==0)
        {
            //var ran = Math.floor(Math.random() * (186 - 0 + 1)) + 0;
            var ran = Math.floor(Math.random()*186);
            if(findv(ran)==-1) $('#p'+ran).html("<img src='bug2.png'>");
            robal.push(ran);
        }
        licznik++;
    }
    setTimeout("wonsz()",100);
}
