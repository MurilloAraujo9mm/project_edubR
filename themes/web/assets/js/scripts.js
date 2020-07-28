$(function () {

    //ajax form
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var load = $(".ajax_load");
        var flashClass = "ajax_response";
        var flash = $("." + flashClass);

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    load.fadeOut(200);
                }

                //message
                if (response.message) {
                    if (flash.length) {
                        flash.html(response.message).fadeIn(100).effect("bounce", 300);
                    } else {
                        form.prepend("<div class='" + flashClass + "'>" + response.message + "</div>").find("." + flashClass).effect("bounce", 300);
                    }
                } else {
                    flash.fadeOut(100);
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            }
        });
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