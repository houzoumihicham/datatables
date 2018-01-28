/*---------------------------------------------
 ----------------- Chnage input by Lang ---------
 ---------------------------------------------*/

function ChnageInputByLang(){

    $('.lang').on('change', function () {
        if( $(this).val()==="fr"){
            $("#name").show();
            $("#name_en").hide();
            $("#description").show();
            $("#description_en").hide();
            $('.lang').val('fr')
        }
        else{
            $("#name_en").show();
            $("#name").hide();
            $("#description_en").show();
            $("#description").hide();
            $('.lang').val('en')
        }
    });
}


/*---------------------------------------------
---- init Selected Categories for products ----
---------------------------------------------*/


function initProductsCataegorysSelect2(){

    var ids=Object.values($('input#categories').val());
    console.log(ids);
    $("#multiple").val(ids).trigger("change");

}




/*---------------------------------------------
----------------- Function Init ---------
---------------------------------------------*/

$(document).ready(function () {

    ChnageInputByLang();
    initProductsCataegorysSelect2();

});