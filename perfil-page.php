<?php
/**
 * Template Name: Perfil
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portafolio
 */

get_header();
?>

	<main id="primary" class="container mx-auto px-4 sm:px-6 lg:px-8 min-h-screen flex items-center justify-center pt-30 pb-8 lg:pt-[130px] lg:pb-10">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'perfil-page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
