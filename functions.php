<?php 



// Register menu

function register_my_menus() {

  register_nav_menus(

    array(

      'header-menu' => __( 'Header Menu' ),

     )

   );

 }

 add_action( 'init', 'register_my_menus' );



// Create taxonomy for Locations

function create_taxonomy(){

    register_taxonomy(

        'location',

        'service',

        array(

            'label' => __('Location'),

            'rewrite' => array( 'slug' => 'location'),

            'hierarchical' => true,

            'show_ui' => true,

            'show_in_menu' => true,

            'show_in_nav_menus' => true,

        )

    );



};

add_action( 'init', 'create_taxonomy' );



 // Create post type for Services

function create_posttype() {

    register_post_type( 'service',

        array(

            'labels' => array(

                'name' => __( 'Services' ),

                'singular_name' => __( 'Service' )

            ),

            'public' => true,

            'has_archive' => true,

            'rewrite' => array('slug' => 'services'),

            'show_in_rest' => true,

            'taxonomies' => [],

 

        )

    );

}

add_action( 'init', 'create_posttype' );



add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

function add_login_logout_link($items, $args) {

    $loginoutlink = wp_loginout('index.php', false);

    $items .= '<li>'. $loginoutlink .'</li>';

    return $items;}

function redirect_users_after_login() {
	wp_redirect( '/test_task' );
        exit;
}

add_action( 'admin_init', 'redirect_users_after_login' );

function onlyregistered_func() {

    if(!is_user_logged_in()) {

     auth_redirect();

    }

   }

   

add_action('get_header', 'onlyregistered_func');



// get user role

function get_user_role($user_id) {

global $wp_roles;

$roles = array();

$user = new WP_User( $user_id );

if ( !empty( $user->roles ) && is_array( $user->roles ) ) {

    foreach ( $user->roles as $role )

		$roles[] .= translate_user_role($wp_roles->roles[$role]['name']);

}

return implode(', ',$roles);

}



 ?>

 