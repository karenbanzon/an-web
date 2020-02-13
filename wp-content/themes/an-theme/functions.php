<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts() {
wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'blankslate_footer_scripts' );
function blankslate_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'blankslate_document_title_separator' );
function blankslate_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'blankslate_image_insert_override' );
function blankslate_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'blankslate_pingback_header' );
function blankslate_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function blankslate_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comment_count', 0 );
function blankslate_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

add_post_type_support( 'page', 'excerpt' );
add_filter( 'use_default_gallery_style', '__return_false' );

/* Make editor wider */
function custom_admin_css() {
	echo '<style type="text/css">
	.wp-block { max-width: 100%; }
	</style>';
	}
add_action('admin_head', 'custom_admin_css');

/**
 * Members Metadata
 */
class Members_Meta_Box {
	private $screens = array(
		'members',
	);
	private $fields = array(
		array(
			'id' => 'site-url',
			'label' => 'Site URL',
			'type' => 'url',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'member-details',
				__( 'Member Details', 'members-metabox' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'normal',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'member_details_data', 'member_details_nonce' );
		echo 'Extra details for members';
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'member_details_' . $field['id'], true );
			switch ( $field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['member_details_nonce'] ) )
			return $post_id;

		$nonce = $_POST['member_details_nonce'];
		if ( !wp_verify_nonce( $nonce, 'member_details_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'member_details_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'member_details_' . $field['id'], '0' );
			}
		}
	}
}
new Members_Meta_Box;

/**
 * People Metadata
 */
class People_Meta_Box {
	private $screens = array(
		'people',
	);
	private $fields = array(
    array(
			'id' => 'title',
			'label' => 'Title / job description',
			'type' => 'etxt',
    ),
    array(
			'id' => 'title-secondary',
			'label' => 'Secondary title / job description',
			'type' => 'email',
		),
    array(
			'id' => 'email-address',
			'label' => 'Email address',
			'type' => 'email',
		),
		array(
			'id' => 'linkedin-url',
			'label' => 'LinkedIn URL',
			'type' => 'url',
		),
		array(
			'id' => 'phone',
			'label' => 'Phone',
			'type' => 'tel',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'people-details',
				__( 'People Details', 'people-metabox' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'normal',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'people_details_data', 'people_details_nonce' );
		echo 'Extra details for people';
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'people_details_' . $field['id'], true );
			switch ( $field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['people_details_nonce'] ) )
			return $post_id;

		$nonce = $_POST['people_details_nonce'];
		if ( !wp_verify_nonce( $nonce, 'people_details_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'people_details_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'people_details_' . $field['id'], '0' );
			}
		}
	}
}
new People_Meta_Box;

/**
 * Documents Metadata
 */
class Documents_Meta_Box {
	private $screens = array(
		'documents',
	);
	private $fields = array(
		array(
			'id' => 'file',
			'label' => 'File',
			'type' => 'media',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'document-details',
				__( 'Document Details', 'documents-metabox' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'normal',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'document_details_data', 'document_details_nonce' );
		echo 'More details about the document';
		$this->generate_fields( $post );
	}

	/**
	 * Hooks into WordPress' admin_footer function.
	 * Adds scripts for media uploader.
	 */
	public function admin_footer() {
		?><script>
			// https://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.rational-metabox-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$("#"+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'document_details_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input class="regular-text" id="%s" name="%s" type="text" value="%s"> <input class="button rational-metabox-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$field['id'],
						$field['id'],
						$db_value,
						$field['id'],
						$field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['document_details_nonce'] ) )
			return $post_id;

		$nonce = $_POST['document_details_nonce'];
		if ( !wp_verify_nonce( $nonce, 'document_details_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'document_details_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'document_details_' . $field['id'], '0' );
			}
		}
	}
}
new Documents_Meta_Box;


/* Add Events metadata */

