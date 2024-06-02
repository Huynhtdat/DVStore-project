import { S as a } from "./sweetalert2.all.015ec384.js";
import "./_commonjsHelpers.4e997714.js";

$(document).ready(function() {
    n = n();

    // Đăng ký sự kiện submit cho form có class .form-submit
    u("submit", ".form-submit");

    // Đăng ký sự kiện click cho phần tử có class .edit
    $(document).on("click", ".edit", function() {
        let e = $(this).attr("url-update");

        $.ajax({
            type: "GET",
            url: e
        }).done(o => {
            let i = "";
            o.colors.forEach(l => {
                if (l.id == o.productColor.color_id) {
                    i += `<option value="${l.id}" selected>${l.name}</option>`;
                } else {
                    i += `<option value="${l.id}">${l.name}</option>`;
                }
            });

            let t = `
                <form method="post"
                  class="form-submit"
                  enctype="multipart/form-data"
                  url-store="${e}"
                >
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width:auto;">
                                        <span class="input-group-text" style="width:100%;">Màu</span>
                                    </div>
                                    <select class="form-control" name="color_id" id="color_id_edit">
                                        ${i}
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            `;

            $("#body-modal-edit").html(t);
            $("#modal-edit").modal("show");
        });
    });

    // Đăng ký sự kiện click cho phần tử có class .delete
    $(document).on("click", ".delete", function() {
        let e = $(this).attr("url-delete");
        a.fire({
            title: "Bạn có chắc muốn xóa?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có",
            cancelButtonText: "Không"
        }).then(s => {
            if (s.isConfirmed) {
                $("#loading__js").css("display", "flex");
                $.ajax({
                    type: "POST",
                    url: e
                }).done(o => {
                    $("#loading__js").css("display", "none");
                    if (o.status == true) {
                        console.log("true");
                        $(this).closest("tr").remove();
                        r(n, "success", o.message);
                    } else {
                        console.log("false");
                        r(n, "error", o.message);
                    }
                }).fail(() => {
                    $("#loading__js").css("display", "none");
                    r(n, "error", "Có lỗi xảy ra, vui lòng thử lại");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                });
            }
        });
    });
});

function u(e, s) {
    $(document).on(e, s, function(o) {
        o.preventDefault();
        let i = $(this).attr("url-store");
        $.ajax({
            url: i,
            method: "POST",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            async: true
        }).done(t => {
            if (t.status == false) {
                r(n, "error", t.message);
            } else if (t.status == true) {
                window.location.href = t.route;
            }
        }).fail(function(t) {
            if (t.status == 422) {
                r(n, "error", t.responseJSON.message);
            }
        });
    });
}

function n() {
    return a.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: e => {
            e.addEventListener("mouseenter", a.stopTimer);
            e.addEventListener("mouseleave", a.resumeTimer);
        }
    });
}

function r(e, s, o) {
    let i, t;
    if (s == "success") {
        i = "rgba(40,167,69,.85)";
        t = "success";
    } else if (s == "error") {
        i = "rgba(220,53,69,.85)";
        t = "error";
    }
    e.fire({
        icon: t,
        title: o,
        background: i,
        color: "#fff"
    });
}
