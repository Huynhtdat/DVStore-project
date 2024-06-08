$(document).ready(function(){
    $('[data-mask]').inputmask();

    $.ajaxSetup({
        headers: {
            token: "24d5b95c-7cde-11ed-be76-3233f989b8f3"
        },
    });

    $(document).on('change', '#city', function(){
        $('#district').html("");
        $('#ward').html("");
        //get list province
        getProvind();
    });

    $(document).on('change', '#district', function(){
        $('#ward').html("");
        // get list ward
        getWard();
    });
    //check click btn submit
    $(document).on('submit', '#form__js', function(){
        //display loading
        $('#loading__js').css('display', 'flex');
    });
});
