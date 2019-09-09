<?php
/**
 * This fucntion is responsible for rendering metaboxes
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
 
 add_action( 'add_meta_boxes', 'esteem_add_custom_box' );
/**
 * Add Meta Boxes.
 * 
 * Add Meta box in page and post post types.
 */ 
function esteem_add_custom_box() {

	//adds sidebar layout box in page
	add_meta_box( 
		'page-layout',						
		__( 'Select Layout', 'esteem' ), 
		'esteem_layout_call', 
		'page', 
		'side', 
		'default' 
	);

	//adds sidebar layout box in post
	add_meta_box( 
		'post-layout',
		 __( 'Select Layout', 'esteem' ), 
		 'esteem_layout_call', 
		 'post', 
		 'side', 
		 'default' 
	);

	//adds fontawesome icons dropdown lists
	add_meta_box(
		'services-icon',							  						//Unique ID
		__( 'Icon class', 'esteem' ),   									//Title
		'esteem_icon_call',                   								//Callback function
		'page',                                          					//show metabox in posts
		'side'																//show metabox at side of editor
	); 

}
global $prefix,$esteem_metabox_field_icons,$esteem_metabox_field_layout;

$prefix = '_esteem';

$esteem_metabox_field_layout = array(
	array(
		'id'			=> $prefix.'_layout',
		'label'			=> __( 'Sidebar Layout', 'esteem' ),
		'type'			=>'radio',
		'default'		=> 'default_layout',
		'options' 		=> array (
		    'one' => array (
		        'label' => __( 'Default Layout', 'esteem' ),
		        'value' => 'default_layout'
		    ),
		    'two' => array (
		        'label' => __( 'Right Sidebar', 'esteem' ),
		        'value' => 'right_sidebar'
		    ),
		    'three' => array (
		        'label' => __( 'Left Sidebar', 'esteem' ),
		        'value' => 'left_sidebar'
		    ),
		    'four' => array (
		        'label' => __( 'No sidebar full width', 'esteem' ),
		        'value' => 'no_sidebar_full_width'
		    ),
		    'five' => array (
		        'label' => __( 'No sidebar content Centered', 'esteem' ),
		        'value' => 'no_sidebar_content_centered'
		    )
		)
	)
);

$esteem_metabox_field_icons = array(
	array(
		'id'			=> $prefix.'_font_icon',
		'label' 		=> __( 'fontawesome Icons', 'esteem' ),
		'type'			=> 'select',
		'options' 		=> esteem_icon_list()
	)
);
function esteem_layout_call() {
	global $esteem_metabox_field_layout;
	esteem_page_layout( $esteem_metabox_field_layout );
}

function esteem_icon_call() {
	global $esteem_metabox_field_icons;
	esteem_page_layout( $esteem_metabox_field_icons );
}

/**
 * Renders the metabox
 */
function esteem_page_layout( $esteem_metabox_field ) {  
	global $post;
	//Use nonce for verification  
	wp_nonce_field( basename( __FILE__ ), 'esteem_metabox_nonce' );

	foreach ($esteem_metabox_field as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch( $field['type'] ) {

			// select
			case 'select':
		    	echo '<select name="'.$field['id'].'" id="'.$field['id'].'" class="fontawesome">';
		    	foreach ($field['options'] as $option_key => $option_value) {
		        	echo '<option', $meta == $option_key ? ' selected="selected"' : '', ' value="'.$option_key.'">'.str_replace('&amp;', '&', htmlentities(stripslashes($option_value), ENT_QUOTES, "UTF-8")).'</option>';
		    	}
		    	echo '</select><br />';

			break;

			// radio
			case 'radio':
				if( empty( $meta) ){
					$meta = $field['default'];
				}
			    foreach ( $field['options'] as $option ) {
			        echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
			                <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
			    }
			break;

		}
	}
}

// Save the Data
function esteem_save_custom_meta( $post_id ) {
    global $esteem_metabox_field_icons, $esteem_metabox_field_layout,$post;

     
	// Verify the nonce before proceeding.
	if ( !isset( $_POST[ 'esteem_metabox_nonce' ] ) || !wp_verify_nonce( $_POST[ 'esteem_metabox_nonce' ], basename( __FILE__ ) ) )
    	return;

    // check autosave
    if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    	return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
    	if ( !current_user_can( 'edit_page', $post_id ) )
    		return $post_id;
    }
     
    // loop through fields and save the data
    foreach ( $esteem_metabox_field_icons as $field ) {
    	$old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];
        update_post_meta( $post_id,$field['id'],$new );
        if ($new && $new != $old) {
            
        } elseif ('' == $new && $old) {
        	delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach

     // loop through fields and save the data
    foreach ( $esteem_metabox_field_layout as $field ) {
    	$old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];
        update_post_meta( $post_id,$field['id'],$new );
        if ($new && $new != $old) {
            
        } elseif ('' == $new && $old) {
        	delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('pre_post_update', 'esteem_save_custom_meta');
?>