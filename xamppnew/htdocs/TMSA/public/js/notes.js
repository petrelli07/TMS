$(document).ready(function() {

    $(".btn-notes").click(function(e){

        e.preventDefault();


        var _token = $("input[name='_token']").val();

        var oldCustomerNumber = $("input[name='oldCustomerNumber']").val();
        var notesCustomerID = $("input[name='notesCustomerID']").val();
        var customerName = $("input[name='customerName']").val();
        var phoneNumber = $("input[name='phoneNumber']").val();
        var additionalInfo = $("textarea[name='additionalInfo']").val();

        $.ajax({

            url: "http://localhost/bauchi/public/createNotes",

            type:'POST',

            data: {_token:_token, oldCustomerNumber:oldCustomerNumber, customerName:customerName, phoneNumber:phoneNumber, additionalInfo:additionalInfo, notesCustomerID:notesCustomerID},

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    printSuccessMsg(data.success);

                    $("#newNotes")[0].reset();

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

