$(document).ready(function(){
    init(); //funciones cargas al inicio

    checkNight();//funcion para comprobar el modo noche
});

function init(){
    $("#tooglenight").change(function() {
        const data = new FormData();//creamos datos para un form
        if(this.checked) {
            $("#bd").addClass("night");
            $(".footer i").css("color", "white");
            $(".by").css("color", "white");
            data.append('nightMode', 'yes');//incluimos key y valor
        }else{
            data.append('nightMode', 'no');
            $("#bd").removeClass("night");
            $(".footer i").css("color", "#ff8d0c");
            $(".by").css("color", "#ff8d0c");
        }
        //send data post con ajax JQuery
        fetch('./core/night.php', {
           method: 'POST',
           body: data
        })
        .then(function(response) {
           if(response.ok) {
               return response.text();
           } else {
               throw "Error en la llamada Ajax";
           }
        })
        .then(function(texto) {
           console.log(texto);
        })
        .catch(function(err) {
           console.log(err);
        });
    });

    $(".btEditar").click(function(evt) {
        evt.preventDefault(); 
        $(' .ocult').fadeOut(1000);

        var listIcon = $('.btEditar');

        for (var i = 0; i < listIcon.length; i++) {
            listIcon[i].children[0].className = 'fas fa-angle-down fa-3x';
        }

        var iconItem = evt.currentTarget.children[0].attributes[0];
        if(iconItem.value == "fas fa-angle-down fa-3x"){
            iconItem.value = "fas fa-angle-up fa-3x";
        }else{
            iconItem.Value = "fas fa-angle-down fa-3x";
        }
        $('#'+evt.currentTarget.parentElement.parentElement.id+' .ocult').fadeIn(1000);
    });

    $("input[name='delTexts']").click(function(evt){
        confirmAction(evt);
    });

    $("input[name='delete-sn']").click(function(evt){
        confirmAction(evt);
    });
    
    $("input[name='isIMG']").click(function(evt){
        if(this.checked){
            $("input[name='newIsIMG']")[0].value = "true";
            this.value = "true";
            this.checked = true;
        }else{
            $("input[name='newIsIMG']")[0].value = "false";
            this.value = "false";
            this.checked = false;
        }
    });

}

function checkNight(){
    if(night === 'yes'){
        $("#tooglenight").click();
    }
}

function confirmAction(elemen){
    try {
    
        if(window.confirm('No se puede deshacer ¿Estas seguro?')){
            elemen.currentTarget.parentNode.submit();
            return true;
        }else{
            elemen.preventDefault();
            return false;
        }
    } catch (e) {
        elemen.preventDefault();
        //confirmAction(elemen);
        //console.log("error : " + e);
    }
    return false;
}