function events_metaboxes() {
	add_meta_box( 'an_event_date_start', 'Start Date and Time', 'an_event_date', 'events', 'normal', 'default', array( 'id' => '_start') );
	add_meta_box( 'an_event_date_end', 'End Date and Time', 'an_event_date', 'events', 'normal', 'default', array('id'=>'_end') );
	add_meta_box( 'an_event_location', 'Event Location', 'an_event_location', 'events', 'normal', 'default', array('id'=>'_end') );
}
add_action( 'admin_init', 'events_metaboxes' );

// Metabox HTML

function an_event_date($post, $args) {
	$metabox_id = $args['args']['id'];
	global $post, $wp_locale;

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );

	$time_adj = current_time( 'timestamp' );
	$month = get_post_meta( $post->ID, $metabox_id . '_month', true );

	if ( empty( $month ) ) {
			$month = gmdate( 'm', $time_adj );
	}

	$day = get_post_meta( $post->ID, $metabox_id . '_day', true );

	if ( empty( $day ) ) {
			$day = gmdate( 'd', $time_adj );
	}

	$year = get_post_meta( $post->ID, $metabox_id . '_year', true );

	if ( empty( $year ) ) {
			$year = gmdate( 'Y', $time_adj );
	}

	$hour = get_post_meta($post->ID, $metabox_id . '_hour', true);

	if ( empty($hour) ) {
			$hour = gmdate( 'H', $time_adj );
	}

	$min = get_post_meta($post->ID, $metabox_id . '_minute', true);

	if ( empty($min) ) {
			$min = '00';
	}

	$month_s = '<select name="' . $metabox_id . '_month">';
	for ( $i = 1; $i < 13; $i = $i +1 ) {
			$month_s .= "\t\t\t" . '<option value="' . zeroise( $i, 2 ) . '"';
			if ( $i == $month )
					$month_s .= ' selected="selected"';
			$month_s .= '>' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) . "</option>\n";
	}
	$month_s .= '</select>';

	echo $month_s;
	echo '<input type="text" name="' . $metabox_id . '_day" value="' . $day  . '" size="2" maxlength="2" />';
	echo '<input type="text" name="' . $metabox_id . '_year" value="' . $year . '" size="4" maxlength="4" /> @ ';
	echo '<input type="text" name="' . $metabox_id . '_hour" value="' . $hour . '" size="2" maxlength="2"/>:';
	echo '<input type="text" name="' . $metabox_id . '_minute" value="' . $min . '" size="2" maxlength="2" />';

}

function an_event_location() {
	global $post;
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );
	// The metabox HTML
	$event_location = get_post_meta( $post->ID, '_event_location', true );
	echo '<label for="_event_location">Location:</label>';
	echo '<input type="text" name="_event_location" value="' . $event_location  . '" />';
}

// Save the Metabox Data

function ep_eventposts_save_meta( $post_id, $post ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

	if ( !isset( $_POST['ep_eventposts_nonce'] ) )
			return;

	if ( !wp_verify_nonce( $_POST['ep_eventposts_nonce'], plugin_basename( __FILE__ ) ) )
			return;

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ) )
			return;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though

	$metabox_ids = array( '_start', '_end' );

	foreach ($metabox_ids as $key ) {
			$events_meta[$key . '_month'] = $_POST[$key . '_month'];
			$events_meta[$key . '_day'] = $_POST[$key . '_day'];
					if($_POST[$key . '_hour']<10){
							 $events_meta[$key . '_hour'] = '0'.$_POST[$key . '_hour'];
					 } else {
								 $events_meta[$key . '_hour'] = $_POST[$key . '_hour'];
					 }
			$events_meta[$key . '_year'] = $_POST[$key . '_year'];
			$events_meta[$key . '_hour'] = $_POST[$key . '_hour'];
			$events_meta[$key . '_minute'] = $_POST[$key . '_minute'];
			$events_meta[$key . '_eventtimestamp'] = $events_meta[$key . '_year'] . $events_meta[$key . '_month'] . $events_meta[$key . '_day'] . $events_meta[$key . '_hour'] . $events_meta[$key . '_minute'];
	}

	$events_meta['_event_location'] = $_POST['_event_location'];

	// Add values of $events_meta as custom fields

	foreach ( $events_meta as $key => $value ) { // Cycle through the $events_meta array!
			if ( $post->post_type == 'revision' ) return; // Don't store custom data twice
			$value = implode( ',', (array)$value ); // If $value is an array, make it a CSV (unlikely)
			if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
					update_post_meta( $post->ID, $key, $value );
			} else { // If the custom field doesn't have a value
					add_post_meta( $post->ID, $key, $value );
			}
			if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
	}

}

