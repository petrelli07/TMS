$(document).ready(function() {

    $(".newClientDets").click(function(e){

        e.preventDefault();
        var _token = $("input[name='_token']").val();/*


        alert(new FormData($("#clientDetails")[0]));*/

        $.ajax({

            async:false,

            processData: false,

            contentType: false,

            url: "http://localhost/TMSA/public/createNewUser",

            type:'POST',

            data: new FormData($("#clientDetails")[0]),
            success: function(data) {


                if($.isEmptyObject(data.error)){
                    printSuccessMsg(data.success);

                    $("#userDetails")[0].reset();
                    $(".ShowMeClient").hide();
                    $(".userDetails").show();

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


