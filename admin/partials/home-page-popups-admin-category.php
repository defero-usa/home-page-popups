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
?>

<div class="hpp-wrap">
    <div class="hpp-header wp-smush-page-header">
        <h1 class="hpp-header-title">Categories</h1>
    </div>

    <div class="hpp-box hpp-summary hpp-summary-smush">
        <div class="hpp-box-title padding-10">
            Category
            <div class="hpp-row">
                <div class="hpp-col">
                    <input
                        aria-required="true"
                        type="text"
                        id="category"
                        class="hpp-form-control wp-smush-resize-input"
                    >
                </div>
                <div class="hpp-col">
                     <textarea
                             id="description"
                             class="hpp-form-control wp-smush-resize-input"
                     ></textarea>
                </div>
            </div>
        </div>
        <div class="hpp-box-title padding-10">
            <div class="hpp-row">
                <div class="hpp-col">
                </div>

                <div class="hpp-col text-right">

                    <button type="button" id="btn-add-category" class="hpp-button hpp-button-primary">Add</button>
                </div>
            </div>
        </div>
        <div class="hpp-box-settings-row padding-10" id="add-category-msg"></div>
    </div>


    <div class="hpp-header wp-smush-page-header">

        <table class="wp-list-table widefat fixed striped posts  padding-10">
            <thead>
                <tr>
                    <th scope="col" id="popupName" class="manage-column column-popupName column-primary">
                        <span>Name</span>
                    </th>
                    <th scope="col" id="description" class="manage-column column-description">
                        <span>Description</span>
                    </th>
                    <th scope="col" id="active" class="manage-column column-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody id="tb-categories"></tbody>
            <tfoot>
                <tr>
                    <th scope="col" id="popupName" class="manage-column column-popupName column-primary">
                        <span>Name</span>
                    </th>
                    <th scope="col" id="description" class="manage-column column-description">
                        <span>Description</span>
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