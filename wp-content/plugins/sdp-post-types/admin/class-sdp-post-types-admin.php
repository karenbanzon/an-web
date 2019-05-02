<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       karenbanzon.com
 * @since      1.0.0
 *
 * @package    Sdp_Post_Types
 * @subpackage Sdp_Post_Types/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sdp_Post_Types
 * @subpackage Sdp_Post_Types/admin
 * @author     Karen Monica Banzon <kabanzon@gmail.com>
 */
class Sdp_Post_Types_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sdp_Post_Types_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sdp_Post_Types_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sdp-post-types-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sdp_Post_Types_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sdp_Post_Types_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sdp-post-types-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the Custom Post types
	 *
	 * @since    1.0.0
	 */
	
	// Register People Post Type
	function create_people_post_type() {

		$labels = array(
			'name'                  => _x( 'People', 'Post Type General Name', 'anweb' ),
			'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'anweb' ),
			'menu_name'             => __( 'People', 'anweb' ),
			'name_admin_bar'        => __( 'People', 'anweb' ),
			'archives'              => __( 'Item Archives', 'anweb' ),
			'attributes'            => __( 'Item Attributes', 'anweb' ),
			'parent_item_colon'     => __( 'Parent Item:', 'anweb' ),
			'all_items'             => __( 'All Items', 'anweb' ),
			'add_new_item'          => __( 'Add New Item', 'anweb' ),
			'add_new'               => __( 'Add New', 'anweb' ),
			'new_item'              => __( 'New Item', 'anweb' ),
			'edit_item'             => __( 'Edit Item', 'anweb' ),
			'update_item'           => __( 'Update Item', 'anweb' ),
			'view_item'             => __( 'View Item', 'anweb' ),
			'view_items'            => __( 'View Items', 'anweb' ),
			'search_items'          => __( 'Search Item', 'anweb' ),
			'not_found'             => __( 'Not found', 'anweb' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'anweb' ),
			'featured_image'        => __( 'Featured Image', 'anweb' ),
			'set_featured_image'    => __( 'Set featured image', 'anweb' ),
			'remove_featured_image' => __( 'Remove featured image', 'anweb' ),
			'use_featured_image'    => __( 'Use as featured image', 'anweb' ),
			'insert_into_item'      => __( 'Insert into item', 'anweb' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'anweb' ),
			'items_list'            => __( 'Items list', 'anweb' ),
			'items_list_navigation' => __( 'Items list navigation', 'anweb' ),
			'filter_items_list'     => __( 'Filter items list', 'anweb' ),
		);
		$args = array(
			'label'                 => __( 'Person', 'anweb' ),
			'description'           => __( 'People in the organization', 'anweb' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-users',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'people', $args );

	}

	// Register Events Post Type
	function create_events_post_type() {

		$labels = array(
			'name'                  => _x( 'Events', 'Post Type General Name', 'anweb' ),
			'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'anweb' ),
			'menu_name'             => __( 'Events', 'anweb' ),
			'name_admin_bar'        => __( 'Events', 'anweb' ),
			'archives'              => __( 'Item Archives', 'anweb' ),
			'attributes'            => __( 'Item Attributes', 'anweb' ),
			'parent_item_colon'     => __( 'Parent Item:', 'anweb' ),
			'all_items'             => __( 'All Items', 'anweb' ),
			'add_new_item'          => __( 'Add New Item', 'anweb' ),
			'add_new'               => __( 'Add New', 'anweb' ),
			'new_item'              => __( 'New Item', 'anweb' ),
			'edit_item'             => __( 'Edit Item', 'anweb' ),
			'update_item'           => __( 'Update Item', 'anweb' ),
			'view_item'             => __( 'View Item', 'anweb' ),
			'view_items'            => __( 'View Items', 'anweb' ),
			'search_items'          => __( 'Search Item', 'anweb' ),
			'not_found'             => __( 'Not found', 'anweb' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'anweb' ),
			'featured_image'        => __( 'Featured Image', 'anweb' ),
			'set_featured_image'    => __( 'Set featured image', 'anweb' ),
			'remove_featured_image' => __( 'Remove featured image', 'anweb' ),
			'use_featured_image'    => __( 'Use as featured image', 'anweb' ),
			'insert_into_item'      => __( 'Insert into item', 'anweb' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'anweb' ),
			'items_list'            => __( 'Items list', 'anweb' ),
			'items_list_navigation' => __( 'Items list navigation', 'anweb' ),
			'filter_items_list'     => __( 'Filter items list', 'anweb' ),
		);
		$args = array(
			'label'                 => __( 'Event', 'anweb' ),
			'description'           => __( 'Events in the organization', 'anweb' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-calendar-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'events', $args );

	}

	// Register Members Post Type
	function create_members_post_type() {

		$labels = array(
			'name'                  => _x( 'Members', 'Post Type General Name', 'anweb' ),
			'singular_name'         => _x( 'Member', 'Post Type Singular Name', 'anweb' ),
			'menu_name'             => __( 'Member orgs', 'anweb' ),
			'name_admin_bar'        => __( 'Member orgs', 'anweb' ),
			'archives'              => __( 'Item Archives', 'anweb' ),
			'attributes'            => __( 'Item Attributes', 'anweb' ),
			'parent_item_colon'     => __( 'Parent Item:', 'anweb' ),
			'all_items'             => __( 'All Items', 'anweb' ),
			'add_new_item'          => __( 'Add New Item', 'anweb' ),
			'add_new'               => __( 'Add New', 'anweb' ),
			'new_item'              => __( 'New Item', 'anweb' ),
			'edit_item'             => __( 'Edit Item', 'anweb' ),
			'update_item'           => __( 'Update Item', 'anweb' ),
			'view_item'             => __( 'View Item', 'anweb' ),
			'view_items'            => __( 'View Items', 'anweb' ),
			'search_items'          => __( 'Search Item', 'anweb' ),
			'not_found'             => __( 'Not found', 'anweb' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'anweb' ),
			'featured_image'        => __( 'Featured Image', 'anweb' ),
			'set_featured_image'    => __( 'Set featured image', 'anweb' ),
			'remove_featured_image' => __( 'Remove featured image', 'anweb' ),
			'use_featured_image'    => __( 'Use as featured image', 'anweb' ),
			'insert_into_item'      => __( 'Insert into item', 'anweb' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'anweb' ),
			'items_list'            => __( 'Items list', 'anweb' ),
			'items_list_navigation' => __( 'Items list navigation', 'anweb' ),
			'filter_items_list'     => __( 'Filter items list', 'anweb' ),
		);
		$args = array(
			'label'                 => __( 'Member', 'anweb' ),
			'description'           => __( 'Members in the organization', 'anweb' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'members', $args );

	}

	// Register Documents Post Type
	function create_documents_post_type() {

		$labels = array(
			'name'                  => _x( 'Documents', 'Post Type General Name', 'anweb' ),
			'singular_name'         => _x( 'Document', 'Post Type Singular Name', 'anweb' ),
			'menu_name'             => __( 'Documents', 'anweb' ),
			'name_admin_bar'        => __( 'Documents', 'anweb' ),
			'archives'              => __( 'Item Archives', 'anweb' ),
			'attributes'            => __( 'Item Attributes', 'anweb' ),
			'parent_item_colon'     => __( 'Parent Item:', 'anweb' ),
			'all_items'             => __( 'All Items', 'anweb' ),
			'add_new_item'          => __( 'Add New Item', 'anweb' ),
			'add_new'               => __( 'Add New', 'anweb' ),
			'new_item'              => __( 'New Item', 'anweb' ),
			'edit_item'             => __( 'Edit Item', 'anweb' ),
			'update_item'           => __( 'Update Item', 'anweb' ),
			'view_item'             => __( 'View Item', 'anweb' ),
			'view_items'            => __( 'View Items', 'anweb' ),
			'search_items'          => __( 'Search Item', 'anweb' ),
			'not_found'             => __( 'Not found', 'anweb' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'anweb' ),
			'featured_image'        => __( 'Featured Image', 'anweb' ),
			'set_featured_image'    => __( 'Set featured image', 'anweb' ),
			'remove_featured_image' => __( 'Remove featured image', 'anweb' ),
			'use_featured_image'    => __( 'Use as featured image', 'anweb' ),
			'insert_into_item'      => __( 'Insert into item', 'anweb' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'anweb' ),
			'items_list'            => __( 'Items list', 'anweb' ),
			'items_list_navigation' => __( 'Items list navigation', 'anweb' ),
			'filter_items_list'     => __( 'Filter items list', 'anweb' ),
		);
		$args = array(
			'label'                 => __( 'Document', 'anweb' ),
			'description'           => __( 'Documents in Accountable Now', 'anweb' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt'),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-media-default',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'documents', $args );

	}

	// Register Good Practice Library Post Type
	function create_resources_post_type() {

		$labels = array(
			'name'                  => _x( 'Resources', 'Post Type General Name', 'anweb' ),
			'singular_name'         => _x( 'Resource', 'Post Type Singular Name', 'anweb' ),
			'menu_name'             => __( 'Resources', 'anweb' ),
			'name_admin_bar'        => __( 'Resources', 'anweb' ),
			'archives'              => __( 'Item Archives', 'anweb' ),
			'attributes'            => __( 'Item Attributes', 'anweb' ),
			'parent_item_colon'     => __( 'Parent Item:', 'anweb' ),
			'all_items'             => __( 'All Items', 'anweb' ),
			'add_new_item'          => __( 'Add New Item', 'anweb' ),
			'add_new'               => __( 'Add New', 'anweb' ),
			'new_item'              => __( 'New Item', 'anweb' ),
			'edit_item'             => __( 'Edit Item', 'anweb' ),
			'update_item'           => __( 'Update Item', 'anweb' ),
			'view_item'             => __( 'View Item', 'anweb' ),
			'view_items'            => __( 'View Items', 'anweb' ),
			'search_items'          => __( 'Search Item', 'anweb' ),
			'not_found'             => __( 'Not found', 'anweb' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'anweb' ),
			'featured_image'        => __( 'Featured Image', 'anweb' ),
			'set_featured_image'    => __( 'Set featured image', 'anweb' ),
			'remove_featured_image' => __( 'Remove featured image', 'anweb' ),
			'use_featured_image'    => __( 'Use as featured image', 'anweb' ),
			'insert_into_item'      => __( 'Insert into item', 'anweb' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'anweb' ),
			'items_list'            => __( 'Items list', 'anweb' ),
			'items_list_navigation' => __( 'Items list navigation', 'anweb' ),
			'filter_items_list'     => __( 'Filter items list', 'anweb' ),
		);
		$args = array(
			'label'                 => __( 'Resources', 'anweb' ),
			'description'           => __( 'Resources', 'anweb' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt'),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-heart',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'resources', $args );

	}


	// Register taxonomies for custom post types
	public function add_taxonomies_to_custom_types() {
		register_taxonomy_for_object_type( 'category', 'people' );
		register_taxonomy_for_object_type( 'category', 'events' );
		register_taxonomy_for_object_type( 'category', 'members' );
		register_taxonomy_for_object_type( 'category', 'documents' );
		register_taxonomy_for_object_type( 'category', 'resources' );
		register_taxonomy_for_object_type( 'post_tag', 'people' );
		register_taxonomy_for_object_type( 'post_tag', 'events' );
		register_taxonomy_for_object_type( 'post_tag', 'members' );
		register_taxonomy_for_object_type( 'post_tag', 'documents' );
		register_taxonomy_for_object_type( 'post_tag', 'resources' );
	}
}
