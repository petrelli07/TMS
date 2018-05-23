$(document).ready(function() {

    $(".btnServiceOrder").click(function(e){

        e.preventDefault();

        var formValues = $('.serviceOrderValues').serialize();


        $.ajax({

            url: "http://localhost/bauchi/public/createServiceOrder",

            type:'POST',

            data: formValues,

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    printSuccessMsg(data.success);


                    $("#serviceOrder")[0].reset();
//
//                    setTimeout(function(){// wait for 5 secs(2)
//                        location.reload(); // then reload the page.(3)
//                    }, 10000);

                }else{

                    printErrorMsg(data.error);
                    //printErrorMsg(data.error);

                }

            }

        });


    });
    function printErrorMsg (msg) {

        $(".print-error-meter-msg").find("ul").html('');

        $(".print-error-meter-msg").css('display','block');

        $.each( msg, function( key, value ) {

            $(".print-error-meter-msg").find("ul").append('<li>'+value+'</li>');
            $(".print-error-meter-msg").fadeOut(5000);
        });

    }

    function printSuccessMsg (success) {

        $(".print-success-meter-msg").find("ul").html('');

        $(".print-success-meter-msg").css('display','block');


        $(".print-success-meter-msg").find("ul").append(success);
        $(".print-success-meter-msg").fadeOut(5000);

    }

});

