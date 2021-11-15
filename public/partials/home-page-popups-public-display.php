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
?>

<?php foreach ( $popups as $popup ): ?>
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
<?php endforeach; ?>
<script>
    jQuery(document).ready(function(){
        let arr = <?php echo json_encode($popups); ?>;
            let i = 0,
                bypass = true,
                length = <?php echo count($popups); ?>;
            while ( bypass && i < length ) {
                if ( Cookies.get( arr[i].popupCookieName ) == null ) {
                    bypass = false;
                    if( window.location.pathname !== '/locations/phoenix-az/menus/menu-menu/' ) {
                        let data = arr[i];
                        setTimeout(
                            function( data ) {
                                $( `#hpp-modal-${data.id}` ).modal('show');
                                Cookies.set( data.popupCookieName, 'yes', {expires: parseFloat( data.popupExpiration)});
                            },
                            2000,
                            data
                        );
                    }
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
        $(window).on(jQuery.modal.OPEN, function(e, modal) {
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
