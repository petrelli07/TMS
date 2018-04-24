$(document).ready(function() {

    $(".btn-edit").click(function(e){

        e.preventDefault();


        var _token = $("input[name='_token']").val();

        var idpersonal = $("input[name='idpersonal']").val();

        var title = $("select[name='title']").val();
        var customerID = $("input[name='customerID']").val();
        var fullName = $("input[name='fullName']").val();
        var surname = $("input[name='surname']").val();
        var firstName = $("input[name='firstName']").val();
        var otherNames = $("input[name='otherNames']").val();

        var serviceArea = $("select[name='serviceArea']").val();
        var density = $("select[name='density']").val();
        var zone = $("select[name='zone']").val();
        var subZone = $("select[name='subZone']").val();
        var houseNumber = $("input[name='houseNumber']").val();
        var street = $("input[name='street']").val();
        var town = $("input[name='town']").val();
        var city = $("input[name='city']").val();
        var country = $("input[name='country']").val();

        var customerType = $("select[name='customerType']").val();
        var bizCategory = $("select[name='bizCategory']").val();
        var mobilePhone = $("input[name='mobilePhone']").val();
        var homePhone = $("input[name='homePhone']").val();
        var emailAddress = $("input[name='emailAddress']").val();
        var lastPayment = $("input[name='lastPayment']").val();
        var accountOpenDate = $("input[name='accountOpenDate']").val();
        var lastPaymentDate = $("input[name='lastPaymentDate']").val();
        var currentBalance = $("input[name='currentBalance']").val();

        var round = $("select[name='round']").val();
        var folio = $("input[name='folio']").val();
        var suffix = $("input[name='suffix']").val();
        var dpCode = $("input[name='dpCode']").val();

        /*var not = $('.notif:checked').serialize();

        console.log((not));*/

        var arr=[];

        $.each($("input[type='checkbox']"),function(){
            arr.push($(this).val());
        });

        $.ajax({

            url: "http://localhost/bauchi/public/editCustomerAccount",

            type:'POST',

            data: {_token:_token, title:title, idpersonal:idpersonal, customerID:customerID, fullName:fullName, surname:surname, firstName:firstName, otherNames:otherNames, serviceArea:serviceArea, density:density, zone:zone, subZone:subZone, houseNumber:houseNumber, street:street, town:town, city:city, country:country, customerType:customerType, bizCategory:bizCategory, mobilePhone:mobilePhone, homePhone:homePhone, emailAddress:emailAddress, lastPayment:lastPayment, accountOpenDate:accountOpenDate, lastPaymentDate:lastPaymentDate, currentBalance:currentBalance, round:round, folio:folio, suffix:suffix, dpCode:dpCode, notifyBy:arr},

            success: function(data) {

                if($.isEmptyObject(data.error)){

                    printSuccessMsg(data.success);

                    $("#customerData")[0].reset();

//                    setTimeout(function(){// wait for 5 secs(2)
//                        location.reload(); // then reload the page.(3)
//                    }, 10000);

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

