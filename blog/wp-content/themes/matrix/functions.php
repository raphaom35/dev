<?php
/** Theme Name    : Matrix
 * Theme Core Functions and Codes
 */

require(get_template_directory() . '/functions/menu/default_menu_walker.php');
require(get_template_directory() . '/functions/menu/matrix_nav_walker.php');
require(get_template_directory() . '/default_options.php');
require(get_template_directory() . '/functions/matrix_functions.php');
require_once(get_template_directory(). '/inc/welcome-screen/welcome-screen.php');
require_once(get_template_directory(). '/inc/class-tgm-plugin-activation.php');
if (!class_exists('Kirki')) {
    include_once(dirname(__FILE__) . '/inc/kirki/kirki.php');
}
function matrix_minimal_customizer_config()
{
    $args = array(
        'url_path' => get_template_directory_uri() . '/inc/kirki/',
        'capability' => 'edit_theme_options',
        'option_type' => 'option',
        'option_name' => 'matrix_theme_options',
        'compiler' => array(),
        'color_accent' => '#27bebe',
        'width' => '23%',
        'description' => 'Visit our site for more great Products.If you like this theme please rate us 5 star',
    );
    return $args;
}

add_filter('kirki/config', 'matrix_minimal_customizer_config');
require(get_template_directory() . '/customizer.php');
function matrix_theme_setup()
{
    global $content_width;
    //content width
    if (!isset($content_width)) $content_width = 795; //px
    //supports featured image
    add_theme_support('post-thumbnails');
    load_theme_textdomain('matrix', get_template_directory() . '/functions/lang');
    /*** Home Blog ***/
	add_image_size('matrix_blog_image', 848, 476, true);
    add_image_size('matrix_blog_image_full', 1140, 476, true);
    add_image_size('matrix_single_post_image', 848, 530, true);
    add_image_size('matrix_single_fullwidth_image', 1140, 540, true);
    add_image_size('matrix_home_post_image', 264, 176, true);
	add_image_size('matrix_slider_post', 1440, 500, true);
    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'matrix'));
    register_nav_menu('secondary', __('Secondary Menu', 'matrix'));
    add_editor_style();
    $args = array(
		'default-color' => 'ffffff',
		'default-image'          => '',
		'default-text-color'     => 'ee3733',
		'width'                  => 1280,
		'height'                 => 150,
		'flex-height'            => true,
		'wp-head-callback'       => 'matrix_header_style',
		'video'					 =>true
	);
    add_theme_support('custom-background');
    add_theme_support('custom-header', $args);
    add_theme_support('automatic-feed-links');
    add_theme_support('woocommerce');
    add_theme_support('title-tag');
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 150,
		'flex-height' => true,
	) );
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'starter-content', array(
	 
		'posts' => array(
			'home' => array(
				'template'	=> 'home-page.php',
			),
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			)
		),
		
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		'widgets' => array(
			'sidebar-widget' => array(
				'search',
				'text_business_info',
				'text_about',
				'category',
				'tags',
			),

			'footer-widget' => array(
				'text_business_info',
				'text_about',
				'meta',
				'search',
			),
		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'matrix' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'secondary' => array(
				'name' => __( 'Primary Menu', 'matrix' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	) );
}

