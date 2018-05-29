<?php

/**
 * @package Accesspress Pro
 */
function eightphoto_widgets_show_widget_field($instance = '', $widget_field = '', $athm_field_value = '') {
    // Store Posts in array
    $eightphoto_postlist[0] = array(
        'value' => 0,
        'label' => '--choose--'
    );
    $arg = array('posts_per_page' => -1);
    $eightphoto_posts = get_posts($arg);
    foreach ($eightphoto_posts as $eightphoto_post) :
        $eightphoto_postlist[$eightphoto_post->ID] = array(
            'value' => $eightphoto_post->ID,
            'label' => $eightphoto_post->post_title
        );
    endforeach;

    extract($widget_field);

    switch ($eightphoto_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="text" value="<?php echo esc_attr($athm_field_value) ; ?>" />

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;
            
        //title    
        case 'title' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="text" value="<?php echo esc_attr($athm_field_value) ; ?>" />

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="text" value="<?php echo $athm_field_value; ?>" />

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label>
                <textarea class="widefat" rows="<?php echo $eightphoto_widgets_row; ?>" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>"><?php echo $athm_field_value; ?></textarea>
            </p>
            <?php
            break;       
      

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?></label>

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo $eightphoto_widgets_title;
                echo '<br />';
                foreach ($eightphoto_widgets_field_options as $athm_option_name => $athm_option_title) {
                    ?>
                    <input id="<?php echo $instance->get_field_id($athm_option_name); ?>" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="radio" value="<?php echo $athm_option_name; ?>" <?php checked($athm_option_name, $athm_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($athm_option_name); ?>"><?php echo $athm_option_title; ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" class="widefat">
                    <?php foreach ($eightphoto_widgets_field_options as $athm_option_name => $athm_option_title) { ?>
                        <option value="<?php echo $athm_option_name; ?>" id="<?php echo $instance->get_field_id($athm_option_name); ?>" <?php selected($athm_option_name, $athm_field_value); ?>><?php echo $athm_option_title; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label><br />
                <input name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" value="<?php echo $athm_field_value; ?>" class="small-text" />

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'selectpost' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" class="widefat">
                    <?php foreach ($eightphoto_postlist as $eightphoto_single_post) { ?>
                        <option value="<?php echo $eightphoto_single_post['value']; ?>" id="<?php echo $instance->get_field_id($eightphoto_single_post['label']); ?>" <?php selected($eightphoto_single_post['value'], $athm_field_value); ?>><?php echo $eightphoto_single_post['label']; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload' :

            $output = '';
                $id = $instance->get_field_id($eightphoto_widgets_name);
                $class = '';
                $int = '';
                $value = $athm_field_value;
                $name = $instance->get_field_name($eightphoto_widgets_name);


                if ($value) {
                    $class = ' has-file';
                }
                $output .= '<div class="sub-option section widget-upload">';
                $output .= '<label for="'.$instance->get_field_id($eightphoto_widgets_name).'">'.$eightphoto_widgets_title.'</label><br/>';
                $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . __('No file chosen', 'eightphoto') . '" />' . "\n";
                if (function_exists('wp_enqueue_media')) {
                    if (( $value == '')) {
                        $output .= '<input id="upload-' . $id . '" class="upload-button-wdgt button" type="button" value="' . __('Upload', 'eightphoto') . '" />' . "\n";
                    } else {
                        $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . __('Remove', 'eightphoto') . '" />' . "\n";
                    }
                } else {
                    $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'eightphoto') . '</i></p>';
                }

                $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";
                if ($value != '') {
                    $remove = '<a class="remove-image">Remove</a>';
                    $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                    if ($image) {
                        $output .= '<img src="' . $value . '" alt="" />' . $remove;
                    } else {
                        $parts = explode("/", $value);
                        for ($i = 0; $i < sizeof($parts); ++$i) {
                            $title = $parts[$i];
                        }

                    // No output preview if it's not an image.
                        $output .= '';

                    // Standard generic output if it's not an image.
                        $title = __('View File', 'eightphoto');
                        $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                    }
                }
                $output .= '</div></div>' . "\n";
                echo $output;
                break;

            case 'icon' :
             add_thickbox();
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>"><?php echo $eightphoto_widgets_title; ?>:</label><br />
                <span class="icon-receiver"><i class="<?php echo $athm_field_value; ?>"></i></span>
                <input class="hidden-icon-input" name="<?php echo $instance->get_field_name($eightphoto_widgets_name); ?>" type="hidden" id="<?php echo $instance->get_field_id($eightphoto_widgets_name); ?>" value="<?php echo $athm_field_value; ?>" />

                <?php if (isset($eightphoto_widgets_description)) { ?>
                    <br />
                    <small><?php echo $eightphoto_widgets_description; ?></small>
                <?php } ?>
            </p>
               
            <?php
            break;
    }
}

function eightphoto_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    // Allow only integers in number fields
    if ($eightphoto_widgets_field_type == 'number') {
        return absint($new_field_value);

        // Allow some tags in textareas
    } 
    
    elseif ($eightphoto_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    }
    elseif ($eightphoto_widgets_field_type == 'title') {
        return wp_kses_post($new_field_value);
    }
    else {
        return strip_tags($new_field_value);
    }
}

if(is_admin()):
/**
 * Enqueue scripts for file uploader
 */
function eightphoto_widgets_media_scripts($hook) {
    if ( 'customize.php' == $hook || 'widgets.php' == $hook ) {
        if (function_exists('wp_enqueue_media'))
            wp_enqueue_media();

        wp_register_script('eightphoto-of-media-uploader', get_template_directory_uri() . '/inc/widgets/js/widget-media-uploader.js', array('jquery'), 1.70);
        wp_enqueue_script('eightphoto-of-media-uploader');
        wp_localize_script('eightphoto-of-media-uploader', 'optionsframework_l10n', array(
            'upload' => __('Upload', 'eightphoto'),
            'remove' => __('Remove', 'eightphoto')
        ));       
       }
       else{
           return;
       }
}

add_action('admin_enqueue_scripts', 'eightphoto_widgets_media_scripts');
endif;