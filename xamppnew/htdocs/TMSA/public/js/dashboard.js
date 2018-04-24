
$(document).ready(function() {
    $('[data-toggle="secure_product_purchase"]').popover({
        container: 'body',
        html: true,
        placement: 'bottom',
        trigger: 'hover',
        content: function() {
            if ($(window).width()>991){

                return '<p> You are about to buy a product and would want us to help you secure your purchase</p>'
        }
        }
});

});

$(document).ready(function() {
    $('[data-toggle="secure_product_sale"]').popover({
        container: 'body',
        html: true,
        placement: 'bottom',
        trigger: 'hover',
        content: function() {
            if ($(window).width()>991){
                return '<p> You are about to sell a product and would want us to help you secure your sale</p>'
        }
        }
    });
});

$(document).ready(function() {
    $('[data-toggle="secure_service_purchase"]').popover({
        container: 'body',
        html: true,
        placement: 'bottom',
        trigger: 'hover',
        content: function() {
            if ($(window).width()>991){
                return '<p> You are about to render a service and would want us to help you secure your transaction</p>'
        }
        }
    });
});

$(document).ready(function() {
    $('[data-toggle="my_profile"]').popover({
        container: 'body',
        html: true,
        placement: 'bottom',
        trigger: 'hover',
        content: function() {
            if ($(window).width()>991){
                return '<p> Edit your profile</p>'
        }
        }
    });
});

$(document).ready(function() {
    $('[data-toggle="secure_service_sale"]').popover({
        container: 'body',
        html: true,
        placement: 'bottom',
        trigger: 'hover',
        content: function() {
            if ($(window).width()>991){
                return '<p> You are about to pay for a service to be rendered and would want us to help you secure your transaction</p>'
        }
        }
    });
});

$(document).ready(function() {
    $('[data-toggle="transaction_history"]').popover({
        container: 'body',
        html: true,
        placement: 'bottom',
        trigger: 'hover',
        content: function() {
            if ($(window).width()>991){
                return '<p> View the history of all your transactions made on NoJibiti</p>'
        }
        }
    });
});
