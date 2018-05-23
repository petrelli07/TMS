$(document).ready(function() {

    $(".btnMeter").click(function(e){

        e.preventDefault();

        var formValues = $('.meterValues').serialize();
        /*var _token = $("input[name='_token']").val();

        var customer = $("input[name='customer']").val();
        var meter1Serial = $("input[name='meter1Serial']").val();
        var meter1DateInstalled = $("input[name='meter1DateInstalled']").val();
        var meter1MIU = $("input[name='meter1MIU']").val();
        var meter1Location = $("input[name='meter1Location']").val();
        var meter1Multiplier = $("input[name='meter1Multiplier']").val();
        var meter1Size = $("input[name='meter1Size']").val();
        var meter1MeasuringUnit = $("select[name='meter1MeasuringUnit']").val();
        var meter1WaterScheme = $("select[name='meter1WaterScheme']").val();
*/
//        alert(meter1Serial + meter2Serial);

        $.ajax({

            url: "http://localhost/bauchi/public/createMeter",

            type:'POST',

            data: formValues,

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    //alert(data.success);

                    printSuccessMsg(data.success);

                    $("#meter_scheme")[0].reset();

//                    setTimeout(function(){// wait for 5 secs(2)
//                        location.reload(); // then reload the page.(3)
//                    }, 10000);

                }else{

                   alert(data.error);
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

