<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

/**
 * York Lite only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_parent_theme_file_path( '/inc/back-compat.php' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function york_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on York, use a find and replace
	 * to change 'york-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'york-lite', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter York's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'york-featured-image', 9999, 9999, false );

	add_image_size( 'york-portfolio-full', 9999, 9999, false );

	add_image_size( 'york-portfolio-thumbnail', 9999, 9999 );

	// Set the default content width.
	$GLOBALS['content_width'] = 700;

	/*
	 * This theme uses wp_nav_menu() in the following locations.
	 */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'york-lite' ),
		'footer'  => esc_html__( 'Footer Menu', 'york-lite' ),
		'social'  => esc_html__( 'Social Menu', 'york-lite' ),
	) );

	/*
	 * Switch default core yorkup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'image',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', york_fonts_url() ) );

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 300,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Define starter content for the theme.
	 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
	 */
	$starter_content = array(
		'posts'       => array(
			'home',
			'about',
			'contact',
			'blog',
		),

		'attachments' => array(
			'logo' => array(
				'post_title' => _x( 'Logo', 'Theme starter content', 'york-lite' ),
				'file'       => 'inc/customizer/images/logo.png',
			),
		),

		'options'     => array(
			'show_on_front'   => 'page',
			'page_on_front'   => '{{home}}',
			'blogdescription' => _x( 'A WordPress theme by ThemeBeans', 'Theme starter content', 'york-lite' ),
			'page_for_posts'  => '{{blog}}',
		),

		'theme_mods'  => array(
			'site_logo' => '{{image-logo}}',
		),

		'nav_menus'   => array(

			'primary' => array(
				'name'  => esc_html__( 'Primary', 'york-lite' ),
				'items' => array(
					'page_home',
					'page_about',
				),
			),

			'footer'  => array(
				'name'  => esc_html__( 'Footer', 'york-lite' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_contact',
				),
			),

			'social'  => array(
				'name'  => esc_html__( 'Social Menu', 'york-lite' ),
				'items' => array(
					'link_twitter',
					'link_instagram',
					'link_facebook',
				),
			),
		),
	);

	/**
	 * Filters York Lite array of starter content.
	 *
	 * @since York Lite 1.0
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'york_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

}

add_action( 'after_setup_theme', 'york_setup' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string|string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function york_front_page_template( $template ) {

	// Let's only use the front-page.php file if the Portfolio Post Type is present.
	if ( ! post_type_exists( 'portfolio' ) ) {
		return;
	}

	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'york_front_page_template' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function york_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'york_content_width', 644 );
}
add_action( 'after_setup_theme', 'york_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function york_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Flyout', 'york-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears on the theme flyout sidebar.', 'york-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'york-lite' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Appears at the top of the site footer.', 'york-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'york_widgets_init' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function york_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js');})(document.documentElement);</script>\n";
}
add_action( 'wp_enqueue_scripts', 'york_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function york_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'york-fonts', york_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'york-style', get_stylesheet_uri() );

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Scripts.
	wp_enqueue_script( 'york-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery', 'masonry', 'imagesloaded' ), '1.1.0', true );
	wp_enqueue_script( 'york-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.1.0', true );

	// Translations in the custom functions.
	$translation_array = array(
		'york_comment' => esc_html__( 'Write a comment . . .', 'york-lite' ),
		'york_author'  => esc_html__( 'Name', 'york-lite' ),
		'york_email'   => esc_html__( 'email@address.com', 'york-lite' ),
	);

	wp_localize_script( 'york-global', 'york_translation', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'york_scripts' );

/**
 * Register custom fonts.
 * Based on the function from Twenty Seventeen.
 */
function york_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Playfair Display, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$playfair_display = esc_html_x( 'on', 'Playfair Display font: on or off', 'york-lite' );

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$lora = esc_html_x( 'on', 'Lora font: on or off', 'york-lite' );

	if ( 'off' !== $playfair_display && 'off' !== $lora ) {
		$font_families = array();

		if ( 'off' !== $playfair_display ) {
			$font_families[] = 'Playfair Display:400,400i,700,700i';
		}

		if ( 'off' !== $lora ) {
			$font_families[] = 'Lora:400,400i,700,700i';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array         $urls           URLs to print for resource hints.
 * @param  string|string $relation_type  The relation type the URLs are printed.
 * @return array         $urls           URLs to print for resource hints.
 */
function york_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'york-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}

add_filter( 'wp_resource_hints', 'york_resource_hints', 10, 2 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function york_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}

add_action( 'wp_head', 'york_pingback_header' );

/**
 * Replaces the excerpt more link.
 *
 * @param string|string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function york_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'york-lite' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'york_excerpt_more' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function york_modify_read_more_link() {

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'york-lite' ), get_the_title( get_the_ID() ) )
	);
	return $link;
}
add_filter( 'the_content_more_link', 'york_modify_read_more_link' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_theme_file_path( '/inc/jetpack.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Load the TGMPA class.
 */
require get_parent_theme_file_path( '/inc/plugins.php' );
