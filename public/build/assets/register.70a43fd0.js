$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            token: "24d5b95c-7cde-11ed-be76-3233f989b8f3"
        }
    });

    $(document).on("change", "#city", function () {
        $("#district").html("");
        $("#ward").html("");
        loadDistricts();
    });

    $(document).on("change", "#district", function () {
        $("#ward").html("");
        loadWards();
    });

    $(document).on("submit", "#form__js", function () {
        $("#loading__js").css("display", "flex");
    });

    const formRules = $("#form-data").data("rules");
    const formMessages = $("#form-data").data("messages");

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

    $("#form__js").validate({
        rules: formRules != null ? formRules : "",
        messages: formMessages != null ? formMessages : "",
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        submitHandler: function (form) {
            form.submit();
            $("#loading__js").css("display", "flex");
        }
    });
});



