import { S as a } from "./sweetalert2.all.015ec384.js";
import "./_commonjsHelpers.4e997714.js";

$(document).ready(function () {
    var t, e = [];
    Array.from($("#table-crud tr th")).forEach((n, r) => {
        e.push(r);
    });
    e.pop();
    s = s();
    t = $("#table-crud").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
        buttons: [
            {
                extend: "excelHtml5",
                exportOptions: { columns: e }
            },
            {
                extend: "pdfHtml5",
                exportOptions: { columns: e }
            }
        ],
        language: {
            search: "Search",
            emptyTable: "No data available",
            paginate: {
                first: "First page",
                previous: "Previous page",
                next: "Next page",
                last: "Last page"
            },
            info: "Showing records from _START_ to _END_ out of _TOTAL_ records",
            infoFiltered: ""
        }
    });
    t.buttons().container().appendTo("#table-crud_wrapper .col-md-6:eq(0)");
    $(".buttons-print").html('<i class="fas fa-print"></i>');
    $(".buttons-pdf").html('<i class="fas fa-file-pdf"></i>');
    $(".buttons-excel").html('<i class="fas fa-file-excel"></i>');
    $(".dt-buttons button").css("background-color", "#28a745");
    $("#table-crud_filter input").css("width", "250px");
    $(document).on("click", "#delete__js", function () {
        let n = $(this).closest("tr").attr("id"),
            r = $(this).attr("url");
        a.fire({
            title: "Are you sure you want to delete?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "YES",
            cancelButtonText: "NO"
        }).then(i => {
            if (i.isConfirmed) {
                $("#loading__js").css("display", "flex");
                $.ajax({
                    url: r,
                    type: "POST",
                    data: { id: n }
                }).done(o => {
                    $("#loading__js").css("display", "none");
                    if (o.status == "success") {
                        l(s, "success", o.message);
                        t.rows(`#${n}`).remove().draw();
                    } else if (o.status == "failed") {
                        l(s, "error", o.message);
                    } else {
                        l(s, "error", o.message);
                        setTimeout(() => { location.reload() }, 2000);
                    }
                });
            }
        });
    });
});

function s() {
    return a.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: t => {
            t.addEventListener("mouseenter", a.stopTimer);
            t.addEventListener("mouseleave", a.resumeTimer);
        }
    });
}

function l(t, e, n) {
    let r, i;
    if (e == "success") {
        r = "rgba(40,167,69,.85)";
        i = "success";
    } else if (e == "error") {
        r = "rgba(220,53,69,.85)";
        i = "error";
    }
    t.fire({
        icon: i,
        title: n,
        background: r,
        color: "#fff"
    });
}