add_action('after_setup_theme', 'matrix_theme_setup');
// Migrate any existing theme CSS to the core option added in WordPress 4.7.
if ( function_exists( 'wp_get_custom_css' ) && class_exists('Kirki') ) {
	  $fields = Kirki::$fields;
		$fields['matrix_theme_options[matrix_custom_css]']['description']=__("This field will no longer work. Since WordPress 4.7 has it's own Custom CSS Editor we recommed you to put all your custom CSS in that field","matrix");

		$fields['matrix_theme_options[matrix_custom_css]']['tooltip']=__("This field will no longer work. Since WordPress 4.7 has it's own Custom CSs Editor we recommed you to put all your custom CSS in that field.","matrix");
		Kirki::$fields = $fields;
}else{
	add_action('wp_head','matrix_custom_css');
	function matrix_custom_css(){
		$matrix_theme_options = matrix_theme_options();
		if($matrix_theme_options['matrix_custom_css']!=""){?>
			<style type="text/css"><?php echo ($matrix_theme_options['matrix_custom_css']); ?></style>
		<?php }
	}
}
if ( ! function_exists( 'matrix_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see matrix_custom_header_setup().
 */
function matrix_header_style() {
	$header_text_color = get_header_textcolor();
	global $matrix_theme_options;
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		a#alogo,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		 a#alogo,
		.site-description,
		.navbar-default .navbar-nav > li:hover > a, .navbar-default .navbar-nav > li > a.active,
		.dropdown > li:hover > a, .sup-dropdown li:hover > a{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // matrix_header_style
add_action('wp_enqueue_scripts', 'matrix_enqueue_style');
function matrix_enqueue_style()
{
    $matrix_theme_options = matrix_theme_options();
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
    wp_enqueue_style('matrix_main_style', get_stylesheet_uri());
    wp_enqueue_style('matrix_responsive', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('matrix_color_scheme', get_template_directory_uri() . '/css/colors/' . esc_attr($matrix_theme_options['color_scheme']) . '.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style('slicknav', get_template_directory_uri() . '/css/slicknav.css');
    wp_enqueue_style('matrix_font_open_sans','//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
    wp_enqueue_style('matrix_font_lora','//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
    wp_enqueue_style('matrix_font_raleway','//fonts.googleapis.com/css?family=Raleway:400,300,700');
	wp_enqueue_script('migrate', get_template_directory_uri() . '/js/jquery.migrate.js', array('jquery'));
    wp_enqueue_script('modernizrr', get_template_directory_uri() . '/js/modernizrr.js');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js');
	wp_enqueue_script('jquery.dcjqaccordion-js', get_template_directory_uri() . '/js/jquery.dcjqaccordion.js');
	 wp_enqueue_script('jquery.mb.YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js');
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));
    wp_enqueue_script('nivo-lightbox', get_template_directory_uri() . '/js/nivo-lightbox.js');
    wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array('jquery'));
    wp_enqueue_script('textillate', get_template_directory_uri() . '/js/jquery.textillate.js', array('jquery'));
    wp_enqueue_script('lettering', get_template_directory_uri() . '/js/jquery.lettering.js', array('jquery'));
    wp_enqueue_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.js', array('jquery'));
    wp_enqueue_script('parallax', get_template_directory_uri() . '/js/jquery.parallax.js', array('jquery'));
    wp_enqueue_script('matrix_custom_script', get_template_directory_uri() . '/js/script.js', array('jquery'));
    wp_enqueue_script('jquery-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.js', array('jquery'));
    if (is_page_template('home-page.php')) {
        /** Home Blog **/
        wp_enqueue_script('carouFredSel', get_template_directory_uri() . '/js/carouFredSel-6.2.1/jquery.carouFredSel-6.2.1.js');
        wp_enqueue_script('matrix-carouFredSel', get_template_directory_uri() . '/js/carouFredSel-6.2.1/carousalFredSel.js');
    }
	// inline CSS
	$header_text = display_header_text();
	if ($header_text  && $matrix_theme_options['logo_layout'] == 'right') {
		$custom_css = '@media (max-width: 767px) {
			.navbar-header{
				float: none !important;
			}
			.slicknav_btn {
				margin: 16px 15px !important;
				float: left !important;
		} }';
		wp_add_inline_style('matrix_main_style', $custom_css);
    }
	if ((!$matrix_theme_options['site_layout'] == "boxed-page") && ($matrix_theme_options['headersticky'] == 1)){
		$custom_css = '@media only screen and (min-width: 1200px){
			.navbar-top.affix {
				width: 100%;
			}
		}';
		wp_add_inline_style('matrix_main_style', $custom_css);
	}
}

if (is_singular()) wp_enqueue_script("comment-reply");
// Read more tag to formatting in blog page
function matrix_content_more($read_more)
{
    return '<div class=""><a class="main-button" href="' . esc_url(get_permalink()) . '">' . __('Read More', 'matrix') . '<i class="fa fa-angle-right"></i></a></div>';
}

add_filter('the_content_more_link', 'matrix_content_more');
// Replaces the excerpt "more" text by a link
function matrix_excerpt_more($more)
{
    return '<div class=""><a class="main-button" href="' . esc_url(get_permalink()) . '">' . __('Read More...', 'matrix') . '</a></div>';
}

add_filter('excerpt_more', 'matrix_excerpt_more');
add_action( 'tgmpa_register', 'matrix_register_required_plugins' );
function matrix_register_required_plugins() {
    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'               => 'Social Media Gallery', // The plugin name.
            'slug'               => 'social-media-gallery', // The plugin slug (typically the folder name).
            'required'           => false,
        ),
		array(
            'name'               => 'Photo Video Gallery Master', // The plugin name.
            'slug'               => 'photo-video-gallery-master', // The plugin slug (typically the folder name).
            'required'           => false,
        ),
		array(
            'name'     => 'Ultimate Gallery Master', // The plugin name.
            'slug'     => 'ultimate-gallery-master', // The plugin slug (typically the folder name).
            'required' => false,
        ),
    );

    $config = array(
        'id'           => 'matrix',                 // Unique ID for hashing notices for multiple instances of matrix.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'matrix-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );
    matrix( $plugins, $config );
}
?>
<?php
/*
* Matrix widget area
*/
add_action('widgets_init', 'matrix_widget');
function matrix_widget()
{
    /*sidebar*/
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'matrix'),
        'id' => 'sidebar-widget',
        'description' => __('Sidebar widget area', 'matrix'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '<span class="head-line"></span></h4>'
    ));
    $matrix_theme_options = matrix_theme_options();
    $col = $matrix_theme_options['footer_layout'];
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'matrix'),
        'id' => 'footer-widget',
        'description' => __('Footer widget area', 'matrix'),
        'before_widget' => '<div class="col-md-' . $col . ' col-sm-6">
									<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4>',
        'after_title' => '<span class="head-line"></span></h4>',
    ));
}

