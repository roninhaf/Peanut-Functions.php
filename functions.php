<?php



// ******************* Add Custom Menus ****************** //

add_theme_support( 'menus' );
// navigation menu
register_nav_menus(array(
	'primary' => __('Primary Menu'),
	'mobile' => __('Mobile Menu'),
	'footer' => __('Footer Menu'),
));

// ******************* Add Post Thumbnails ****************** //

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50, true );
add_image_size( 'category-thumb', 300, 9999, true );



// DASHBOARD WELCOME MESSAGE
function custom_dashboard_widget() {
     echo '<p>Bienvenue dans votre panneau d\'administration.</p>
     <p>Si vous avez besoin d\'aide n\'hésitez pas à communiquer avec nous : <a href="borealemedia@gmail.com">borealemedia@gmail.com</a></p>';
}
function add_custom_dashboard_widget() {
     wp_add_dashboard_widget('custom_dashboard_widget', 'Panneau d\'administration', 'custom_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

add_action( 'after_setup_theme', 'setup' );
function setup() {
    // ...
     
    
    add_image_size( 'image-profil', 300, 300, true ); // 400 pixel wide and 200 pixel tall, cropped
     
    // ...
}
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'image-profil' => 'image profil'
        
    );
    return array_merge( $sizes, $custom_sizes );
}



// Fonction qui insere le lien vers le css qui surchargera celui d'origine
function custom_login_css()  {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/design/style-login.css" />';
}
add_action('login_head', 'custom_login_css');


// Enqueuing scipts
function agence_peanut_theme_script_includer( ) {
    wp_enqueue_script( 
    	'scriptV3',
    	get_theme_file_uri( 'js/scriptV3.js' ),
    	array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'agence_peanut_theme_script_includer' );

function agence_peanut_theme_cards_filtering( ) {
    if ( ! is_page( array( 'nos-acteurs', 'nos-mannequins', 'our-actors', 'our-models' )) ) {
    	return;
	}

    wp_enqueue_script( 
        'cardsFilter', 
        get_theme_file_uri('js/cardsFilter.js')
    );
}
add_action( 'wp_enqueue_scripts', 'agence_peanut_theme_cards_filtering' );

?>