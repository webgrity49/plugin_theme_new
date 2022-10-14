<?php
echo get_template_directory_uri();
echo "<br>";
echo bloginfo('name');
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PressBook_Masonry_Dark
 */

get_header();
?>

	<div class="pb-content-sidebar u-wrapper">
		<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'single' );
			}

			if ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-title"><span class="screen-reader-text">' .
						esc_html__( 'Previous Post:', 'pressbook-masonry-dark' ) . '</span> %title</span>',
						'next_text' => '<span class="nav-title"><span class="screen-reader-text">' .
						esc_html__( 'Next Post:', 'pressbook-masonry-dark' ) . '</span> %title</span>',
					)
				);

				get_template_part( 'template-parts/related-posts' );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		?>

		</main><!-- #primary -->

		<?php
		get_sidebar( 'left' );
		get_sidebar();
		?>
	</div><!-- .pb-content-sidebar -->

<?php
get_footer();
