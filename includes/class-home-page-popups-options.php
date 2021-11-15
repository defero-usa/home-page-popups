<?php
class Home_Page_Popups_Options {

    function page_poptups_settings() {  
        add_settings_section(  
            'my_settings_section', // Section ID 
            'Home Page Popups', // Section Title
            [$this, 'my_section_options_callback'], // Callback
            'general' // What Page?  This makes the section show up on the General Settings Page
        );

        add_settings_field( // Option 1
            'updater_key', // Option ID
            'Updater Key', // Label
            [$this, 'updater_key_field'], // !important - This is where the args go!
            'general', // Page it will be displayed (General Settings)
            'my_settings_section', // Name of our section
            array( // The $args
                'updater_key' // Should match Option ID
            )  
        ); 
        register_setting('general','updater_key', 'esc_attr');
    }

    function my_section_options_callback() { // Section Callback
        echo '<p>Only edit the following information if you know what you are doing.</p>';  
    }

    function updater_key_field($args) {  // Textbox Callback
        $option = get_option($args[0]);
        echo '<input type="password" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" placeholder="****" />';
    }
}