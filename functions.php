<?php
/**
 * galsUz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package galsUz
 */

setlocale(LC_ALL, pll_current_language('locale')); //'ru_RU.UTF-8');

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.4' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function galsuz_setup() {
	add_filter( 'get_the_archive_title', function( $title ){
		return preg_replace('~^[^:]+: ~', '', $title );
	});

	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on galsUz, use a find and replace
		* to change 'galsuz' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'galsuz', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main' => esc_html__( 'Main menu', 'galsuz' ),
			'mainsecond' => esc_html__( 'Main second', 'galsuz' ),
			'Footer' => esc_html__( 'Footer', 'galsuz' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'galsuz_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
	}
	add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

	function add_menu_link_class( $atts, $item, $args ) {
		if (property_exists($args, 'link_class')) {
			$atts['class'] = $args->link_class;
		}
		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

}
add_action( 'after_setup_theme', 'galsuz_setup' );

/**
 * Get post content by slug.
 *
 * @param string $slug The slug of the post.
 * @return string|null The post content or null if no post is found.
 */
function get_post_content_by_slug($slug) {
    $args = array(
        'name'   => $slug,
        'post_type'   => 'cb',
        'post_status' => 'publish',
        'numberposts' => 1
    );

    $posts = get_posts($args);
    if ($posts) {
        return apply_filters('the_content', $posts[0]->post_content);
    }

    return null;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function galsuz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'galsuz_content_width', 640 );
}
add_action( 'after_setup_theme', 'galsuz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function galsuz_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'galsuz' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'galsuz' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'galsuz_widgets_init' );

function add_type_attribute($tag, $handle, $src) {
	// if not your script, do nothing and return original $tag
	if ( 'galsuz-touch1' !== $handle ) {
			return $tag;
	}
	// change the script tag by adding type="module" and return it.
	$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

// read every js file from get_template_directory_uri() . '/js/components/' and add it with wp_enqueue_script
function galsuz_add_complects() {
	$files = glob(get_template_directory() . '/js/components/*.js');
	foreach ($files as $file) {
		wp_enqueue_script(basename($file));
	}
}

/**
 * Enqueue scripts and styles.
 */
function galsuz_scripts() {
	wp_enqueue_style( 'galsuz-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'galsuz-ymap-style', get_template_directory_uri() . '/assets/css/vue-yandex-maps.css', array(), _S_VERSION );
	wp_enqueue_style( 'galsuz-custom', get_template_directory_uri() . '/custom.css', array(), _S_VERSION );
	wp_enqueue_style( 'galsuz-tns', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css', array(), _S_VERSION );
	wp_style_add_data( 'galsuz-style', 'rtl', 'replace' );

	wp_enqueue_script('jquery');
  wp_enqueue_script("js-cookie", get_template_directory_uri().'/js/js.cookies.min.js', array(), _S_VERSION );
	wp_enqueue_script( 'galsuz-tns-js', get_template_directory_uri() . '/js/tiny-slider.js', array(), _S_VERSION );
	wp_enqueue_script( 'galsuz-vue');
	wp_enqueue_script( 'galsuz-vue-yamaps');
	wp_enqueue_script( 'galsuz-touch');
	wp_enqueue_script( 'galsuz-vue-mask');
	wp_enqueue_script( 'galsuz-custom');

	galsuz_add_complects();

	wp_enqueue_script( 'galsuz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'galsuz_scripts' );

add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page(){
	add_menu_page(
		'Показывать на главной', 'на главной', 'manage_options', 'custompage', 'my_custom_menu_page', 'dashicons-dashboard', 6
	);
}

add_action( 'init', 'register_remote_scripts');
function register_remote_scripts() {
	// wp_register_script( 'galsuz-vue', get_template_directory_uri() . '/js/vue.global.prod.min.js', array(), _S_VERSION, true );
	wp_register_script( 'galsuz-vue', get_template_directory_uri() . '/js/vue.global.js', array(), _S_VERSION, true );
	wp_register_script( 'galsuz-touch', get_template_directory_uri() . '/js/vue3-touch-events.js', array('galsuz-vue'), _S_VERSION, true );
	wp_register_script( 'galsuz-vue-mask', get_template_directory_uri() . '/js/VueTheMask.umd.js', array('galsuz-touch'), _S_VERSION, true );
	wp_register_script( 'galsuz-custom', get_template_directory_uri() . '/js/custom.js', array('galsuz-vue-mask'), _S_VERSION, true );

	$files = glob(get_template_directory() . '/js/components/*.js');
	foreach ($files as $file) {
		wp_register_script(basename($file), get_template_directory_uri() . '/js/components/' . basename($file), array('galsuz-custom'), _S_VERSION, true);
	}
}

add_filter('the_title', function($title) {
	if (preg_match('/wp-admin/', $_SERVER['REQUEST_URI'])) {
		return $title;
	} else {
		return str_replace('_uz', '', $title);
	}
});

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 *  Include Custom post types
 */
if (is_dir(dirname(__FILE__) . '/shortcodes/')) {
  foreach (scandir(dirname(__FILE__) . '/shortcodes/') as $filename) {
    $path = dirname(__FILE__) . '/shortcodes/' . $filename;
    if (is_file($path)) {
      require_once($path);
    }
  }
}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load language popup functionality.
 */
if ( file_exists( dirname( __FILE__ ) . '/inc/language-popup.php' ) ) {
	require_once dirname( __FILE__ ) . '/inc/language-popup.php';
}
