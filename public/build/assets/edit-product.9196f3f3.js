$("#summernote").summernote();

$(document).ready(function () {
    const fileInput = document.getElementById("file-input");
    const imgPreview = document.getElementById("img-preview");

    fileInput.addEventListener("change", event => {
        if (event.target.files.length) {
            const imageUrl = URL.createObjectURL(event.target.files[0]);
            imgPreview.src = imageUrl;
            console.log(imageUrl);
        } else {
            const imageUrl = "";
            imgPreview.src = imageUrl;
        }
    });

    loadCategories();

    $(document).on("change", "#parent_id", function () {
        loadCategories();
    });
});

function loadCategories() {
    let defaultValue = $("#category_id").attr("value");
    $("#category_id").html("");
    let parentId = $("#parent_id").val();
    let route = $("#category_id").attr("route");

    $.ajax({
        type: "GET",
        url: route + "?parent_id=" + parentId
    }).done(response => {
        let options = "";
        response.forEach(category => {
            options += `<option value="${category.id}" ${defaultValue == category.id ? 'selected' : ''}>${category.name}</option>`;
        });
        $("#category_id").html(options);
    });
}
