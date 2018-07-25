$(document).ready(function(){
    $("#tooglenight").change(function() {
        if(this.checked) {
            $("#bd").addClass("night");
            $("i").css("color", "white");
            $(".by").css("color", "white");
        }else{
            $("#bd").removeClass("night");
            $("i").css("color", "#ff8d0c");
            $(".by").css("color", "#ff8d0c");
        }
    });
});
