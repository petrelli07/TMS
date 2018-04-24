$(document).ready(function() {

        $("tbody").on("click", "button.btnMeterReadingSpec", function(e){

        e.preventDefault();
            var get_first_element = $(this).attr("formfield-1");
            var get_first_element_value =   $("#"+get_first_element).val();


           // alert(get_first_element_value);
            var get_second_element = $(this).find("formfield-2");
            var get_second_element_value =   $("#"+get_second_element).val();

            alert(get_second_element_value)

            var get_third_element = $(this).attr("formfield-3");
            var get_third_element_value =   $("#"+get_third_element).val();

            var get_fourth_element = $(this).attr("formfield-4");
            var get_fourth_element_value =   $("#"+get_fourth_element).val();

            var get_fifth_element = $(this).attr("formfield-5");
            var get_fifth_element_value =   $("#"+get_fifth_element).val();

            var get_sixth_element = $(this).attr("formfield-6");
            var get_sixth_element_value =   $("#"+get_sixth_element).val();


            var _token = $("input[name='_token']").val();

            /*
             var get_first_element = $(this).attr("formfield-1");
             var get_first_element_value =   $("#"+get_first_element).val();*/


            //var formValues = $('.meterReadingValues').serialize();
//        alert(formValues);

            $.ajax({

                url: "http://localhost/bauchi/public/createMeterReading",

                type:'POST',

                data: {_token:_token, meterReading:get_first_element_value, dateRead:get_second_element_value, customerID:get_third_element_value, fullName:get_fourth_element_value, meter1Serial:get_fifth_element_value, units:get_sixth_element_value},

                success: function(data) {

                    if($.isEmptyObject(data.error)){

                        printSuccessMsg(data.success);

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