add_action( 'save_post', 'ep_eventposts_save_meta', 1, 2 );

/**
* Helpers to display the date on the front end
*/

// Get the Month Abbreviation

function eventposttype_get_the_month_abbr($month) {
	global $wp_locale;
	for ( $i = 1; $i < 13; $i = $i +1 ) {
							if ( $i == $month )
									$monthabbr = $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
							}
	return $monthabbr;
}

// Display the date

function eventposttype_get_the_event_date() {
	global $post;
	$eventdate = '';
	$month = get_post_meta($post->ID, '_month', true);
	$eventdate = eventposttype_get_the_month_abbr($month);
	$eventdate .= ' ' . get_post_meta($post->ID, '_day', true) . ',';
	$eventdate .= ' ' . get_post_meta($post->ID, '_year', true);
	$eventdate .= ' at ' . get_post_meta($post->ID, '_hour', true);
	$eventdate .= ':' . get_post_meta($post->ID, '_minute', true);
	echo $eventdate;
}


// Add webinar filter
add_action('wp_ajax_filter_webinar', 'an_filter_webinar'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filter_webinar', 'an_filter_webinar');
 
function an_filter_webinar(){
	$primaryCategorySlug = 'webinar';
	$primaryCategoryObj = get_category_by_slug($primaryCategorySlug);
	$primaryCategoryId = $primaryCategoryObj->term_id;

	$memberOrgCategoryId = $_POST['member_cat'];
	$topicCategoryId = $_POST['topic_cat'];
 
	// if both member org and topic are set
	if( isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != ""  ) {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'category__and' => array($_POST['member_cat'], $_POST['topic_cat'], $primaryCategoryId),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "") || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] = "") ) {
		// if only member org is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'category__and' => array($_POST['member_cat'], $primaryCategoryId),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['topic_cat'] ) && $_POST['topic_cat']) || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] = "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != "") ) {
		// if only topic is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'category__and' => array($_POST['topic_cat'], $primaryCategoryId),
			'posts_per_page' => -1
		);
	} else {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'cat' => $primaryCategoryId,
			'posts_per_page' => -1
		);
	}
 
	$query = new WP_Query( $args );
 
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
			echo '<div class="w-full md-1/2 lg:w-1/4 p-6 hover:shadow">';
			echo '<a href="';
			echo the_permalink();
			echo '">';
			if ( has_post_thumbnail() ) { 
				echo '<div class="bg-cover bg-center mb-2" style="background-image:url(';
				echo the_post_thumbnail_url();
				echo '); height: 200px;">';
				echo '</div>';
			}
			echo '<h4 class="text-black">';
			echo the_title();
			echo '</h4>';
			
			$post_meta = get_post_meta( get_the_ID() );
			echo '<small class="text-grey">';
			echo $post_meta['_start_day'][0] . '.' . $post_meta['_start_month'][0] . '.' . $post_meta['_start_year'][0];
			echo '</small>';
			echo '<br>';
			echo '<small class="text-grey">';
			echo $post_meta['_event_location'][0];
			echo '</small></a></div>';
		endwhile;
		wp_reset_postdata();
	else :
		include('not-found.php');
	endif;
 
	die();
}

