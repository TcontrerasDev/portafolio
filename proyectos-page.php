<?php
/**
 * Template Name: Proyectos
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

	<main id="primary" class="container mx-auto px-5 min-[1025px]:h-[calc(100vh-140px)] flex flex-col min-[1025px]:flex-row items-start min-[1025px]:items-center mt-[80px] min-[1025px]:mt-[140px] gap-10">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'proyectos-page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<!-- Indicador de Desplazamiento Móvil -->
	<div id="mobile-scroll-invite" class="fixed bottom-2 left-1/2 -translate-x-1/2 z-50 flex min-[1025px]:hidden items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-[#9B59B6] font-['JetBrains_Mono'] pointer-events-none opacity-80">
		<span>Deslizar para explorar</span>
		<i class="fa-solid fa-chevron-right text-xs animate-bounce-horizontal"></i>
	</div>

<?php
get_footer();
