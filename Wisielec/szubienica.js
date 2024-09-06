var haslo = "";
var haslo1="";
var ile_skuch=1;
var dlugosc;
window.onload = start;

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
    document.getElementById("plansza").innerHTML=haslo1;
}


function start()
{
    haslo = document.getElementById("plansza").innerText;
    haslo=haslo.toUpperCase();
    dlugosc = haslo.length;

    for(i=0;i<dlugosc;i++){
        if(haslo.charAt(i)==" ") haslo1+=" ";
        else haslo1+="-";
    }
    
    var tresc_diva="";

    for(i=0;i<35;i++)
    {
        var element="lit"+i;

        tresc_diva+='<div class="litera" onclick="sprawdz('+i+')" id="'+element+'" > '+litery[i]+' </div>';
        if((i+1)%7==0) tresc_diva+='<div style="clear:both;"></div> '
    }

    document.getElementById("alfabet").innerHTML=tresc_diva;



    wypisz_haslo();
}

String.prototype.ustawZnak=function(miejsce,znak)
{
    if(miejsce>this.lenght-1) return this.toString();
    else return this.substr(0,miejsce)+znak+this.substr(miejsce+1);
}

function sprawdz(nr)
{
    var trafiona=false;
    for(i=0;i<dlugosc;i++)
    {
        if(haslo.charAt(i)==litery[nr])
        {
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
        ile_skuch++;
        var obraz="s"+ile_skuch+".jpg";
        document.getElementById("szubienica").innerHTML='<img src="'+obraz+'" alt="" />';
    }
}
