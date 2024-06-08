$(document).ready(function () {
    let sizes = JSON.parse(jQuery("#data-size").attr("data-sizes"));
    let initialColor = $("#data-color").val();
    updateSizeOptions(initialColor, sizes);

    $(document).on("change", "#data-color", function () {
        let selectedColor = $("#data-color").val();
        updateSizeOptions(selectedColor, sizes);
    });

    $(document).on("change", "#data-size", function () {
        let sizes = JSON.parse(jQuery("#data-size").attr("data-sizes"));
        let selectedSize = $("#data-size").val();
        let selectedColor = $("#data-color").val();

        sizes.forEach(item => {
            if (item.product_color_id == selectedColor && item.product_size_id == selectedSize) {
                $("#quantity_remain").text(item.quantity);
            }
        });
    });

    $(document).on("click", ".star", function () {
        $(".rating label .fa-star").css({ color: "#b1b1b1" });
        let rating = $(this).attr("id");
        for (let i = 1; i <= rating.split("star")[1]; i++) {
            $(`#icon-star${i} i`).css({ color: "#F5A623" });
        }
    });
});

function updateSizeOptions(color, sizes) {
    let sizeOptions = "";
    sizes.forEach(item => {
        if (item.product_color_id == color) {
            sizeOptions += `
                <option value='${item.product_size_id}'>${item.size_name}</option>
            `;
        }
    });
    $("#data-size").html(sizeOptions);
    updateQuantity(sizes);
}

function updateQuantity(sizes) {
    let selectedSize = $("#data-size").val();
    sizes.forEach(item => {
        if (item.product_size_id == selectedSize) {
            $("#quantity_remain").text(item.quantity);
        }
    });
}