// Add workshop filter
add_action('wp_ajax_filter_workshop', 'an_filter_workshop'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filter_workshop', 'an_filter_workshop');
 
function an_filter_workshop(){
	$primaryCategorySlug = 'workshop';
	$primaryCategoryObj = get_category_by_slug($primaryCategorySlug);
	$primaryCategoryId = $primaryCategoryObj->term_id;

	$memberOrgCategoryId = $_POST['member_cat'];
	$topicCategoryId = $_POST['topic_cat'];
 
	// if both member org and topic are set
	if( isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != ""  ) {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'category__and' => array($_POST['member_cat'], $_POST['topic_cat'], $primaryCategoryId),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "") || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] = "") ) {
		// if only member org is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'category__and' => array($_POST['member_cat'], $primaryCategoryId),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['topic_cat'] ) && $_POST['topic_cat']) || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] = "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != "") ) {
		// if only topic is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'category__and' => array($_POST['topic_cat'], $primaryCategoryId),
			'posts_per_page' => -1
		);
	} else {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'events',
			'cat' => $primaryCategoryId,
			'posts_per_page' => -1
		);
	}
 
	$query = new WP_Query( $args );
 
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
			echo '<div class="w-full lg:w-1/3 p-6 hover:shadow">';
			echo '<a href="';
			echo the_permalink();
			echo '">';
			if ( has_post_thumbnail() ) { 
				echo '<div class="bg-cover bg-center mb-2" style="background-image:url(';
				echo the_post_thumbnail_url();
				echo '); height: 200px;">';
				echo '</div>';
			}
			echo '<h4 class="text-black">';
			echo the_title();
			echo '</h4>';
			
			$post_meta = get_post_meta( get_the_ID() );
			echo '<small class="text-grey">';
			echo $post_meta['_start_day'][0] . '.' . $post_meta['_start_month'][0] . '.' . $post_meta['_start_year'][0];
			echo '</small>';
			echo '<br>';
			echo '<small class="text-grey">';
			echo $post_meta['_event_location'][0];
			echo '</small></a></div>';
		endwhile;
		wp_reset_postdata();
	else :
		include('not-found.php');
	endif;
 
	die();
}


// Add resource filter
add_action('wp_ajax_filter_resource', 'an_filter_resource'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filter_resource', 'an_filter_resource');
 
function an_filter_resource(){
	$memberOrgCategoryId = $_POST['member_cat'];
	$topicCategoryId = $_POST['topic_cat'];

	// if both member org and topic are set
	if( isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != ""  ) {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'resources',
			'category__and' => array($_POST['member_cat'], $_POST['topic_cat']),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "") || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] = "") ) {
		// if only member org is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'resources',
			'category__and' => array($_POST['member_cat']),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['topic_cat'] ) && $_POST['topic_cat']) || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] = "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != "") ) {
		// if only topic is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'resources',
			'category__and' => array($_POST['topic_cat']),
			'posts_per_page' => -1
		);
	} else {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'resources',
			'posts_per_page' => -1
		);
	}
 
	$resources = new WP_Query( $args );

	$temp_query = $wp_query;
	$wp_query   = NULL;
	$wp_query   = $resources;
 
	if( $resources->have_posts() ) :
		while( $resources->have_posts() ): $resources->the_post();

			$topics = get_category_by_slug( 'topics' );
			$members = get_category_by_slug( 'members' );

			$post_topics = wp_get_post_categories(
				get_the_ID(),
				array(
					'exclude' => [$topics->term_id],
					'exclude_tree' => [$members->term_id]
				)
			);
			$cats = array();
					
			foreach($post_topics as $c){
					$cat = get_category( $c );
					$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
			}

			$post_members = wp_get_post_categories(
				get_the_ID(),
				array(
					'exclude' => [$members->term_id],
					'exclude_tree' => [$topics->term_id]
				)
			);
			$mems = array();
					
			foreach($post_members as $m){
					$mem = get_category( $m );
					$mems[] = array( 'name' => $mem->name, 'slug' => $mem->slug, 'id' => $mem->term_id );
			}

			echo '<a href="<?php the_permalink() ?>"" class="w-full lg:w-1/3 md:w-1/2 flex flex-wrap content-start items-center hover:shadow p-6">';
      echo '<div class="w-full p-4">';
			echo '<h2 class="text-black hover:text-anblue">';
			echo the_title();
			echo '</h2><div class="pt-4">';
      if ($mems[0]['name']) {
				$args = array(
					'numberposts' => 1,
					'category' => $mems[0]['id'],
					'post_type' => 'members'
				);

				$currentOrg = get_posts($args);
        if ( get_the_post_thumbnail_url($currentOrg[0]->ID) ) {
					echo '<img class="w-16" src="';
					echo get_the_post_thumbnail_url($currentOrg[0]->ID);
					echo '" alt="';
					echo $currentOrg[0]->post_title;
					echo '">';
					} else {
						echo '<span class="inline-block align-middle text-grey text-sm py-2">';
						echo $currentOrg[0]->post_title;
						echo '</span>';
					}
				}
      	echo '</div>';
				echo '<p class="text-grey-darker text-sm mt-2">';
				echo esc_html( get_the_excerpt() );
				echo '</p><span class="text-grey text-sm">Topics:</span><div>';
        foreach($cats as $cat) {
					echo '<span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">';
					echo $cat['name'];
					echo '</span>';
        }
        echo '</div></div></a>';
		endwhile;
		wp_reset_postdata();
	else :
		include('not-found.php');

	$wp_query = NULL;
	$wp_query = $temp_query;
	endif;
 
	die();
}

