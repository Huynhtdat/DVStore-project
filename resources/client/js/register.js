$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'token': '24d5b95c-7cde-11ed-be76-3233f989b8f3'
        }
    });

    // When user changes city
    $(document).on('change', '#city', function(){
        $('#district').html('<option value="">Chọn quận, huyện</option>');
        $('#ward').html('<option value="">Chọn phường, xã</option>');
        getDistrict();
    });

    $(document).on('change', '#district', function(){
        $('#ward').html('<option value="">Chọn phường, xã</option>');
        getWard();
    });

    // Check form submission
    $(document).on('submit', '#form__js', function(){
        $('#loading__js').css('display', 'flex');
    });

    const rules = $("#form-data").data("rules");
    const messages = $("#form-data").data("messages");

    $.validator.addMethod("checklower", function (value) {
        return value ? /[a-z]/.test(value) : true;
    });
    $.validator.addMethod("checkupper", function (value) {
        return value ? /[A-Z]/.test(value) : true;
    });
    $.validator.addMethod("checkdigit", function (value) {
        return value ? /[0-9]/.test(value) : true;
    });
    $.validator.addMethod("checkspecialcharacter", function (value) {
        return value ? /[%#@_\-]/.test(value) : true;
    });

    // Validate form
    $("#form__js").validate({
        rules: rules ?? "",
        messages: messages ?? "",
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        submitHandler: function (form) {
            form.submit();
            $('#loading__js').css('display', 'flex');
        },
    });
});

// Function to get districts
function getDistrict() {
    let provinceId = $('#city').val();
    $.ajax({
        type: 'GET',
        url: `https://esgoo.net/api-tinhthanh/2/${provinceId}.htm`,
    }).done(function(response) {
        console.log(response); // Debug line
        let options = '<option value="">Chọn quận, huyện</option>';
        if (Array.isArray(response)) {
            response.forEach(function(element) {
                options += `<option value="${element.DistrictID}">${element.DistrictName}</option>`;
            });
        } else {
            console.error('Data is not an array:', response);
        }
        $('#district').html(options);
        $('#ward').html('<option value="">Chọn phường, xã</option>');
    }).fail(function(error) {
        console.error('Error fetching districts:', error);
    });
}

// Function to get wards
function getWard() {
    let districtId = $('#district').val();
    $.ajax({
        type: 'GET',
        url: `https://esgoo.net/api-tinhthanh/3/${districtId}.htm`,
    }).done(function(response) {
        console.log(response); // Debug line
        let options = '<option value="">Chọn phường, xã</option>';
        if (Array.isArray(response)) {
            response.forEach(function(element) {
                options += `<option value="${element.WardCode}">${element.WardName}</option>`;
            });
        } else {
            console.error('Data is not an array:', response);
        }
        $('#ward').html(options);
    }).fail(function(error) {
        console.error('Error fetching wards:', error);
    });
}
