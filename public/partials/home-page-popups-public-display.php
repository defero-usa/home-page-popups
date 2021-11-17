<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.deferousa.com/
 * @since      1.0.0
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/public/partials
 */

 $bootstrapVersion = get_option('hpp_bootstrap_version');
?>

<?php foreach ( $popups as $popup ): ?>
    <?php if($bootstrapVersion === 'bs5') :?>
    <div class="modal fade" id="hpp-modal-<?php echo $popup['id']; ?>" tabindex="-1" aria-labelledby="hpp-modal-<?php echo $popup['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <a  title="<?php echo $popup['name']; ?>" class="hide-on-mobile hpp-img" href="<?php echo $popup['popupRedirectTo']; ?>">
                        <img class="hide-on-mobile" alt="<?php echo $popup['name']; ?>" src="<?php echo $popup['desk_popup_img']; ?>" style="width:100%">
                    </a>
                    <a  title="<?php echo $popup['name']; ?>" class="hide-on-desk hpp-img" href="<?php echo $popup['popupRedirectTo']; ?>">
                        <img class="hide-on-desk full-screen" alt="<?php echo $popup['name']; ?>" src="<?php echo $popup['mobile_popup_img']; ?>" style="width:100%;">
                    </a>
                    <button type="button" class="btn-close position-absolute top-0 end-0 text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>

    <div id="hpp-modal-<?php echo $popup['id']; ?>" style="width: 100%;" class="hpp-modal">
        <div class="modal-wrapper" style="text-align:center;">
            <a  title="<?php echo $popup['name']; ?>" class="hide-on-mobile hpp-img" href="<?php echo $popup['popupRedirectTo']; ?>">
                <img class="hide-on-mobile" alt="<?php echo $popup['name']; ?>" src="<?php echo $popup['desk_popup_img']; ?>" style="width:100%">
            </a>
            <a  title="<?php echo $popup['name']; ?>" class="hide-on-desk hpp-img" href="<?php echo $popup['popupRedirectTo']; ?>">
                <img class="hide-on-desk full-screen" alt="<?php echo $popup['name']; ?>" src="<?php echo $popup['mobile_popup_img']; ?>" style="width:100%;">
            </a>
        </div>
        <a href="#close-modal" rel="modal:close" class="close-modal ">Close</a>
    </div>
    <?php endif; ?>
