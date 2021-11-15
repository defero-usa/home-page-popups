<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://deferousa.com
 * @since      1.0.0
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/admin/partials
 */

global $post;
$custom = get_post_custom($post->ID);

$front_event = $custom['active'][0];
$checked = ( $front_event ) ? 'checked="checked"' : '';
$desktopFullscreen = ( $custom['desktopFullscreen'][0] ) ? 'checked="checked"' : '';

$desk_image = ' button">Upload image';
$desk_display = 'none'; // display state ot the "Remove image" button
$desk_popup_img= esc_attr( $custom['desk_popup_img'][0] );
//var_dump($custom['desk_popup_img'][0] , $custom['mobile_popup_img'][0] );die;
if( $image_attributes = wp_get_attachment_image_src( $desk_popup_img, 'full' ) ) {
    $desk_image = '"><img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
    $desk_display = 'inline-block';
}

$mobile_image = ' button">Upload image';
$mobile_display = 'none'; // display state ot the "Remove image" button
$mobile_popup_img= esc_attr( $custom['mobile_popup_img'][0] );
if( $image_attributes = wp_get_attachment_image_src( $mobile_popup_img, 'full' ) ) {
    $mobile_image = '"><img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
    $mobile_display = 'inline-block';
}

wp_nonce_field( 'popupName' ,  'popupName_nonce' ); ?>

<div id="home-page-popups">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control required" id="popupName" name="popupName" placeholder="Popup name"
               value="<?php echo esc_attr( $custom['popupName'][0] ); ?>"
        >
    </div>

    <div class="form-group">
        <label for="name">Redirect to</label>
        <input type="text" class="form-control required" id="popupRedirectTo" name="popupRedirectTo" placeholder="Redirect Url"
               value="<?php echo esc_attr( $custom['popupRedirectTo'][0] ); ?>"
        >
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cookieName">Category</label>
            <select class="form-control required" name="category" id="category">
                <option value="0">--Select Category--</option>
                <?php foreach ( get_option('hpp_option', []) as $option ) :?>
                    <option <?php echo ( $option['category'] == esc_attr( $custom['category'][0] ) ) ? 'selected' : ''?> value="<?php echo $option['category']; ?>"><?php echo $option['category']; ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="image">Image on Desktop</label>
            <div class="img-notice">
                Best dimension: 1280 x 1520
            </div>
            <div>
                <a href="#" class="hpp_desk_upload_image_button <?php echo $desk_image; ?></a>
                <input type="hidden" name="desk_popup_img" id="desk_popup_img" value="<?php echo esc_attr( $desk_popup_img ); ?>" />
                <a href="#" class="hpp_desk_remove_image_button" style="display:inline-block;display:<?php echo $desk_display; ?>">Remove image</a>
            </div>
        </div>
    </div> 
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="image">Image on Mobile (Optional)</label>
            <div class="img-notice">
                Best dimension: 1280 x 1520
            </div>
            <div>
                <a href="#" class="hpp_mobile_upload_image_button <?php echo $mobile_image; ?></a>
                <input type="hidden" name="mobile_popup_img" id="mobile_popup_img" value="<?php echo esc_attr( $mobile_popup_img ); ?>" />
                <a href="#" class="hpp_mobile_remove_image_button" style="display:inline-block;display:<?php echo $mobile_display; ?>">Remove image</a>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cookieName">Cookie Name</label>
            <input type="text" class="form-control required" name="popupCookieName" id="popupCookieName"
                   value="<?php echo esc_attr( $custom['popupCookieName'][0] ); ?>"
            >
        </div>
        <div class="form-group col-md-2">
            <label for="expiration">Cookie expiration (in days)</label>
            <input type="number" class="form-control required" name="popupExpiration" id="popupExpiration" value="<?php echo esc_attr( $custom['popupExpiration'][0] ); ?>"
            >
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="active" id="active" <?php echo $checked; ?>>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>
    </div>
    <div class="form-row"><div class="msg text-danger mt-3"></div></div>
</div>