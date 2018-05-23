$(document).ready(function() {

    $(".editNote").click(function(e){

        e.preventDefault();


        var _token = $("input[name='_token']").val();

        var oldCustomerNumber = $("input[name='oldCustomerNumber']").val();
        var notesCustomerID = $("input[name='notesCustomerID']").val();
        var customerName = $("input[name='customerName']").val();
        var phoneNumber = $("input[name='phoneNumber']").val();
        var additionalInfo = $("textarea[name='additionalInfo']").val();

        $.ajax({

            url: "http://localhost/bauchi/public/editNotes",

            type:'POST',

            data: {_token:_token, notesCustomerID:notesCustomerID, oldCustomerNumber:oldCustomerNumber, customerName:customerName, phoneNumber:phoneNumber, additionalInfo:additionalInfo},

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    alert(data.success);

                    $("#newNotes")[0].reset();

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

        $(".print-error-notes-msg").find("ul").html('');

        $(".print-error-notes-msg").css('display','block');

        $.each( msg, function( key, value ) {

            $(".print-error-notes-msg").find("ul").append('<li>'+value+'</li>');
            $(".print-error-notes-msg").fadeOut(5000);
        });

    }

    function printSuccessMsg (success) {

        $(".print-success-notes-msg").find("ul").html('');

        $(".print-success-notes-msg").css('display','block');


        $(".print-success-notes-msg").find("ul").append(success);
        $(".print-success-notes-msg").fadeOut(5000);

    }

});

