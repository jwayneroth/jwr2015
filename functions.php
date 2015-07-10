<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/////////////////////////////////////////
//  JWR
///////////////////////////////////////

/*
 * jwr_global_js
*/
function jwr_global_js() {
	echo '<script>var JWR = JWR || {};JWR.ajaxurl="' .admin_url( 'admin-ajax.php' ) . '";</script>';
}
add_action('wp_head', 'jwr_global_js');

/*
 * jwr_contact_submit
*/
function jwr_contact_submit() {
	
	if( !isset($_POST['contact-pass']) || $_POST['contact-pass'] != 'phrase' ) {
		echo 0;
		wp_die();
	}
	
	$name    = sanitize_text_field( $_POST["contact-name"] );
	$email   = sanitize_email( $_POST["contact-email"] );
	$subject = 'contact via rothpaintings.com from ' . $name . ' ' . $email;
	$message = esc_textarea( $_POST["contact-message"] );
	
	$to = get_option( 'admin_email' );
	
	//$headers = "From: $name <$email>" . "\r\n";
	
	$headers = array("From:jonathan <jonathan@rothpaintings.com>");
	
	if ( wp_mail( $to, $subject, $message, $headers ) ) {
		echo 1;
		//error_log('mail processed ' . $to);
	} else {
		echo 0;
		error_log('rothpaintings.com jwr_contact_submit mail failed');
	}
	
	wp_die();
	
}
add_action( 'wp_ajax_jwr_contact_submit', 'jwr_contact_submit' );
add_action( 'wp_ajax_no_priv_jwr_contact_submit', 'jwr_contact_submit' );

add_image_size( 'painting-zoom', 1153 );
add_image_size( 'painting-full', 700, 600 );
add_image_size( 'painting-thumb', 95, 100 );

function jwr_page_scripts() {
	//styles
	wp_register_style('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300', array(), '', 'all' );
	wp_register_style('libre-baskerville', 'http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic', array(), '', 'all' );

	//scripts
	wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/library/js/libs/bootstrap.min.js', array('jquery'));
	wp_register_script('validate', get_stylesheet_directory_uri() . '/library/js/libs/jquery.validate.min.js', array('jquery'));
	wp_register_script('jwr-bgexpand', get_stylesheet_directory_uri() . '/library/js/BGExpand.js', array('jquery'));
	wp_register_script('jwr-main', get_stylesheet_directory_uri() . '/library/js/main.js', array('jquery'));
	wp_register_script('jwr-timebg', get_stylesheet_directory_uri() . '/library/js/TimeBG.js', array('jquery'));
	wp_register_script('jwr-colorutils', get_stylesheet_directory_uri() . '/library/js/ColorUtils.js', array('jquery'));
	wp_register_script('jwr-zoom', get_stylesheet_directory_uri() . '/library/js/Zoom.js', array('jquery'));
	
	//enqueue for...
	wp_enqueue_style('open-sans');
	wp_enqueue_style('libre-baskerville');
	
	if(!is_admin()) {
		//all frontend
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('validate');
		wp_enqueue_script('jwr-bgexpand');
		wp_enqueue_script('jwr-main');
		wp_enqueue_script('jwr-timebg');
		wp_enqueue_script('jwr-colorutils');
		wp_enqueue_script('jwr-zoom');
	}
}
add_action( 'wp_enqueue_scripts', 'jwr_page_scripts' );

///////////////////
// POST TYPES
/////////////////

function jwr_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'jwr_flush_rewrite_rules' );

function jwr_custom_post_types() { 

	register_post_type( 'artwork', 
		array( 'labels' => array(
			'name' => __( 'Artworks', 'bonestheme' ), 
			'singular_name' => __( 'Artwork', 'bonestheme' ), 
			'all_items' => __( 'All Artworks', 'bonestheme' ), 
			'add_new' => __( 'Add New', 'bonestheme' ), 
			'add_new_item' => __( 'Add New Artwork', 'bonestheme' ), 
			'edit' => __( 'Edit', 'bonestheme' ), 
			'edit_item' => __( 'Edit Artworks', 'bonestheme' ),
			'new_item' => __( 'New Artwork', 'bonestheme' ), 
			'view_item' => __( 'View Artwork', 'bonestheme' ),
			'search_items' => __( 'Search Artwork', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), 
			'parent_item_colon' => ''
			), 
			'description' => __( 'jwr artwork!', 'bonestheme' ), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2, 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
			'rewrite'	=> array( 'slug' => 'artwork', 'with_front' => false ), 
			'has_archive' => 'artwork',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 
				'title'
				//,'editor'
				,'author'
				,'thumbnail'
				//,'excerpt'
				,'trackbacks'
				//'custom-fields',
				//'comments',
				,'revisions'
				//'sticky'
			)
		) 
	);
	
	register_taxonomy_for_object_type( 'category', 'custom_type' );
	register_taxonomy_for_object_type( 'post_tag', 'custom_type' );
	
}
add_action( 'init', 'jwr_custom_post_types');

//////////////
// CMB2
////////////

//get bootstrap
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/CMB2/init.php';
}

function jwr_cmb2_fields( array $meta_boxes ) {

	$prefix = '_artwork_';

	$meta_boxes['artwork_details'] = array(
		'id'            => 'artwork_details',
		'title'         => __( 'Artwork Details', 'cmb2' ),
		'object_types'  => array( 'artwork', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
		'fields'        => array(
			array(
				'name'       => __( 'Title', 'cmb2' ),
				'desc'       => __( 'title', 'cmb2' ),
				'id'         => $prefix . 'title',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name'       => __( 'Year', 'cmb2' ),
				'desc'       => __( 'year', 'cmb2' ),
				'id'         => $prefix . 'year',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name'       => __( 'Dimensions', 'cmb2' ),
				'desc'       => __( 'dimensions', 'cmb2' ),
				'id'         => $prefix . 'dimensions',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name'       => __( 'Materials', 'cmb2' ),
				'desc'       => __( 'materials', 'cmb2' ),
				'id'         => $prefix . 'materials',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			)
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'jwr_cmb2_fields' );

/*class JWR_Post_Types_Order_Walker extends Post_Types_Order_Walker {
 
	var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class='children'>\n";
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el(&$output, $page, $depth = 0, $args = array(), $id = 0) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
			
		$thumb = get_the_post_thumbnail($page->ID, 'painting-thumb');
			
		$output .= $indent . '<li id="item_'.$page->ID.'">'.$thumb.'<span>'.apply_filters( 'the_title', $page->post_title, $page->ID ).'</span>';
	}


	function end_el(&$output, $page, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}

}*/

/////////////////////////////////////////
//  BONES
///////////////////////////////////////

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  //require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  //add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}

// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

/* DON'T DELETE THIS CLOSING TAG */ ?>
