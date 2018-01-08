<?php
/**
 * The sidebar containing the flyout widget area.
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

// Add a class if there is no widget area active.
$is_active = ( ! is_active_sidebar( 'sidebar-1' ) ) ? 'no-widget-area' : 'has-widget-area'; ?>

<div id="nav-close" class="nav-close-overlay"></div>

<aside id="secondary" class="sidebar <?php echo esc_attr( $is_active ); ?>">

	<div class="hamburger mobile-menu-toggle close-toggle">
		<div class="hamburger-box">
			<div class="hamburger-inner"></div>
		</div>
	</div>

	<div class="sidebar--section">

		<div class="sidebar--section-inner">

			<nav id="site-navigation" class="main-navigation nav primary" aria-label="<?php esc_attr_e( 'Primary Menu', 'york-lite' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu',
						'depth'          => '0',
						'link_before'    => '<span>',
						'link_after'     => '</span>',
						'walker'         => new YorkClassMobileNavigationWalker(),
					)
				);
				?>
			</nav>

		</div>

	</div>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="sidebar--section widget-area">
			<div class="sidebar--section-inner">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>
		</div>
	<?php endif; ?>

</aside>
