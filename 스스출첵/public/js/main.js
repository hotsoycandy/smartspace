$(document).ready(function(){
    var absent = false;
    $("#absent").click(function(){
        if(!absent){
            absent = true;
            $("#absent_box").css("height","300px");
        }
        else{
            $("#absent_form").submit();
        }
    });
    $("#absent_cal").click(function(){
        absent = false;
        $("#absent_box").css("height","0");
    });
});