<?php
/**
 * mega functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mega
 */

if ( ! function_exists( 'mega_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mega_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mega, use a find and replace
		 * to change 'mega' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mega', get_template_directory() . '/languages' );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mega_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mega_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mega_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mega_content_width', 640 );
}
add_action( 'after_setup_theme', 'mega_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mega_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mega' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mega' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'langblock', 'mega' ),
		'id'            => 'lang-1',
		'description'   => esc_html__( 'Add widgets here.', 'mega' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mega_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
/**
 * Enqueue scripts and styles.
 */
function mega_scripts() {
	global $get_template_directory_uri;
 
//		wp_enqueue_style( 'mega-fancy', $get_template_directory_uri.'/public/libs/@fancyapps/fancybox/jquery.fancybox.min.css' );
		wp_enqueue_style( 'mega-main', $get_template_directory_uri.'/public/css/main.min.css' );
		wp_enqueue_style( 'mega-style', get_stylesheet_uri() );

	// wp_enqueue_script( 'mega-ion.lazy', $get_template_directory_uri . '/public/js/lazy.js', array('jquery'), '20191215', true );



	// wp_enqueue_script( 'mega-vue', $get_template_directory_uri . '/public/libs/vue/vue.min.js', array('jquery'), '20200325', false );
	// wp_enqueue_script( 'mega-app', $get_template_directory_uri . '/public/js/app.js', array('jquery'), '20200325', false );
	// wp_enqueue_script( 'mega-ya',  'https://api-maps.yandex.ru/2.1/?lang=ru_RU', array('jquery'), '20200325', false );
	// wp_enqueue_script( 'mega-tweenmax', $get_template_directory_uri . '/public/js/TweenMax.min.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'mega-rangeslider', $get_template_directory_uri . '/public/libs/ion-rangeslider/js/ion.rangeSlider.min.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'mega-scrollmagic', $get_template_directory_uri . '/public/js/scrollmagic/scrollmagic/minified/ScrollMagic.min.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'mega-gsap', $get_template_directory_uri . '/public/js/scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'mega-picturefill', $get_template_directory_uri . '/public/libs/picturefill/picturefill.min.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'mega-object-fit-images', $get_template_directory_uri . '/public/libs/object-fit-images/ofi.min.js', array('jquery'), '20200325', true );
	wp_enqueue_script( 'mega-Popup', $get_template_directory_uri . '/public/libs/@fancyapps/ui/fancybox.umd.js', array('jquery'), '20200325', true );
	 wp_enqueue_script( 'mega-slider', $get_template_directory_uri . '/public/libs/swiper/swiper-bundle.min.js', array('jquery'), '20200325', true );
	 wp_enqueue_script( 'mega-inputmask', $get_template_directory_uri . '/public/libs/inputmask/inputmask.min.js', array('jquery'), '20200325', true );
	 wp_enqueue_script( 'mega-common', $get_template_directory_uri . '/public/js/common.js', array('jquery'), '20200325', true );
	// // wp_enqueue_script( 'mega-svg4everybody', $get_template_directory_uri . '/public/libs/svg4everybody/svg4everybody.min.js', array('jquery'), '20200325', true );
	// // wp_enqueue_script( 'mega-sticky', $get_template_directory_uri . '/public/libs/hc-sticky/hc-sticky.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'wow', $get_template_directory_uri . '/public/libs/wowjs/wow.min.js', array('jquery'), '20200325', true );
	// wp_enqueue_script( 'mega-sticky', $get_template_directory_uri . '/public/libs/sticky.min.js', array('jquery'), '20200325', true );

	// wp_enqueue_script( 'mega-common', $get_template_directory_uri . '/public/js/common.js', array('jquery'), '20151217', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}




/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/shortcode.php';
// require get_template_directory() . '/inc/woocommerce.php';
// require get_template_directory() . '/inc/menu.php';
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

add_action( 'wp_enqueue_scripts', 'mega_scripts' );
// add_action(  'mega_scripts' );
$get_template_directory_uri=get_template_directory_uri();


function wpb_custom_new_menu() {
//  register_nav_menu('menu-footer',__( 'Footer nav ' ));
//  register_nav_menu('menu-main',__( 'Main nav' ));
//  register_nav_menu('menu-lang',__( 'Lang nav' ));
}

		// This theme uses wp_nav_menu() in one location.
		// register_nav_menus( array(
		// 	'menu-aside' => esc_html__( 'Боковое Меню ', 'lider' ),
		// 	'menu-2' => esc_html__( 'Footer', 'lider' ), 
		// ) );

add_post_type_support( 'page', array('excerpt') );
add_post_type_support( 'single', array('excerpt') );
add_action( 'init', 'wpb_custom_new_menu' );
	
	// add_image_size( 'card-image', 335, 335, true );
	// add_image_size( 'card-image-sm', 200, 200, true );
	// add_image_size( 'tab-lg', 565, 455, true );
	// add_image_size( 'tab-sm', 100, 100, true );
