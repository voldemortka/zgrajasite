var count = 0;

var tab = [0, 0, 0, 0, 0, 0, 0, 0, 0 ];

var k0  = document.getElementById('k0');
var k1  = document.getElementById('k1');
var k2  = document.getElementById('k2');
var k3  = document.getElementById('k3');
var k4  = document.getElementById('k4');
var k5  = document.getElementById('k5');
var k6  = document.getElementById('k6');
var k7  = document.getElementById('k7');
var k8  = document.getElementById('k8');

k0.addEventListener( "click", function() { mark(0); } );
k1.addEventListener( "click", function() { mark(1); } );
k2.addEventListener( "click", function() { mark(2); } );
k3.addEventListener( "click", function() { mark(3); } );
k4.addEventListener( "click", function() { mark(4); } );
k5.addEventListener( "click", function() { mark(5); } );
k6.addEventListener( "click", function() { mark(6); } );
k7.addEventListener( "click", function() { mark(7); } );
k8.addEventListener( "click", function() { mark(8); } );


var koniec=false;
var who;

function finish()
{
    if(tab[0]==tab[4] && tab[4]==tab[8] && tab[0]!=0) //koniec=true;
         {koniec=true; if(tab[0]==1) who="O"; else who="x";}
    else if (tab[2]==tab[4] && tab[4]==tab[6] && tab[2]!=0) //koniec=true;
         {koniec=true; if(tab[0]==1) who="O"; else who="x";}
         
    else if (tab[0]==tab[1] && tab[1]==tab[2] && tab[0]!=0) //koniec=true;
        {koniec=true; if(tab[0]==1) who="O"; else who="x";}
    else if (tab[3]==tab[4] && tab[4]==tab[5] && tab[3]!=0) //koniec=true;
        {koniec=true; if(tab[0]==1) who="O"; else who="x";}
    else if (tab[6]==tab[7] && tab[7]==tab[8] && tab[6]!=0) //koniec=true;
        {koniec=true; if(tab[0]==1) who="O"; else who="x";}

    else if (tab[0]==tab[3] && tab[3]==tab[6] && tab[0]!=0) //koniec=true;
        {koniec=true; if(tab[0]==1) who="O"; else who="x";}
    else if (tab[1]==tab[4] && tab[4]==tab[7] && tab[1]!=0) //koniec=true;
         {koniec=true; if(tab[0]==1) who="O"; else who="x";}
    else if (tab[2]==tab[5] && tab[5]==tab[8] && tab[2]!=0)// koniec=true;
        {koniec=true; if(tab[0]==1) who="O"; else who="x";}
}

function mark (nr)
{
    count++;
   // alert(nr);
    var image;
    if(count%2==0)
    {
        image = "kolo.png";
        tab[nr]=1;
    }
    else
    {
        image = "x.png";
        tab[nr]=2;
    }


   // alert(image);

    var obraz = "url("+image+")";

    $('#k'+nr).css('background-image', obraz);

    //setTimeout(function() { finish() }, 100); 
    finish();
    

    if(!koniec)
    {
        if(count==9) $('#table').html("Remis");
    }
    else
    {
        $('#table').html("Konieccc Mamy zwycięzcę: "+who);
    }

}