$(function () {

    /*
     * jQuery MASK
     */
    $(".mask-money").mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});
    $(".mask-date").mask('00/00/0000', {reverse: true});
    $(".mask-month").mask('00/0000', {reverse: true});
    $(".mask-doc").mask('000.000.000-00', {reverse: true});
    $(".mask-card").mask('0000  0000  0000  0000', {reverse: true});
    $(".mask-ip").mask('0000  0000  0000  0000', {reverse: true});
    /*
     * IMAGE RENDER
     */
    $("[data-image]").change(function (e) {
        var changed = $(this);
        var file = this;

        if (file.files && file.files[0]) {
            var render = new FileReader();

            render.onload = function (e) {
                $(changed.data("image")).fadeTo(100, 0.1, function () {
                    $(this).css("background-image", "url('" + e.target.result + "')")
                        .fadeTo(100, 1);
                });
            };
            render.readAsDataURL(file.files[0]);
        }
    });

    $(".menu_mobile").click(function () {

        if ($(".main_menu_aside").css("margin-left") === '-250px') {
            $(".main_menu_aside").animate({
                "margin-left": "0"
            }, 300);
        } else {
            $(".main_menu_aside").animate({
                "margin-left": "-250px"
            }, 300);
        }

    });

    $('.main_menu_item_one li').on('click', function () {

        var item = $(this);
        if (item.has('active_menu')) {

            $('.main_menu_item_one li').removeClass('active_menu');

            $(this).addClass('active_menu');
        }
    });

});