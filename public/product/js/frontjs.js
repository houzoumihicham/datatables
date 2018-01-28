var pdfemails = function () {

    // Renew domain names

    var rechargeRealisationByCategory = function(){

        $('.cat').on('click', function () {

            var id =$(this).data("cat-id");
            var name =$(this).data("cat-name");
            var realisation_list=$('#realisation-list');
            $.ajax({
                url: '/'+id+'/cate-ajax',
                type: "get",
                beforeSend: function(){
                    $('.loader').show();
                },
                complete: function(){
                    $('.loader').hide();
                },
                success: function(data){

                    $data = $(data);

                    realisation_list.html($data);
                    realisation_list.append('<input type="hidden" value="'+id+'" name="thisid">');

                    history.pushState({}, "", "/realisation/"+id+name+"/cate");
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
            });
        });
    }

    var pagination = function(){
        $(document).on('click', '.pagination a', function (e) {
            page = $(this).attr('href').split('page=')[1];
            thisid=  $("input[name=thisid]").val();
            var realisation_list=$('#realisation-list');
            $.ajax({
                url: '/'+thisid+'/cate-ajax?page=' + page,
                type: "get",
                beforeSend: function(){
                    $("html, body").animate({ scrollTop: "300px" });
                    $('.loader').show();
                },
                complete: function(){
                    $('.loader').hide();
                },
                success: function(data){

                    $data = $(data);

                    realisation_list.html($data);
                    realisation_list.append('<input type="hidden" value="'+thisid+'" name="thisid">');


                }
            });
            e.preventDefault();
        });
    }


    return {

        //main function to initiate the module
        init: function () {

            rechargeRealisationByCategory();
            pagination();



        }

    };

}();

jQuery(document).ready(function() {
    pdfemails.init();
});