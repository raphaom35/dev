<?php if ( ! function_exists( 'matrix_entry_meta' ) ) :
/**
 * Shows meta information of post.
 */
function matrix_entry_meta() {
   if ( 'post' == get_post_type() ) :
	  echo '<ul class="post-meta">';
	  ?>

	  <li><?php _e('By : ','matrix'); ?> <span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span></li>

	  <?php
	  $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		 $time_string .= '&nbsp;<time class="updated" datetime="%3$s">%4$s</time>';
	  }
	  $time_string = sprintf( $time_string,
		 esc_attr( get_the_date( 'c' ) ),
		 esc_html( get_the_date() ),
		 esc_attr( get_the_modified_date( 'c' ) ),
		 esc_html( get_the_modified_date() )
	  );
	  printf( __( '<li><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></li>', 'matrix' ),
		 esc_url( get_permalink() ),
		 esc_attr( get_the_time() ),
		 $time_string
	  ); ?>

	  <?php if( has_category() ) { ?>
		<li> <?php the_category(', '); ?></li>
	  <?php } ?>

	  <?php if ( comments_open() ) { ?>
		<li><?php comments_popup_link( __( 'No Comments', 'matrix' ), __( '1 Comment', 'matrix' ), __( '% Comments', 'matrix' ), '', __( 'Comments Off', 'matrix' ) ); ?></li>
	  <?php } ?>

	  <?php edit_post_link( __( 'Edit', 'matrix' ), '<span class="edit-link">', '</span>' ); ?>

	  <?php
	  echo '</ul>';
   endif;
}
endif;

add_filter( 'get_product_search_form' , 'matrix_custom_product_searchform' );
function matrix_custom_product_searchform( $form ) {
	$form = '<form action="'.esc_url(home_url('/')).'" autocomplete="off" role="search" method="get" class="searchform">
		<input type="search" value="'.get_search_query().'" name="s" id="s" class="form-control search-field" placeholder="'.esc_attr__('Search Product...', 'matrix').'"/>
		<input type="hidden" name="post_type" value="product">	
		<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
	</form>';
	return $form;
	
}
/* woocomerce */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'matrix_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'matrix_theme_wrapper_end', 10);
function matrix_theme_wrapper_start()
{
    echo ' <div id="content">
			<div class="container">
				<div class="col-md-9 page-content">';
}
function matrix_theme_wrapper_end()
{
    ?>
    </div>
	<?php get_sidebar(); ?>
    </div>
    </div>
<?php
}
/* Breadcrumbs  */
function matrix_breadcrumbs()
{
    $delimiter = '';
    $home = __('Home', 'matrix'); // text for the 'Home' link
    $before = '<li>'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb
    echo '<ul class="breadcrumbs">';
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . esc_url($homeLink) . '">' . $home . '</a></li>' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . __("Posts by category: ", "matrix") . single_cat_title('', false) . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
            echo $before . esc_attr(get_the_title()) . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . esc_attr(get_the_title()) . $after;
        }

    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_attr(get_the_title($page->ID)) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for: ', 'matrix') . '"' . esc_attr(get_search_query()) . '"' . $after;

    } elseif (is_tag()) {
        echo $before . __('Tag', 'matrix') . single_tag_title('', false) . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by', 'matrix') . esc_attr($userdata->display_name) . $after;
    } elseif (is_404()) {
        echo $before . __('Error 404', 'matrix') . $after;
    }
    echo '</ul>';
}
$matrix_theme_options = matrix_theme_options();
if($matrix_theme_options['portfolio_four_column']){
	add_action('wp_footer','matrix_enqueue_in_footer');
	function matrix_enqueue_in_footer(){
		echo '<style>@media (min-width: 992px) { .wl-gallery{ width:24.9%;} }</style>';
	}
}

/* Update wishlist */
function matrix_update_wishlist_count(){
    if( function_exists( 'YITH_WCWL' ) ){
        wp_send_json( YITH_WCWL()->count_products());
    }
}
add_action( 'wp_ajax_matrix_update_wishlist_count', 'matrix_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_matrix_update_wishlist_count', 'matrix_update_wishlist_count' );