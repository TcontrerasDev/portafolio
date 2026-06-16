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

	<main id="primary" class="container mx-auto px-5 min-[1025px]:h-[calc(100vh-140px)] flex flex-col min-[1025px]:flex-row items-start min-[1025px]:items-center mt-[40px] min-[1025px]:mt-[140px] gap-10">

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

	<!-- Controles de navegación móvil -->
    <div id="mobile-proj-nav" class="fixed right-5 bottom-12 z-50 flex flex-col min-[1025px]:hidden items-center gap-4 bg-[#010101]/80 border border-[#9B59B6]/40 px-2 py-4 rounded-full backdrop-blur-md shadow-lg shadow-[#000]/80">
        <button id="mobile-prev-btn" class="text-white hover:text-[#9B59B6] transition-colors disabled:opacity-20 disabled:pointer-events-none cursor-pointer p-1" aria-label="Proyecto anterior">
            <i class="fa-solid fa-chevron-up text-lg"></i>
        </button>
        <span id="mobile-proj-counter" class="font-['JetBrains_Mono'] text-xs font-bold tracking-wider text-[#9B59B6] my-1">1/3</span>
        <button id="mobile-next-btn" class="text-white hover:text-[#9B59B6] transition-colors disabled:opacity-20 disabled:pointer-events-none cursor-pointer p-1" aria-label="Proyecto siguiente">
            <i class="fa-solid fa-chevron-down text-lg"></i>
        </button>
    </div>

<?php
get_footer();
