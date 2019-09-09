<!--Sidebar-->
<div class="col-md-3 sidebar right-sidebar">
    <?php if (is_active_sidebar('sidebar-widget')) {
        dynamic_sidebar('sidebar-widget');
    } else {
        $args = array(
            'before_widget' => '<div class="widget widget-categories">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '<span class="head-line"></span></h4>'
        );
        the_widget('WP_Widget_Calendar', null, $args);
        the_widget('WP_Widget_Archives', null, $args);
        the_widget('WP_Widget_Meta', null, $args);
        the_widget('WP_Widget_Tag_Cloud', null, $args);
    } ?>
</div>
<!--End sidebar-->