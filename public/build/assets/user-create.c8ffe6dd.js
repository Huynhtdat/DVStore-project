$(document).ready(function () {
    $("[data-mask]").inputmask();

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
});
