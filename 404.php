<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php echo esc_html__( 'That page can&rsquo;t be found.', 'york-lite' ); ?></h1>
		</header>
		<div class="page-content">
			<p><?php echo esc_html__( 'It looks like nothing was found at this location. Try a search?', 'york-lite' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>

</article>

<?php
get_footer();