<?php endforeach; ?>
<script>
    /*! js-cookie v3.0.1 | MIT */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self,function(){var n=e.Cookies,o=e.Cookies=t();o.noConflict=function(){return e.Cookies=n,o}}())}(this,(function(){"use strict";function e(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)e[o]=n[o]}return e}return function t(n,o){function r(t,r,i){if("undefined"!=typeof document){"number"==typeof(i=e({},o,i)).expires&&(i.expires=new Date(Date.now()+864e5*i.expires)),i.expires&&(i.expires=i.expires.toUTCString()),t=encodeURIComponent(t).replace(/%(2[346B]|5E|60|7C)/g,decodeURIComponent).replace(/[()]/g,escape);var c="";for(var u in i)i[u]&&(c+="; "+u,!0!==i[u]&&(c+="="+i[u].split(";")[0]));return document.cookie=t+"="+n.write(r,t)+c}}return Object.create({set:r,get:function(e){if("undefined"!=typeof document&&(!arguments.length||e)){for(var t=document.cookie?document.cookie.split("; "):[],o={},r=0;r<t.length;r++){var i=t[r].split("="),c=i.slice(1).join("=");try{var u=decodeURIComponent(i[0]);if(o[u]=n.read(c,u),e===u)break}catch(e){}}return e?o[e]:o}},remove:function(t,n){r(t,"",e({},n,{expires:-1}))},withAttributes:function(n){return t(this.converter,e({},this.attributes,n))},withConverter:function(n){return t(e({},this.converter,n),this.attributes)}},{attributes:{value:Object.freeze(o)},converter:{value:Object.freeze(n)}})}({read:function(e){return'"'===e[0]&&(e=e.slice(1,-1)),e.replace(/(%[\dA-F]{2})+/gi,decodeURIComponent)},write:function(e){return encodeURIComponent(e).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g,decodeURIComponent)}},{path:"/"})}));

    jQuery(document).ready(function(){
        let arr = <?php echo json_encode($popups); ?>;
            let i = 0,
                bypass = true,
                length = <?php echo count($popups); ?>;
            while ( bypass && i < length ) {
                if ( Cookies.get( arr[i].popupCookieName ) == null ) {
                    bypass = false;
                    let data = arr[i];
                    setTimeout(
                        function( data ) {
                            $( '#hpp-modal-' + data.id).modal('show');
                            Cookies.set( data.popupCookieName, 'yes', {expires: parseFloat( data.popupExpiration)});
                        },
                        2000,
                        data
                    );
                }
                i++;
            }


        $(".hpp-modal")
            .on("modal:open", function() {
                $(".jquery-modal.blocker").addClass("open");
            })
            .on("modal:before-close", function() {
                $(".jquery-modal.blocker").removeClass("open");
            });
        <?php if($bootstrapVersion === 'bs5') : ?>
        $(window).on('shown.bs.modal', function(e, modal) {
        <?php else : ?>
        $(window).on(jQuery.modal.OPEN, function(e, modal) {
        <?php endif; ?>
            var modalRatio = modal.$elm.outerHeight() / modal.$elm.outerWidth(),
                modalMaxHeight = ($(window).innerHeight() - 64) / modalRatio;

            if (modal.$elm.outerHeight() > modalMaxHeight) {
                modal.$elm.css('width', Math.floor(modalMaxHeight / 16) +'rem');
            }
        });
    });
</script>

<style>

    .jquery-modal .modal .close-modal {
        background-image: url(/wp-content/plugins/home-page-popups/public/images/icons/close-filter-wht.svg);
        -moz-transition: background-color .25s ease;
        -o-transition: background-color .25s ease;
        -webkit-transition: background-color .25s ease;
        transition: background-color .25s ease;
        padding: 0;
        background-color: transparent;
        border: 0;
        -webkit-appearance: none;
    }
    .hpp-modal{
        display: none;
    }
    @media (orientation: landscape) { .full-screen { height:100%; width: auto !important; } }
    @media (orientation: portrait) { .full-screen { width:100%; } }
    @media (min-width:768px) {
        .hide-on-desk {
            display:none!important;
        }
    }
    @media (max-width:767px) {
        .hide-on-mobile {
            display:none!important;
        }
    }

    @media (min-width:768px) {
        .jquery-modal.blocker {
            background-color: rgba(0, 0, 0, .75);
            height: 100vh;
            left: 0;
            position: fixed;
            top: 0;
            width: 100vw;
            z-index: 5;
            opacity: 0;
            transition: opacity .5s cubic-bezier(.645, .045, .355, 1)
        }
        .jquery-modal .modal {
            left: 50%;
            position: absolute;
            background: none;
            padding: 0;
            top: 50%;
            opacity: 0;
            -webkit-transform: translate(-50%, 0);
            transform: translate(-50%, 0);
            transition: opacity .5s cubic-bezier(.645, .045, .355, 1), transform .5s cubic-bezier(.645, .045, .355, 1)
        }
        .jquery-modal .modal .close-modal {
            background-position: center;
            background-repeat: no-repeat;
            height: 2.5rem;
            overflow: hidden;
            position: absolute;
            right: 0;
            text-indent: -99rem;
            top: 0;
            width: 2.5rem
        }
        .jquery-modal.open,
        .locations main section.find-location.block-list .listing-block article.listing.in-view,
        .news main section.news .wrapper article.in-view {
            opacity: 1
        }
        .jquery-modal.open .modal {
            opacity: 1;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%)
        }
        .jquery-modal .hpp-modal .close-modal {
            color: #fff!important;
            background-color: #fff;
            transition: background-color .25s ease;
            background-image: url(/wp-content/plugins/home-page-popups/public/images/icons/modal-close.svg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            height: 1.25rem;
            right: .5rem;
            top: .5rem;
            width: 1.25rem
        }
    <?php foreach ( $popups as $popup ): ?>
        .jquery-modal #hpp-modal-<?php echo $popup['id']; ?> .img-mobile {
            display: none;
        }
    <?php endforeach; ?>
    }
    @media (max-width:767px) {
        .hpp-modal{
            width: 100% !important;
        }
        .jquery-modal.blocker {
            height: 100%;
        }
        .jquery-modal.open .modal {
            -ms-transform:translate(-51%, -50%);
            height:100%;
        }
        .jquery-modal.open .modal .modal-wrapper {
            height:100%;
        }
        .jquery-modal.open .modal .modal-wrapper a {
            height:100%;
        }
        .jquery-modal.open .modal .modal-wrapper .hpp-img img {
            height:100%;
        }
        .jquery-modal .modal .close-modal {
            background-position: center;
            background-repeat: no-repeat;
            height: 2.5rem;
            overflow: hidden;
            position: absolute;
            right: 0;
            text-indent: -99rem;
            top: 0;
            width: 2.5rem;
        }
        .jquery-modal .modal {
            padding: 0;
        }
        @media (min-width: 48rem)
            .jquery-modal .modal .close-modal {
                height: 3.5rem;
                width: 3.5rem;
            }
        }
</style>
