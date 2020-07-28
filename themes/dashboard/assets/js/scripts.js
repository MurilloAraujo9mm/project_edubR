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

    // /*
    //  * AJAX FORM
    //  */
    // $("form:not('.ajax_off')").submit(function (e) {
    //     e.preventDefault();
    //     var form = $(this);
    //     var load = $(".ajax_load");
    //     var flashClass = "ajax_response";
    //     var flash = $("." + flashClass);
    //
    //     form.ajaxSubmit({
    //         url: form.attr("action"),
    //         type: "POST",
    //         dataType: "json",
    //         beforeSend: function () {
    //             load.fadeIn(200).css("display", "flex");
    //         },
    //         uploadProgress: function (event, position, total, completed) {
    //             var loaded = completed;
    //             var load_title = $(".ajax_load_box_title");
    //             load_title.text("Enviando (" + loaded + "%)");
    //
    //             form.find("input[type='file']").val(null);
    //             if (completed >= 100) {
    //                 load_title.text("Aguarde, carregando...");
    //             }
    //         },
    //         success: function (response) {
    //             //redirect
    //             if (response.redirect) {
    //                 window.location.href = response.redirect;
    //             } else {
    //                 load.fadeOut(200);
    //             }
    //
    //             //reload
    //             if (response.reload) {
    //                 window.location.reload();
    //             } else {
    //                 load.fadeOut(200);
    //             }
    //
    //             //message
    //             if (response.message) {
    //                 if (flash.length) {
    //                     flash.html(response.message).fadeIn(100).effect("bounce", 300);
    //                 } else {
    //                     form.prepend("<div class='" + flashClass + "'>" + response.message + "</div>")
    //                         .find("." + flashClass).effect("bounce", 300);
    //                 }
    //             } else {
    //                 flash.fadeOut(100);
    //             }
    //         },
    //         complete: function () {
    //             if (form.data("reset") === true) {
    //                 form.trigger("reset");
    //             }
    //         },
    //         error: function () {
    //             var message = "<div class='message error icon-warning'>Desculpe mas não foi possível processar a requisição. Favor tente novamente!</div>";
    //
    //             if (flash.length) {
    //                 flash.html(message).fadeIn(100).effect("bounce", 300);
    //             } else {
    //                 form.prepend("<div class='" + flashClass + "'>" + message + "</div>")
    //                     .find("." + flashClass).effect("bounce", 300);
    //             }
    //
    //             load.fadeOut();
    //         }
    //     });
    // });

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

    $('.main_menu_item_one li').on('click', function (){

        var item = $(this);
        if (item.has('active_menu')) {

            $('.main_menu_item_one li').removeClass('active_menu');

            $(this).addClass('active_menu');
        }
    });

});