function matrix_comments($comments, $args, $depth)
{
    $GLOBALS['comment'] = $comments;
    extract($args, EXTR_SKIP);
    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <li>
    <div class="comment-box clearfix">
        <div
            class="avatar"> <?php if ($args['avatar_size'] != 0) echo get_avatar($comments, $args['avatar_size']); ?></div>
        <div class="comment-content">
            <div class="comment-meta">
                <span class="comment-by"><?php printf('%s', get_comment_author()); ?></span>
                <?php if ($comments->comment_approved == '0') { ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'matrix'); ?></em><br/>
            </div><?php
            }else{
            ?>
            <span
                class="comment-date"><?php printf(__('%1$s at %2$s', 'matrix'), get_comment_date(), get_comment_time()); ?></span>
            <span
                class="reply-link"><?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?> </span>
            <?php comment_text(); ?>
        </div><?php } ?>
    </div>

    </div>
<?php } 
/*** Page pagination ***/
function matrix_pagination_link()
{
    ?>
    <div id="pagination">
    <div class="left"><?php previous_post_link('%link'); ?></div>
    <div class="right"><?php next_post_link('%link'); ?></div>
    </div><?php
}

/****--- Navigation for Author, Category , Tag , Archive ---***/
function matrix_pagination()
{
    ?>
    <div id="pagination">
        <?php posts_nav_link(); ?>
    </div>
<?php }
add_action('admin_init', 'matrix_init');
function matrix_init(){
    add_meta_box('matrix_page', 'Page Info', 'matrix_page_layout_meta', 'page', 'normal', 'high');
    add_meta_box('matrix_post', 'Post Info', 'matrix_post_layout_meta', 'post', 'normal', 'high');
    add_action('save_post', 'matrix_meta_save');
}
function matrix_post_layout_meta()
{
    global $post;
    $post_layout = sanitize_text_field(get_post_meta(get_the_ID(), 'post_layout', true));
    if (!$post_layout) {
        $post_layout = "fullwidth_right";
    }
    ?>
    <input id="radio3" <?php if ($post_layout == "fullwidth_right") {
        echo "checked";
    } ?> type="radio" name="post_layout" value="fullwidth_right">
    <label for="radio3" <?php if ($post_layout == "fullwidth_right") {
        echo "checked";
    } ?> ><img src="<?php echo get_template_directory_uri(); ?>/images/layout/right-sidebar.jpg" alt="esc_attr_e('Matrix Image', 'matrix');"></label>
    <input id="radio2" <?php if ($post_layout == "fullwidth_left") {
        echo "checked";
    } ?> type="radio" name="post_layout" value="fullwidth_left">
    <label for="radio2" <?php if ($post_layout == "fullwidth_left") {
        echo "checked";
    } ?> ><img src="<?php echo get_template_directory_uri(); ?>/images/layout/left-sidebar.jpg" alt="esc_attr_e('Matrix Image', 'matrix');"></label>
    <input id="radio1"    <?php if ($post_layout == "fullwidth") {
        echo "checked";
    } ?> type="radio" name="post_layout" value="fullwidth">
    <label for="radio1" <?php if ($post_layout == "fullwidth") {
        echo "checked";
    } ?> ><img src="<?php echo get_template_directory_uri(); ?>/images/layout/full-width.jpg" alt="esc_attr_e('Matrix Image', 'matrix');"></label>
    </p>
<?php
}

