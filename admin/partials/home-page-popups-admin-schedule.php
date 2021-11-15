<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://deferousa.com
 * @since      1.0.0
 *
 * @package    Email_Susbcribe
 * @subpackage Email_Susbcribe/admin/partials
 */

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : '';
?>

<div class="hpp-wrap">
    <div class="hpp-header wp-smush-page-header">
        <h1 class="hpp-header-title">Schedules Popups</h1>
        <div class="hpp-actions-right">
            <button id="btn-update" class="hpp-button hpp-button-primary" >Sync</button>
        </div>
    </div>

    <div class="hpp-box hpp-summary hpp-summary-smush">
        <div class="hpp-box-title padding-10">
            Search Popup
            <div class="hpp-row">
                <div class="hpp-col">
                    <input
                        aria-required="true"
                        type="text"
                        id="search-name"
                        class="hpp-form-control wp-smush-resize-input"
                        value="<?php echo $id; ?>"
                    />
                </div>
                <div class="hpp-col">
                    <button type="button" id="btn-search" class="hpp-button">Search</button>
                </div>
            </div>
        </div>
        <div class="hpp-box-settings-row padding-10" id="ul-search-results"></div>
    </div>


    <div class="hpp-header wp-smush-page-header">

        <table class="wp-list-table widefat fixed striped posts  padding-10">
            <thead>
                <tr>
                    <th scope="col" id="popupName" class="manage-column column-popupName column-primary">
                        <span>Name</span>
                    </th>
                    <th scope="col" id="popupCookieName" class="manage-column column-popupCookieName">
                        <span>Category</span>
                    </th>
                    <th scope="col" id="popupCookieName" class="manage-column column-popupCookieName">
                        <span>Cookie Name</span>
                    </th>
                    <th scope="col" id="popupExpiration" class="manage-column column-popupExpiration">
                        <span>Cookie Expiration</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-active ">
                        <span>Schedule</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-active">
                        <span>Redirect Url</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody id="the-list"></tbody>
            <tfoot>
                <tr>
                    <th scope="col" id="popupName" class="manage-column column-popupName column-primary">
                        <span>Name</span>
                    </th>
                    <th scope="col" id="popupName" class="manage-column column-popupName column-primary">
                        <span>Category</span>
                    </th>
                    <th scope="col" id="popupCookieName" class="manage-column column-popupCookieName">
                        <span>Cookie Name</span>
                    </th>
                    <th scope="col" id="popupExpiration" class="manage-column column-popupExpiration">
                        <span>Cookie Expiration</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-active">
                        <span>Schedule</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-active">
                        <span>Redirect Url</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-action">
                        <span>Action</span>
                    </th>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
<div id="onLoad"></div>