$(document).ready(function() {

    $(".btnBillingEdit").click(function(e){

        e.preventDefault();


        var _token = $("input[name='_token']").val();
        var customerIDBill = $("input[name='billCustomerID']").val();

        var houseNumber = $("input[name='houseNum']").val();
        var street = $("input[name='streetName']").val();
        var town = $("input[name='domTown']").val();
        var state = $("input[name='billState']").val();
        var country = $("input[name='country']").val();

        //alert(street);

        $.ajax({

            url: "http://localhost/bauchi/public/updateBill",

            type:'POST',

            data: {_token:_token, houseNum:houseNumber, billCustomerID:customerIDBill, streetName:street, domTown:town, billState:state, country:country},

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    alert(data.success);

                    $("#Billing")[0].reset();

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

        $(".print-error-billing-msg").find("ul").html('');

        $(".print-error-billing-msg").css('display','block');

        $.each( msg, function( key, value ) {

            $(".print-error-billing-msg").find("ul").append('<li>'+value+'</li>');
            $(".print-error-billing-msg").fadeOut(5000);
        });

    }

    function printSuccessMsg (success) {

        $(".print-success-billing-msg").find("ul").html('');

        $(".print-success-billing-msg").css('display','block');


        $(".print-success-billing-msg").find("ul").append(success);
        $(".print-success-billing-msg").fadeOut(5000);

    }

});

