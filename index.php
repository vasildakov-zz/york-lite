<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

get_header();

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :

		the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'components/post/content', get_post_format() );

	endwhile;

	/*
	 * The posts pagination outputs a set of page numbers with links to the previous and next pages of posts.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/the_posts_pagination
	 */
	the_posts_pagination( array(
		'prev_text'          => york_get_svg( array( 'icon' => 'left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'york-lite' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'york-lite' ) . '</span>' . york_get_svg( array( 'icon' => 'right' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'york-lite' ) . ' </span>',
	) );

else :
	get_template_part( 'components/post/content', 'none' );
endif;

get_footer();
