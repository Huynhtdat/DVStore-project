$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            token: "24d5b95c-7cde-11ed-be76-3233f989b8f3"
        }
    });
    $(document).on("change", "#city", function () {
        $("#district").html("");
        $("#ward").html("");
        o();
    });
    $(document).on("change", "#district", function () {
        $("#ward").html("");
        d();
    });
});

function o() {
    let a = $("#city").val();
    $.ajax({
        type: "GET",
        url: "https://online-gateway.ghn.vn/shiip/public-api/master-data/district",
        data: { province_id: a }
    }).done(n => {
        let t = "";
        n.data.forEach(i => {
            t = `<option value="${i.DistrictID}">${i.DistrictName}</option>`;
            $("#district").append(t);
        });
        d();
    });
}

function d() {
    let a = $("#district").val();
    $.ajax({
        type: "GET",
        url: "https://online-gateway.ghn.vn/shiip/public-api/master-data/ward",
        data: { district_id: a }
    }).done(n => {
        let t = "";
        n.data.forEach(i => {
            t = `<option value="${i.WardCode}">${i.NameExtension[0]}</option>`;
            $("#ward").append(t);
        });
    });
}
