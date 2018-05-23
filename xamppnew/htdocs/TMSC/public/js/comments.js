$(document).ready(function() {

    $(".btn-comment").click(function(e){

        e.preventDefault();


        var _token = $("input[name='_token']").val();
        var name = $("input[name='name']").val();
        var comment = $("textarea[name='comment']").val();
        var article_id = $("input[name='article_id']").val();
        
        $.ajax({

            url: "http://www.oghas.com/createComment",

            type:'POST',

            data: {_token:_token, name:name, comment:comment, article_id:article_id},

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    printSuccessMsg(data.success);

                    setTimeout(function(){ //wait for 5 secs(2)
//                        location.reload(); // then reload the page.(3)
                    }, 10000);

                }else{

                    printErrorMsg(data.error);

                }

            }

        });


    });

    function printErrorMsg (msg) {

        $(".print-error-msg").find("ul").html('');

        $(".print-error-msg").css('display','block');

        $.each( msg, function( key, value ) {

            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            $(".print-error-msg").fadeOut(5000);
        });

    }

    function printSuccessMsg (success) {

        $(".print-success-msg").find("ul").html('');

        $(".print-success-msg").css('display','block');


        $(".print-success-msg").find("ul").append(success);
        $(".print-success-msg").fadeOut(5000);

    }

});

