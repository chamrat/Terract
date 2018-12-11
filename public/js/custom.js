//var SITE_URL = 'http://dev.terract.com';
var SITE_URL = 'http://127.0.0.1:8000';
$(".radio-change").on('change', function () {
    $('#property_unit_list').empty();
    $('#invite-btn').prop('disabled', false);
    $('#tenant_email').prop('disabled', false);
    var token = $("input[name=_token]").val();
    var propertyId = this.value;
    $.ajax({
        url: SITE_URL+'/propertyUnits',
        method: 'post',
        data: {propertyId: propertyId},
        headers: {'X-CSRF-TOKEN': token},
        success: function (units) {
            $('#property_unit_cont').show();
            var pUnits = $.parseJSON(units);
            if(pUnits.length > 0){
                $.each(pUnits, function (i, unit) {
                    $('#property_unit_list').append('<input type="radio" value="'+unit.id+'" name="property_unit_id">'+unit.unit_type+', '+unit.reference_name+'<br/>');
                })
            } else {
                $('#property_unit_list').append('<div class="alert-warning">No Property Units for this Property</div>');
                $('#invite-btn').prop('disabled', true);
                $('#tenant_email').prop('disabled', true);
            }

        }
    });
});

$('#property_unit_property_id').on('change', function(){
    var propertyId = this.value;
    $('#property_unit_list').empty();
    $.ajax({
        url: SITE_URL+'/unitsPerProperty',
        method: 'post',
        data: {propertyId: propertyId},
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: function (units) {
            var pUnits = $.parseJSON(units);
            if(pUnits.length > 0){
                $('#property_unit_list').append('<div class="title">Property Units:</div>');
                $.each(pUnits, function (i, unit) {
                    $('#property_unit_list').append('<div class="property-wrap">' +
                        '<div class="title">Type : '+unit.unit_type+'</div>' +
                        '<div class="details">Reference Name : '+unit.reference_name+'</div>' +
                        '<div class="details">Description : '+unit.description+'</div></div>');
                })
            } else {
                $('#property_unit_list').append('<div class="alert-warning">No Property Units for this Property</div>');
                $('#invite-btn').prop('disabled', true);
                $('#tenant_email').prop('disabled', true);
            }

        }
    });
});

$("#payment_method").change(function () {
    $("#cc-wrapper").hide();
    var payMtd = this.value;
    if(payMtd=='Credit Card' || payMtd=='Debit Card'){
        var hasCards = $("#hasCards").val();
        if(hasCards){
            $("#credit-card-launcher").show();
        } else {
            $("#cc-wrapper").show();
        }
    }
});
$("#addNewCard").on('click', function () {
    $("#credit-card-launcher").hide();
    $("#hasCards").val(0);
    $("#cc-wrapper").show();
})


function goHome() {
    window.location.href = 'http://127.0.0.1:8000/';
}

