<?php

/**
 * Contact Info Widget
 *
 * @package eightphoto Pro
 */
/**
 * Adds eightphoto_contact_info widget.
 */
add_action('widgets_init', 'eightphoto_register_contact_info_widget');

function eightphoto_register_contact_info_widget() {
    register_widget('eightphoto_contact_info');
}

class Eightphoto_Contact_Info extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'eightphoto_contact_info', '8Photo : Contact Info', array(
            'description' => __('A widget that shows Contact Info', 'eightphoto')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'eightphoto_contact_info_title' => array(
                'eightphoto_widgets_name' => 'eightphoto_contact_info_title',
                'eightphoto_widgets_title' => __('Title', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'text',
            ),
            'eightphoto_contact_info_phone' => array(
                'eightphoto_widgets_name' => 'eightphoto_contact_info_phone',
                'eightphoto_widgets_title' => __('Phone', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'text',
            ),
            'eightphoto_contact_info_email' => array(
                'eightphoto_widgets_name' => 'eightphoto_contact_info_email',
                'eightphoto_widgets_title' => __('Email', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'text',
            ),            
            'eightphoto_contact_info_address' => array(
                'eightphoto_widgets_name' => 'eightphoto_contact_info_address',
                'eightphoto_widgets_title' => __('Contact Address', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'textarea',
                'eightphoto_widgets_row' => '2'
            ),
            'eightphoto_contact_info_time' => array(
                'eightphoto_widgets_name' => 'eightphoto_contact_info_time',
                'eightphoto_widgets_title' => __('About Description', 'eightphoto'),
                'eightphoto_widgets_field_type' => 'textarea',
                'eightphoto_widgets_row' => '4'
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        $eightphoto_contact_info_title = !empty($instance['eightphoto_contact_info_title'])?$instance['eightphoto_contact_info_title']: '';
        $eightphoto_contact_info_phone = !empty($instance['eightphoto_contact_info_phone'])?$instance['eightphoto_contact_info_phone']: '';
        $eightphoto_contact_info_email = !empty($instance['eightphoto_contact_info_email'])?$instance['eightphoto_contact_info_email']: '';
        $eightphoto_contact_info_address = !empty($instance['eightphoto_contact_info_address'])?$instance['eightphoto_contact_info_address']: '';
        $eightphoto_contact_info_time = !empty($instance['eightphoto_contact_info_time'])?$instance['eightphoto_contact_info_time']: '';

        echo $before_widget; ?>
        <div class="ed-contact-info">
        <?php
        if (!empty($eightphoto_contact_info_title)): ?>
            <h4 class="widget-title"><?php echo esc_html($eightphoto_contact_info_title); ?></h4>
        <?php endif; ?>

        <?php
        if (!empty($eightphoto_contact_info_time)): ?>
            <?php echo wpautop($eightphoto_contact_info_time); ?>
        <?php endif; ?>

        <ul>
        <?php
        if (!empty($eightphoto_contact_info_address)): ?>
            <li><i class="fa fa-map-marker"></i><?php echo esc_html($eightphoto_contact_info_address); ?></li>
        <?php endif; ?>

        <?php
        if (!empty($eightphoto_contact_info_phone)): ?>
            <li><i class="fa fa-phone"></i><?php echo esc_attr($eightphoto_contact_info_phone); ?></li>
        <?php endif; ?>

        <?php
        if (!empty($eightphoto_contact_info_email)): ?>
            <li><i class="fa fa-envelope"></i><?php echo esc_attr($eightphoto_contact_info_email); ?></li>
        <?php endif; ?>
        

        </ul>
        </div>
        <?php 
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	eightphoto_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$eightphoto_widgets_name] = eightphoto_widgets_updated_field_value($widget_field, $new_instance[$eightphoto_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	eightphoto_widgets_show_widget_field()		defined in widget-fields.php
     */
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