function matrix_page_layout_meta()
{
    global $post;
    $page_layout = sanitize_text_field(get_post_meta(get_the_ID(), 'page_layout', true));
    if (!$page_layout) {
        $page_layout = "fullwidth_right";
    }
    ?>
    <input id="radio3" <?php if ($page_layout == "fullwidth_right") {
        echo "checked";
    } ?> type="radio" name="page_layout" value="fullwidth_right">
    <label for="radio3" <?php if ($page_layout == "fullwidth_right") {
        echo "checked";
    } ?> ><img src="<?php echo get_template_directory_uri(); ?>/images/layout/right-sidebar.jpg" alt="esc_attr_e('Matrix Image', 'matrix');"></label>
    <input id="radio2" <?php if ($page_layout == "fullwidth_left") {
        echo "checked";
    } ?> type="radio" name="page_layout" value="fullwidth_left">
    <label for="radio2" <?php if ($page_layout == "fullwidth_left") {
        echo "checked";
    } ?> ><img src="<?php echo get_template_directory_uri(); ?>/images/layout/left-sidebar.jpg" alt="esc_attr_e('Matrix Image', 'matrix');"></label>
    <input id="radio1"    <?php if ($page_layout == "fullwidth") {
        echo "checked";
    } ?> type="radio" name="page_layout" value="fullwidth">
    <label for="radio1" <?php if ($page_layout == "fullwidth") {
        echo "checked";
    } ?> ><img src="<?php echo get_template_directory_uri(); ?>/images/layout/full-width.jpg" alt="esc_attr_e('Matrix Image', 'matrix');"></label>
    </p>
<?php
}
function matrix_meta_save($post_id)
{
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
        return;
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
        $post_type = get_post_type($post_ID);
        if ($post_type == 'page') {
            update_post_meta($post_ID, 'page_layout', sanitize_text_field($_POST['page_layout']));
        } else if ($post_type == 'post') {
            update_post_meta($post_ID, 'post_layout', sanitize_text_field($_POST['post_layout']));
        }
    }
}
?>