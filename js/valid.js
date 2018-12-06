$(document).ready(function () {
    var fetch = /[\d]{1,12}\/[\d]{1,31}\/[\d]{2,4}/;
    $(".consular_p_G").click(function (){
        $(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
    });
    $("#dtDe, #dtA").keyup(function(){
        if( $(this).val() != ""&& fetch.test($(this).val()) ){
            $(".error").fadeOut();
            return false;
        }
    });
 });