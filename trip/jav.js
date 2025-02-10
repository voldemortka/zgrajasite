/*function take_tab(){
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    
    const array = JSON.parse(getCookie("pytania"));

    console.log(array);

    //array = JSON.parse(`${document.cookie}`);

    var i=0;
    var dl = array.length;
} */

function take_tab() {
    function take_tab() {
        fetch("nazwa_twojego_pliku.php")
            .then(response => response.json()) // Parsowanie JSON-a
            .then(array => {
                console.log(array);
    
                var i = 0;
                var dl = array.length;
            })
            .catch(error => console.error("Błąd pobierania danych:", error));
    }
    
}


function new_q(){
    if(i<dl){
        $('#pytanka').html(array[i]);
        i++;
    }
}