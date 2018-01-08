<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

get_header();

// Start the loop.
while ( have_posts() ) :

	the_post();

	/*
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	get_template_part( 'components/post/content', get_post_format() );

	/*
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/comments_open/
	 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
	 * @link https://developer.wordpress.org/reference/functions/comments_template/
	 */
	if ( 'portfolio' !== get_post_type() && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;

endwhile;

get_footer();
