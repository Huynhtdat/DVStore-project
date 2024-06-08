import { S as a } from "./sweetalert2.all.015ec384.js";
import "./_commonjsHelpers.4e997714.js";

$(document).ready(function() {
    n = n();

    $(document).on("change", ".img-product", function() {
        this.files[0] && $(this).closest(".preview").find("img").attr("src", URL.createObjectURL(this.files[0]))
    });

    u("submit", ".form-submit");

    $(document).on("click", ".edit", function() {
        let e = $(this).attr("url-update"),
            s = $(this).attr("url-img");
        $.ajax({
            type: "GET",
            url: e
        }).done(o => {
            let i = "";
            let t = `
            <form method="post"
              class="form-submit"
              enctype="multipart/form-data"
              url-store="${e}"
              >
                <div class="modal-body">
                    <div class="form-group">
                    <div class="preview">
                        <img id="img-preview" style="width: 60px" src="${s+"/"+o.productImage.img}" />
                        <label for="file-input-edit" id="lable-img">Imgae Product</label>
                        <input class="img-product" hidden accept="image/*" type="file" id="file-input-edit" name="img"/>
                    </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
          </form>
          `;
            $("#body-modal-edit").html(t), $("#modal-edit").modal("show")
        })
    });

    $(document).on("click", ".delete", function() {
        let e = $(this).attr("url-delete");
        a.fire({
            title: "Are you sure you want to delete?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "YES",
            cancelButtonText: "NO"
        }).then(s => {
            s.isConfirmed && ($("#loading__js").css("display", "flex"), $.ajax({
                type: "POST",
                url: e
            }).done(o => {
                $("#loading__js").css("display", "none"), o.status == !0 ? (console.log("true"), $(this).closest("tr").remove(), r(n, "success", o.message)) : (console.log("false"), r(n, "error", o.message))
            }).fail(() => {
                $("#loading__js").css("display", "none"), r(n, "error", "An error occurred, please try again"), setTimeout(() => {
                    location.reload()
                }, 2e3)
            }))
        })
    })
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
            contentType: !1,
            cache: !1,
            processData: !1,
            async: !0
        }).done(t => {
            t.status == !1 ? r(n, "error", t.message) : t.status == !0 && (window.location.href = t.route)
        }).fail(function(t) {
            t.status == 422 && r(n, "error", t.responseJSON.message)
        })
    })
}

function n() {
    return a.mixin({
        toast: !0,
        position: "top-end",
        showConfirmButton: !1,
        timer: 3e3,
        timerProgressBar: !0,
        didOpen: e => {
            e.addEventListener("mouseenter", a.stopTimer), e.addEventListener("mouseleave", a.resumeTimer)
        }
    })
}

function r(e, s, o) {
    let i, t;
    s == "success" ? (i = "rgba(40,167,69,.85)", t = "success") : s == "error" && (i = "rgba(220,53,69,.85)", t = "error"), e.fire({
        icon: t,
        title: o,
        background: i,
        color: "#fff"
    })
}
