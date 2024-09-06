const socket = new WebSocket('ws://localhost:3000');
var name1; var name2; var id1; var id2;

//połączenie z serwerem
    socket.addEventListener('open', (event) => {
        console.log('Server connected at pacy');
    });


//wszystkie wiadomości od serera idące, wszytko od innych graczy; typ ten sam co wiadomosci, która wyszła
    socket.addEventListener('message', (event) => {   
        console.log("at pacy");       
        console.log(`Message from server: ${event.data}`);
        try{
            const dane = JSON.parse(event.data);
            console.log("unjsoning done pacy");

            switch(dane.type){
                case 'mess_sent':
                    console.log('received from '+dane.name2);
                    $('#mess_okienko').append("<div class='messes1'>"+dane.tresc+"</div>");
                    break;
                default:
                    console.log('UFO in user!');
            }

        } catch {console.log("bad unjsoning pacy");}
    });


//rozłączenie, jakieś errory z serwera
    socket.addEventListener('close', (event) => {
        console.log('Disconnected from WebSocket server');
    });

    socket.addEventListener('error', (error) => {
        console.log(`WebSocket error: ${error}`);
    });

$('#form_mess_messenger').submit((event)=>{
    //chęci wysłania wiadomości
    event.preventDefault();
    let tekst = $('#mess_text').val();
    console.log("wanted: "+tekst);
    $('#mess_text').val("");
    console.log("<div class='last_mess'><div class='last_name'>"+name2+"</div><div class='last_tekst'>"+tekst+"</div></div>");
    $('#mess_okienko').append("<div class='messes2'>"+tekst+"</div>");
    const to_send = JSON.stringify({ type: "mess_sent", name1: name1, id1: id1, name2: name2, id2: id2, tresc: tekst });
    console.log(to_send); 
    socket.send(to_send);
});



function take_vars(n1, i1, n2, i2){
    name1 = n1; id1=i1; name2=n2, id2=i2;
    console.log("pobrano dane userów");
}








//languages, others...
function cancel_zgraja(){
    $('.komunikat').css('border: none');
    //$('.komunikat').addClass('komunikat_cancel');

    
    //<div id='xzgr' onclick='cancel_zgraja()'>x</div>
}

function changeL(){
    let tekst = "Here u have a few of my games. There should be played by one or two people using one device. On the top of the sceen u have a link leading to games to play with a few people, eweryone from another computer. Ofc, u can play these games alone, but it's nonesense. Anyway, enjoy<div onclick='changeL2()' id='change'>Pl</div>";
    $('.komunikat').html(tekst);
}

function changeL2(){
    let tekst = "Przed wami kilka gier mojej produkcji do grania na jednym komputerze w jedną lub dwie osoby. Na górze mamy zakładkę z grami do grania w kilka osób, każdy z innego komputera. Jasne, można grać w nie w pojedynkę, ale nie ma to za bardzo sensu XD Anyway, miłego grania<div onclick='changeL()' id='change'>Eng</div>";
    $('.komunikat').html(tekst);
}

function show_mess(id, name){
    const dataToSend = {
      id: id,
      name: name
    };
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'take_mess_name.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log('Response from server:', xhr.responseText);
            window.location.href = 'http://localhost/mine/zgrajasite%20node/messenger.html';

        } else {
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.send(JSON.stringify(dataToSend));
}


function info_przekier(){
    $('#przekier_info').css('opacity', 0.9);
}

function info_out(){
    $('#przekier_info').css('opacity', 0);
}