$(document).ready(function(){
    $("#tooglenight").change(function() {
        if(this.checked) {
            $("#bd").addClass("night");
            $(".footer i").css("color", "white");
            $(".by").css("color", "white");
        }else{
            $("#bd").removeClass("night");
            $(".footer i").css("color", "#ff8d0c");
            $(".by").css("color", "#ff8d0c");
        }
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
});
