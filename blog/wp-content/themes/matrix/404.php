<?php get_header(); ?>
    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="page-content">
                <div class="error-page">
                    <h1><?php _e('404', 'matrix'); ?></h1>

                    <h3><?php _e('Page not Found', 'matrix'); ?></h3>

                    <p><?php _e('We are sorry, but the page you were looking for does not exist.', 'matrix'); ?></p>

                    <div class="text-center"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                class="btn-system btn-small"><?php _e('Back To Home', 'matrix'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
<?php get_footer(); ?>