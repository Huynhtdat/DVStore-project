$(document).ready(function(){
    //validation login
    $('#login-form__js').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Enter your Email",
                email: "Email address is not valid",
            },
            password: {
                required: "Enter your Password",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
    })

    // Display loading when submit login
    $(document).on('submit', '#login-form__js', function(){
        $('#loading__js').css('display', 'flex');
    });
});
