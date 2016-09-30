<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

get_header();

$img = get_custom_header();
$img = $img->url;

if ( ! empty( $img ) ): ?>
	<div class="newsmag-custom-header" style="background-image:url(<?php echo $img ?>)">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-title"><span><?php single_post_title(); ?></span></h2>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
	<div class="container">
		<?php
		$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', 'breadcrumbs_enabled' );
		if ( $breadcrumbs_enabled == 'breadcrumbs_enabled' ) { ?>
			<div class="row">
				<div class="col-xs-12">
					<?php newsmag_breadcrumbs(); ?>
				</div>
			</div>
		<?php } ?>

		<div class="row">
			<?php
			$layout = get_theme_mod( 'newsmag_blog_layout', 'right-sidebar' ); ?>

			<?php if ( $layout === 'left-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>

			<div id="primary"
			     class="newsmag-content newsmag-archive-page <?php echo ( $layout === 'fullwidth' ) ? '' : 'col-lg-8 col-md-8'; ?> col-sm-12 col-xs-12">
				<main id="main" class="site-main" role="main">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

					endif;
					?>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php if ( $layout === 'right-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>

		</div>
		<?php newsmag_numeric_posts_nav(); ?>
	</div>
<?php
get_footer();

