<?php
class Home_Page_Popups_Options {

    function page_popups_settings() {  
        add_settings_section(  
            'my_settings_section', // Section ID 
            'Home Page Popups', // Section Title
            [$this, 'my_section_options_callback'], // Callback
            'general' // What Page?  This makes the section show up on the General Settings Page
        );

        // add_settings_field( // Option 1
        //     'updater_key', // Option ID
        //     'Updater Key', // Label
        //     [$this, 'updater_key_field'], // !important - This is where the args go!
        //     'general', // Page it will be displayed (General Settings)
        //     'my_settings_section', // Name of our section
        //     array( // The $args
        //         'updater_key' // Should match Option ID
        //     )  
        // ); 

        add_settings_field( // Option 1
            'hpp_bootstrap_version', // Option ID
            'Bootstrap Version', // Label
            [$this, 'bootstrap_version_field'], // !important - This is where the args go!
            'general', // Page it will be displayed (General Settings)
            'my_settings_section', // Name of our section
            array( // The $args
                'hpp_bootstrap_version' // Should match Option ID
            )  
        ); 
        // register_setting('general','updater_key', 'esc_attr');
        register_setting('general','hpp_bootstrap_version', 'esc_attr');
    }

    function my_section_options_callback() { // Section Callback
        echo '<p>Only edit the following information if you know what you are doing.</p>';  
    }

    function updater_key_field($args) {  // Textbox Callback
        $option = get_option($args[0]);
        echo '<input type="password" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" placeholder="****" />';
    }

    function bootstrap_version_field($args) {  // Textbox Callback
        $option = get_option($args[0]);
        echo '<select id="'. $args[0] .'" name="'. $args[0] .'">';
        echo '  <option value="bs4" ' . ($option === 'bs4'?'selected':'') .'>Bootstrap 4</option>';
        echo '  <option value="bs5" ' . ($option === 'bs5'?'selected':'') .'>Bootstrap 5</option>';
        echo '</select>';
    }
}