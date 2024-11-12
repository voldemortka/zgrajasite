var haslo = "";
var haslo1="";
var ile_skuch=1;
var dlugosc;
var nr=1;
//window.onload = start;

var passes=[], kats=[];

var litery=new Array(35);

litery[0]="A";
litery[1]="Ą";
litery[2]="B";
litery[3]="C";
litery[4]="Ć";
litery[5]="D";
litery[6]="E";
litery[7]="Ę";
litery[8]="F";
litery[9]="G";
litery[10]="H";
litery[11]="I";
litery[12]="J";
litery[13]="K";
litery[14]="L";
litery[15]="Ł";
litery[16]="M";
litery[17]="N";
litery[18]="Ń";
litery[19]="O";
litery[20]="Ó";
litery[21]="P";
litery[22]="Q";
litery[23]="R";
litery[24]="S";
litery[25]="Ś";
litery[26]="T";
litery[27]="U";
litery[28]="W";
litery[29]="V";
litery[30]="X";
litery[31]="Y";
litery[32]="Z";
litery[33]="Ź";
litery[34]="Ż";


function wypisz_haslo()
{
    $('#pass_box').html(haslo1);
    //document.getElementById("plansza").innerHTML=haslo1;
}


function start(data)
{

    passes = data.passes;
    kats = data.kats;

    haslo = passes[0];
    haslo=haslo.toUpperCase();

    haslo1 = haslo.replace(/[\p{L}]/gu, "?");
    haslo1 = haslo1.replace(/ /g, "     ");
    haslo = haslo.replace(/ /g, "     ");

    dlugosc = haslo.length;
    $('#pass_box').html(haslo1);

   /* for(i=0;i<dlugosc;i++){
        if(haslo.charAt(i)==" ") haslo1+=" ";
        else haslo1+="-";
    } */
    
  //  var tresc_diva="";

    for(i=0;i<35;i++)
    {
        var element="lit"+i; 

        $('#alfabet').append('<div class="litera" onclick="sprawdz('+i+')" id="'+element+'" > '+litery[i]+' </div>');
        if((i+1)%7==0) $('#alfabet').append('<div style="clear:both;"></div> ');
    }

  //  $('#alfabet').html(tresc_diva);
   // wypisz_haslo();
}

String.prototype.ustawZnak=function(miejsce,znak)
{
    if(miejsce>this.lenght-1) return this.toString();
    else return this.substr(0,miejsce)+znak+this.substr(miejsce+1);
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function poka(){
    $('#pass_box').html(haslo);
}

async function next(){
    $('#pass_box').html(haslo);
    await sleep(1000);
    if(nr==10) window.location.href="index.html";
    nr++;
    $('#nr').html(nr);
    haslo = passes[nr-1];
    let kat = kats[nr-1];
    $('#kategoria').html(kat);
    haslo=haslo.toUpperCase();

    haslo1 = haslo.replace(/[\p{L}]/gu, "?");
    haslo1 = haslo1.replace(/ /g, "     ");
    haslo = haslo.replace(/ /g, "     ");

    dlugosc = haslo.length;

    $('#pass_box').html(haslo1);

    $('#alfabet').html("");

    for(i=0;i<35;i++)
        {
            var element="lit"+i; 
    
            $('#alfabet').append('<div class="litera" onclick="sprawdz('+i+')" id="'+element+'" > '+litery[i]+' </div>');
            if((i+1)%7==0) $('#alfabet').append('<div style="clear:both;"></div> ');
        }
}

function sprawdz(nr)
{
    console.log(litery[nr]);
    console.log(nr);
    var trafiona=false;
    console.log(haslo);
    console.log(haslo1);
    console.log(dlugosc);
    for(i=0;i<dlugosc;i++)
    {
        if(haslo.charAt(i)==litery[nr])
        {
            console.log(i);
            haslo1=haslo1.ustawZnak(i,litery[nr]);
            trafiona=true;
        }
    }
    if(trafiona==true)
    {
        var element="lit"+nr;
        document.getElementById(element).style.background="#003300";
        document.getElementById(element).style.color="#00C000";
        document.getElementById(element).style.border="3px solid #00C000";
        document.getElementById(element).style.cursor="default";
        wypisz_haslo();
    }
    else
    {
        var element="lit"+nr;
        document.getElementById(element).style.background="#330000";
        document.getElementById(element).style.color="#C00000";
        document.getElementById(element).style.border="3px solid #C00000";
        document.getElementById(element).style.cursor="default";
    }

    if(haslo==haslo1) next();
}




function strzalki(event){

    if(event.key === 'ą' || event.key === 'Ą'){ sprawdz(1); return; }
    if(event.key === 'ę' || event.key === 'Ę'){ sprawdz(7); return; }
    if(event.key === 'ń' || event.key === 'Ń'){ sprawdz(18); return; }
    if(event.key === 'ć' || event.key === 'Ć'){ sprawdz(4); return; }
    if(event.key === 'ż' || event.key === 'Ż'){ sprawdz(34); return; }
    if(event.key === 'ź' || event.key === 'Ź'){ sprawdz(33); return; }
    if(event.key === 'ó' || event.key === 'Ó'){ sprawdz(20); return; }
    if(event.key === 'ł' || event.key === 'Ł'){ sprawdz(15); return; }
    if(event.key === 'ś' || event.key === 'Ś'){ sprawdz(25); return; }

    switch(event.code){
        case "KeyA": {sprawdz(0); break;}
        case "KeyB": {sprawdz(2); break;}
        case "KeyC": {sprawdz(3); break;}
        case "KeyD": {sprawdz(5); break;}
        case "KeyE": {sprawdz(6); break;}
        case "KeyF": {sprawdz(8); break;}
        case "KeyG": {sprawdz(9); break;}
        case "KeyH": {sprawdz(10); break;}
        case "KeyI": {sprawdz(11); break;}
        case "KeyJ": {sprawdz(12); break;}
        case "KeyK": {sprawdz(13); break;}
        case "KeyL": {sprawdz(14); break;}
        case "KeyM": {sprawdz(16); break;}
        case "KeyN": {sprawdz(17); break;}
        case "KeyO": {sprawdz(19); break;}
        case "KeyP": {sprawdz(21); break;}
        case "KeyQ": {sprawdz(22); break;}
        case "KeyR": {sprawdz(23); break;}
        case "KeyS": {sprawdz(24); break;}
        case "KeyT": {sprawdz(26); break;}
        case "KeyU": {sprawdz(27); break;}
        case "KeyW": {sprawdz(28); break;}
        case "KeyV": {sprawdz(29); break;}
        case "KeyX": {sprawdz(30); break;}
        case "KeyY": {sprawdz(31); break;}
        case "KeyZ": {sprawdz(32); break;}
    }

}

document.addEventListener("keydown", strzalki);
