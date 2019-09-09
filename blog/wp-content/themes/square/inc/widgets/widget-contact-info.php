<?php
/**
 * @package Square
 */

add_action('widgets_init', 'square_register_contact_info');

function square_register_contact_info() {
    register_widget('square_contact_info');
}

class Square_Contact_Info extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'square_contact_info', 'Square - Contact Info', array(
                'description' => __('A widget to display Contact Information', 'square')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'square_widgets_name' => 'title',
                'square_widgets_title' => __('Title', 'square'),
                'square_widgets_field_type' => 'text',
            ),
            'phone' => array(
                'square_widgets_name' => 'phone',
                'square_widgets_title' => __('Phone', 'square'),
                'square_widgets_field_type' => 'text',
            ),
            'contact_info_email' => array(
                'square_widgets_name' => 'email',
                'square_widgets_title' => __('Email', 'square'),
                'square_widgets_field_type' => 'text',
            ),
            'website' => array(
                'square_widgets_name' => 'website',
                'square_widgets_title' => __('Website', 'square'),
                'square_widgets_field_type' => 'text',
            ),
            'address' => array(
                'square_widgets_name' => 'address',
                'square_widgets_title' => __('Contact Address', 'square'),
                'square_widgets_field_type' => 'textarea',
                'square_widgets_row' => '4'
            ),
            'time' => array(
                'square_widgets_name' => 'time',
                'square_widgets_title' => __('Contact Time', 'square'),
                'square_widgets_field_type' => 'textarea',
                'square_widgets_row' => '3'
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

        $title = isset( $instance['title'] ) ? $instance['title'] : '' ;
        $phone = isset( $instance['phone'] ) ? $instance['phone'] : '' ;
        $email = isset( $instance['email'] ) ? $instance['email'] : '' ;
        $website = isset( $instance['website'] ) ? $instance['website'] : '' ;
        $address = isset( $instance['address'] ) ? $instance['address'] : '' ;
        $time = isset( $instance['time'] ) ? $instance['time'] : '' ;

        echo $before_widget;
        ?>
        <div class="sq-contact-info">
            <?php
            if (!empty($title)):
                echo $before_title . esc_html($title) . $after_title;
            endif;
            ?>

            <ul>
                <?php if (!empty($phone)): ?>
                    <li><i class="fa fa-phone"></i><?php echo esc_html($phone); ?></li>
                <?php endif; ?>

                <?php if (!empty($email)): ?>
                    <li><i class="fa fa-envelope"></i><?php echo esc_html($email); ?></li>
                <?php endif; ?>

                <?php if (!empty($website)): ?>
                    <li><i class="fa fa-globe"></i><?php echo esc_html($website); ?></li>
                <?php endif; ?>

                <?php if (!empty($address)): ?>
                    <li><i class="fa fa-map-marker"></i><?php echo wpautop(esc_html($address)); ?></li>
                <?php endif; ?>

                <?php if (!empty($time)): ?>
                    <li><i class="fa fa-clock-o"></i><?php echo wpautop(esc_html($time)); ?></li>
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
     * @uses	square_widgets_updated_field_value()		defined in widget-fields.php
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
            $instance[$square_widgets_name] = square_widgets_updated_field_value($widget_field, $new_instance[$square_widgets_name]);
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
     * @uses	square_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $square_widgets_field_value = !empty($instance[$square_widgets_name]) ? esc_attr($instance[$square_widgets_name]) : '';
            square_widgets_show_widget_field($this, $widget_field, $square_widgets_field_value);
        }
    }

}
