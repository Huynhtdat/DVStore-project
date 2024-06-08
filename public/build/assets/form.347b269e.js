$(document).ready(function () {
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

    $("#form__js").validate({
        rules: rules != null ? rules : "",
        messages: messages != null ? messages : "",
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

    $(document).on("change", ".inputFile__js", function () {
        let filename = String($(".inputFile__js").val());
        if (filename == "" || filename == null) {
            $(".custom-file-label").text("Choose Image");
        } else {
            $(".custom-file-label").text(filename.split("\\")[2]);
        }
    });
});
