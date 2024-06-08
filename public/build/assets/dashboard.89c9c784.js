$(document).ready(function () {
    var days = JSON.parse($("#data-statistics").attr("days"));
    var parameters = JSON.parse($("#data-statistics").attr("parameters"));

    $(function () {
        var data = {
            labels: days,
            datasets: [{
                label: "doanh thu",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: !1,
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: parameters
            }]
        };

        var originalData = $.extend(!0, {}, data);
        var ctx = $("#stackedBarChart").get(0).getContext("2d");
        var chartData = $.extend(!0, {}, originalData);

        var options = {
            responsive: !0,
            maintainAspectRatio: !1,
            scales: {
                xAxes: [{ stacked: !0 }],
                yAxes: [{ stacked: !0 }]
            }
        };

        new Chart(ctx, { type: "bar", data: chartData, options: options });
    });

    var pieLabels = JSON.parse($("#pieChart").attr("label"));
    var pieData = JSON.parse($("#pieChart").attr("data"));

    var pieChartData = {
        labels: pieLabels,
        datasets: [{
            data: pieData,
            backgroundColor: ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de", "#CC6699", "#00DD00", "#001100", "#FFFF33"]
        }]
    };

    var pieCtx = $("#pieChart").get(0).getContext("2d");
    var pieOptions = { maintainAspectRatio: !1, responsive: !0 };

    new Chart(pieCtx, { type: "pie", data: pieChartData, options: pieOptions });

    var reviewLabels = JSON.parse($("#bestReview").attr("label"));
    var reviewData = JSON.parse($("#bestReview").attr("data"));

    var reviewChartData = {
        labels: reviewLabels,
        datasets: [{
            data: reviewData,
            backgroundColor: ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de", "#CC6699", "#00DD00", "#001100", "#FFFF33"]
        }]
    };

    var reviewCtx = $("#bestReview").get(0).getContext("2d");
    var reviewOptions = { maintainAspectRatio: !1, responsive: !0 };

    new Chart(reviewCtx, { type: "pie", data: reviewChartData, options: reviewOptions });
});
