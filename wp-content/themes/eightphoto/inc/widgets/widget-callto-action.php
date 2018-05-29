<?php
/**
 * Register the Widget
 */
add_action('widgets_init', create_function('', 'register_widget("eightphoto_call_to_action");'));

class eightphoto_call_to_action extends WP_Widget {

    /**
     * Constructor
     * */
    public function __construct() {
        parent::__construct(
            'eightphoto_cta', '8Photo : Call to Action', array(
                'description' => __('A widget that shows Call to Action', 'eightphoto')
                )
            );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'eightphoto_cta_title' => array(
                'eightphoto_widgets_name' => 'eightphoto_cta_title',
                'eightphoto_widgets_title' => __('CTA Title', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'text',
                ),
            
            'eightphoto_cta_image' => array(
                'eightphoto_widgets_name' => 'eightphoto_cta_image',
                'eightphoto_widgets_title' => __('Choose CTA Image', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'upload',
                ),

            'eightphoto_cta_btn_text' => array(
                'eightphoto_widgets_name' => 'eightphoto_cta_btn_text',
                'eightphoto_widgets_title' => __('Enter CTA Button Text', 'eightphoto' ),
                'eightphoto_widgets_field_type' => 'text'
                ),
            
            'eightphoto_cta_link' => array(
                'eightphoto_widgets_name' => 'eightphoto_cta_link',
                'eightphoto_widgets_title' => __('Enter CTA Link', 'eightphoto' ),
                'eightphoto_widgets_field_type' => 'url'
                ),
        );

        return $fields;
    }
    

    /*     * ********************** Outputs the HTML for this widget *************************** */

    public function widget($args, $instance) {
        extract($args);
        $title = !empty($instance['eightphoto_cta_title']) ? $instance['eightphoto_cta_title'] : __('Need a Photographer ?','eightphoto');
        $button_text = !empty($instance['eightphoto_cta_btn_text']) ? $instance['eightphoto_cta_btn_text'] : __('HIRE ME','eightphoto');
        $button_text_url = !empty($instance['eightphoto_cta_link']) ? $instance['eightphoto_cta_link'] : '';
        $image = isset($instance['eightphoto_cta_image']) ? $instance['eightphoto_cta_image'] : "";
        
        echo $before_widget;
        ?>
        <div class="call-to-action" style="background-image:url('<?php echo esc_url($image); ?>'); background-size: cover; position: scroll;"/>   
        <div class="home_caltoaction_overlay">
            <div class="call-to-action-title">
                <?php echo esc_html($title); ?>
            </div>
            <div class="call-to-action-button">
                <a href="<?php echo esc_url($button_text_url); ?>"><?php echo esc_html($button_text); ?></a>
            </div>
        </div>
        </div>
        <?php
        echo $after_widget;
    }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['eightphoto_cta_title'] = sanitize_text_field($new_instance['eightphoto_cta_title']);
        $instance['eightphoto_cta_btn_text'] = sanitize_text_field($new_instance['eightphoto_cta_btn_text']);
        $instance['eightphoto_cta_image'] = esc_url_raw($new_instance['eightphoto_cta_image']);
        $instance['eightphoto_cta_link'] = esc_url_raw($new_instance['eightphoto_cta_link']);
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $eightphoto_widgets_field_value = !empty($instance[$eightphoto_widgets_name]) ? esc_attr($instance[$eightphoto_widgets_name]) : '';
            eightphoto_widgets_show_widget_field($this, $widget_field, $eightphoto_widgets_field_value);
        }


        
    }

}
?>