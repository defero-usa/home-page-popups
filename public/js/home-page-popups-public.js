jQuery(function($){
    alert('222');
    var res_cookie = 'seenst14';
    var shown = Cookies.get(res_cookie);
    if (shown == null) {
        var delay = parseInt(2 * 1000);
        console.log(delay);
        if(window.location.pathname !== '/locations/phoenix-az/menus/menu-menu/') {
            setTimeout(function() {
                jQuery('#giftcard-modal').modal('show');
                Cookies.set(res_cookie, 'yes');
            }, delay);
        }

    }

    $("#giftcard-modal")
    .on("modal:open", function() {
        $(".jquery-modal.blocker").addClass("open");
    })
    .on("modal:before-close", function() {
        $(".jquery-modal.blocker").removeClass("open");
    });

    jQuery(window).on(jQuery.modal.OPEN, function(e, modal) {
        console.log(modal.$elm.outerHeight());
        var modalRatio = modal.$elm.outerHeight() / modal.$elm.outerWidth(),
            modalMaxHeight = ($(window).innerHeight() - 64) / modalRatio;

        if (modal.$elm.outerHeight() > modalMaxHeight) {
            modal.$elm.css('width', Math.floor(modalMaxHeight / 16) +'rem');
            console.log('setting');
        }
    });
});
