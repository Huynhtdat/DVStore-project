import { S as Swal } from "./sweetalert2.all.015ec384.js";
import "./_commonjsHelpers.4e997714.js";

$(document).ready(function () {
    const toast = initToast();
    fireToast(toast);
});

function initToast() {
    return Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    });
}

function fireToast(toast) {
    var type, message;
    let typeAttr = $("#toast__js").attr("type");
    let messageAttr = $("#toast__js").attr("message");

    if (typeAttr != null) {
        type = typeAttr;
    } else {
        type = "";
    }

    if (messageAttr != null) {
        message = messageAttr;
    } else {
        message = "";
    }

    if (message !== "") {
        showToast(toast, type, message);
    }
}

function showToast(toast, type, message) {
    let background, icon;

    if (type === "success") {
        background = "rgba(40,167,69,.85)";
        icon = "success";
    } else if (type === "error") {
        background = "rgba(220,53,69,.85)";
        icon = "error";
    }

    toast.fire({
        icon: icon,
        title: message,
        background: background,
        color: "#fff"
    });
}
