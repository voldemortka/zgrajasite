var go=false;  //check czy wgl ryszać wężem
var teraz1=0, teraz2=186;
var what1='p', what2='l';   //p, l, g, d
var fail=false;
let v = [0]; //kolejka z wężem
let w = [0];  //drugi wąż
var licznik=0;
var robal = []; //spis robali
var bugs1=0, bugs2=0;
var first=true;

function strzalki(event){
    switch(event.code){
        case "ArrowUp": {if(what1!='d') what1='g'; break;}
        case "ArrowDown": {if(what1!='g') what1='d'; break;}
        case "ArrowLeft": {if(what1!='p') what1='l'; break;}
        case "ArrowRight": {if(what1!='l') what1='p'; break;}
        case "KeyW": {if(what2!='d') what2='g'; break;}
        case "KeyS": {if(what2!='g') what2='d'; break;}
        case "KeyA": {if(what2!='p') what2='l'; break;}
        case "KeyD": {if(what2!='l') what2='p'; break;}
    }
}
document.addEventListener("keydown", strzalki);


function start(){
    if(!first)
    {
        go=false;
        $('#start').addClass('zak');
    }
    else 
    {
        //rozpocznij
        
        for(i=0;i<v.length;i++)
            $('#p'+v[i]).html("<img src='pusty2.png'>");
        for(i=0;i<robal.length;i++)
            $('#p'+v[i]).html("<img src='pusty2.png'>");

        first=false;
        teraz1=0; teraz2=186;
        v = []; w=[];
        robal = [];
        what1='p'; what2='l';
        licznik=0;
        bugs1=0; bugs2=0;
        $('#count').html("Eaten bugs count: 0 : 0");    
        go=true;
        $('#start').html("Zakończ");
    }
}

function findv(co){
    for(i=0;i<v.length;i++){
        if(v[i]==co) return i;
    }
    for(i=0;i<w.length;i++){
        if(w[i]==co) return i;
    }
    return -1;
}

function findR(co){
    for(i=0;i<robal.length;i++){
        if(robal[i]==co) return i;
    }
    return -1;
}


function ustaw1(){
   // alert("OK");
    let R = findR(teraz1);
    if(R!=-1){
        //zjadł robala
        bugs1++;
        $('#count').html("Eaten bugs count: "+bugs1+" : "+bugs2);
        $('#p'+teraz1).html("<img src='head.png'>");
        robal.splice(R, 1);
       // v.push(teraz);
    }
    //let V = findv(teraz);
    else if(findv(teraz1)==-1)
    {
      //  alert(v[0]);
        $('#p'+v[0]).html("<img src='pusty2.png'>");
        v.shift();

        $('#p'+teraz1).html("<img src='head.png'>");
        //v.push(teraz);
    }
    else {$('#p'+teraz1).html("<img src='head.png'>"); go=false;}
    //if(R==-1 && V!=-1) {fail=true; go=false;}
}

function ustaw2(){
    let R = findR(teraz2);
    if(R!=-1){
        //zjadł robala
        bugs2++;
        $('#count').html("Eaten bugs count: "+bugs1+" : "+bugs2);
        $('#p'+teraz2).html("<img src='head2.png'>");
        robal.splice(R, 1);
       // v.push(teraz);
    }
    //let V = findv(teraz);
    else if(findv(teraz2)==-1)
    {
        $('#p'+w[0]).html("<img src='pusty2.png'>");
        w.shift();

        $('#p'+teraz2).html("<img src='wonsz2.png'>");
        //v.push(teraz);
    }
    else {$('#p'+teraz2).html("<img src='head2.png'>"); go=false;}
    //if(R==-1 && V!=-1) {fail=true; go=false;}
}

function wonsz(){
    if(go){
        switch(what1){
            case 'p':
            {
                v.push(teraz1); 
                $('#p'+teraz1).html("<img src='wonsz.png'>");
                if(teraz1%17==16) teraz1-=16;
                else teraz1+=1;
                ustaw1();
                break;
            }
            case 'l': 
            {
                v.push(teraz1); 
                $('#p'+teraz1).html("<img src='wonsz.png'>");
                if(teraz1%17==0) teraz1+=16;
                else teraz1-=1;
                ustaw1();
                break;
            }
            case 'g': 
            {
                v.push(teraz1); 
                $('#p'+teraz1).html("<img src='wonsz.png'>");
                if(teraz1<17) teraz1+=170;
                else teraz1-=17;
                ustaw1();
                break;
            }
            case 'd': 
            {
                v.push(teraz1); 
                $('#p'+teraz1).html("<img src='wonsz.png'>");
                if(teraz1>169) teraz1-=170;
                else teraz1+=17;
                ustaw1();
            }
            if(fail) {}//komunikat czy coś
        }

        switch(what2){
            case 'p':
            {
                w.push(teraz2); 
                $('#p'+teraz2).html("<img src='head2.png'>");
                if(teraz2%17==16) teraz2-=16;
                else teraz2+=1;
                ustaw2();
                break;
            }
            case 'l': 
            {
                w.push(teraz2); 
                $('#p'+teraz2).html("<img src='head2.png'>");
                if(teraz2%17==0) teraz2+=16;
                else teraz2-=1;
                ustaw2();
                break;
            }
            case 'g': 
            {
                w.push(teraz2); 
                $('#p'+teraz2).html("<img src='head2.png'>");
                if(teraz2<17) teraz2+=170;
                else teraz2-=17;
                ustaw2();
                break;
            }
            case 'd': 
            {
                w.push(teraz2); 
                $('#p'+teraz2).html("<img src='head2.png'>");
                if(teraz2>169) teraz2-=170;
                else teraz2+=17;
                ustaw2();
            }
            if(fail) {}//komunikat czy coś
        }

        if(licznik%20==0)
        {
            var ran = Math.floor(Math.random() * (186 - 0 + 1)) + 0;
            if(findv(ran)==-1) $('#p'+ran).html("<img src='bugC.png'>");
            robal.push(ran);
        }
        licznik++;
    }
    setTimeout(wonsz,100);
}