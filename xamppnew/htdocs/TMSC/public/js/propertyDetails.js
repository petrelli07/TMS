$(document).ready(function() {

    $(".propsDetails").click(function(e){

        e.preventDefault();


        var _token = $("input[name='_token']").val();

        $.ajax({

            async:false,

            processData: false,

            contentType: false,

            url: "http://localhost/bauchi/public/createPropertyDetail",

            type:'POST',

            data: new FormData($("#propsDetails")[0]),

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    printSuccessMsg(data.success);

                    $("#propsDetails")[0].reset();
//
//                    setTimeout(function(){// wait for 5 secs(2)
//                        location.reload(); // then reload the page.(3)
//                    }, 10000);

                }else{

                    alert(data.error);

                }

            }

        });


    });
    function printErrorMsg (msg) {

        $(".print-error-propdetails-msg").find("ul").html('');

        $(".print-error-propdetails-msg").css('display','block');

        $.each( msg, function( key, value ) {

            $(".print-error-propdetails-msg").find("ul").append('<li>'+value+'</li>');
            $(".print-error-propdetails-msg").fadeOut(5000);
        });

    }

    function printSuccessMsg (success) {

        $(".print-success-propdetails-msg").find("ul").html('');

        $(".print-success-propdetails-msg").css('display','block');


        $(".print-success-propdetails-msg").find("ul").append(success);
        $(".print-success-propdetails-msg").fadeOut(5000);

    }

});