// Add general filter
add_action('wp_ajax_filter_general', 'an_filter_general'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filter_general', 'an_filter_general');
 
function an_filter_general(){
	$memberOrgCategoryId = $_POST['member_cat'];
	$topicCategoryId = $_POST['topic_cat'];

	// if both member org and topic are set
	if( isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != ""  ) {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => array('resources', 'events'),
			'category__and' => array($_POST['member_cat'], $_POST['topic_cat']),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "") || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] != "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] = "") ) {
		// if only member org is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => array('resources', 'events'),
			'category__and' => array($_POST['member_cat']),
			'posts_per_page' => -1
		);
	} else if ( (isset( $_POST['topic_cat'] ) && $_POST['topic_cat']) || (isset( $_POST['member_cat'] ) && $_POST['member_cat'] = "" && isset( $_POST['topic_cat'] ) && $_POST['topic_cat'] != "") ) {
		// if only topic is set
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => array('resources', 'events'),
			'category__and' => array($_POST['topic_cat']),
			'posts_per_page' => -1
		);
	} else {
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => array('resources', 'events'),
			'posts_per_page' => -1
		);
	}
 
	$generalQuery = new WP_Query( $args );

	$temp_query = $wp_query;
	$wp_query   = NULL;
	$wp_query   = $generalQuery;
 
	if( $generalQuery->have_posts() ) :
		while( $generalQuery->have_posts() ): $generalQuery->the_post();

			echo '<a href="';
			echo the_permalink();
			echo '" class="w-full flex flex-wrap content-start items-center hover:shadow p-2">';
			echo '<div class="w-1/4 p-4">';
			if ( has_post_thumbnail() ) {
				echo '<img src="';
				echo the_post_thumbnail_url();
				echo '" alt="';
				echo the_title();
				echo '">';
			}
			echo '</div>';
			echo '<div class="w-3/4 p-4">';
			if ( has_category('webinar') ) {
				echo '<span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">Webinar</span>';
			} else if ( has_category('workshop') ) {
				echo '<span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">Workshop</span>';
			} else if ( get_post_type() == 'resources' ) {
				echo '<span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">Good Practice Library</span>';
			}
			echo '<h2 class="text-black hover:text-anblue">';
			echo the_title();
			echo '</h2>';
			echo '</div>';
			echo '</a>';

		endwhile;

		wp_reset_postdata();
	else :
		include('not-found.php');

	$wp_query = NULL;
	$wp_query = $temp_query;
	endif;
 
	die();
}