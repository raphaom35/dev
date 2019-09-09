<?php $matrix_theme_options = matrix_theme_options();
$col = $matrix_theme_options['footer_layout']; ?>
<!-- Start Footer Section -->
<footer>
    <div class="container">
		<?php if ($matrix_theme_options['show_footer_widget']) { ?>
        <div class="row footer-widgets">
            <?php
            if (is_active_sidebar('footer-widget')) {
                dynamic_sidebar('footer-widget');
            } else {
                $args = array(
                    'before_widget' => '<div class="col-md-' . $col . ' col-sm-6">
											<div class="footer-widget mail-subscribe-widget">',
                    'after_widget' => '</div></div>',
                    'before_title' => '<h4>',
                    'after_title' => '<span class="head-line"></span></h4>',
                );
                the_widget('WP_Widget_Archives', null, $args);
                the_widget('WP_Widget_Meta', null, $args);
                the_widget('WP_Widget_Pages', null, $args);
				the_widget('WP_Widget_Calendar', null, $args);
            } ?>
        </div>
		<?php } ?>
        <!-- .row -->
        <!-- Start Copyright -->
        <div class="copyright-section">
            <div class="row"><?php
                if ($matrix_theme_options['copyright_text_footer']) {
                    ?>
                    <div class="col-md-6">
                        <p><span
                                id="copyright-text"><?php echo esc_attr($matrix_theme_options['footer_copyright_text']); ?> </span>
                            <a id="copyright-link" href="<?php if ($matrix_theme_options["created_by_link"] != "") {
                                echo esc_url($matrix_theme_options["created_by_link"]);
                            } ?>"><?php echo esc_attr($matrix_theme_options['created_by_matrix_text']); ?></a></p>
                    </div><!-- .col-md-6 -->
                <?php } ?>
                <div class="col-md-6">
                    <?php if ($matrix_theme_options['social_media_footer']) { ?>
                        <ul class="social-list" id="social-list-footer">
                        <?php if ($matrix_theme_options['social_facebook_link'] != '') { ?>
                            <li>
                                <a class="facebook" data-placement="bottom" title="Facebook"
                                   href="<?php echo esc_url($matrix_theme_options['social_facebook_link']); ?>"><i
                                        class="fa fa-facebook"></i></a>
                            </li>
                        <?php }
                        if ($matrix_theme_options['social_twitter_link'] != '') { ?>
                            <li>
                                <a class="twitter" data-placement="bottom" title="Twitter"
                                   href="<?php echo esc_url($matrix_theme_options['social_twitter_link']); ?>"><i
                                        class="fa fa-twitter"></i></a>
                            </li>
                        <?php }
                        if ($matrix_theme_options['social_google_plus_link'] != '') { ?>
                            <li>
                                <a class="google" data-placement="bottom" title="Google Plus"
                                   href="<?php echo esc_url($matrix_theme_options['social_google_plus_link']); ?>"><i
                                        class="fa fa-google-plus"></i></a>
                            </li>
                        <?php }
                        if ($matrix_theme_options['social_dribble_link'] != '') { ?>
                            <li>
                                <a class="dribbble" data-placement="bottom" title="Dribble"
                                   href="<?php echo esc_url($matrix_theme_options['social_dribble_link']); ?>"><i
                                        class="fa fa-dribbble"></i></a>
                            </li>
                        <?php }
                        if ($matrix_theme_options['social_linkedin_link'] != '') { ?>
                            <li>
                                <a class="linkdin" data-placement="bottom" title="Linkedin"
                                   href="<?php echo esc_url($matrix_theme_options['social_linkedin_link']); ?>"><i
                                        class="fa fa-linkedin"></i></a>
                            </li>
                        <?php }
                        if ($matrix_theme_options['social_instagram_link'] != '') { ?>
                            <li>
                                <a class="instgram" data-placement="bottom" title="Instagram"
                                   href="<?php echo esc_url($matrix_theme_options['social_instagram_link']); ?>"><i
                                        class="fa fa-instagram"></i></a>
                            </li>
                        <?php } ?>
                        </ul><?php
                    } else {
                        wp_nav_menu(array(
                                'theme_location' => 'secondary',
                                'menu_class' => 'footer-nav',
                                'fallback_cb' => 'matrix_fallback_page_menu',
                                'walker' => new matrix_nav_walker(),
                            )
                        );
                    }                    ?>
                    <!-- End Navigation List -->
                </div>
                <!-- .col-md-6 -->
            </div>
            <!-- .row -->
        </div>
        <!-- End Copyright -->
    </div>
</footer>
<!-- End Footer Section -->
</div>
<!-- End Full Body Container -->
<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
<div id="loader">
    <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
    </div>
</div>
<?php wp_footer(); ?>
</body>

</html>