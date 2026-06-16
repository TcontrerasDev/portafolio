<?php
/**
 * Loop Proyectos
 *
 * This file renders the list of projects for the custom post type "proyecto".
 * It maps fields to post titles, featured images, and metadata.
 *
 * @package Portafolio
 */

$args = array(
	'post_type'      => 'experiencia',
	'posts_per_page' => -1, // Retrieve all projects
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
);

$proyectos_query = new WP_Query( $args );

if ( $proyectos_query->have_posts() ) :
	$counter = 1;
	while ( $proyectos_query->have_posts() ) :
		$proyectos_query->the_post();
		?>

			<article class="accordion-item border border-[#9B59B6]/20 bg-[#160f1c]/40 rounded-lg overflow-hidden opacity-0 translate-y-10">
				<h2 class="m-0">
					<button id="accordion-header-0" class="accordion-header w-full p-5 text-left flex justify-between items-center gap-4 cursor-pointer focus:outline-none select-none border-0" aria-expanded="false" aria-controls="accordion-content-0">
						<span class="flex flex-col gap-1">
							<span class="text-xs font-['JetBrains_Mono'] text-[#9B59B6]"><?php the_field('fechas') ?> </span>
							<span class="text-lg font-bold font-['Space_Grotesk'] text-white"><?php echo get_the_title() ?></span>
							<span class="text-xs font-['JetBrains_Mono'] text-gray-400"><?php the_field('establecimiento') ?></span>
						</span>
						<i class="fa-solid fa-chevron-down text-[#9B59B6] transition-transform duration-300"></i>
					</button>
				</h2>
				<div id="accordion-content-0" class="accordion-content h-0 overflow-hidden" role="region" aria-labelledby="accordion-header-0">
					<div class="p-5 pt-0 border-t border-[#9B59B6]/10">
						<ul class="space-y-3 font-['JetBrains_Mono'] text-xs text-gray-300 leading-relaxed mt-4">
							<?php
								$get_roles = get_field('roles');
								if ( $get_roles ) {
									foreach ( $get_roles as $rol ) { ?>

									<li class="flex items-start"><span class="text-[#9B59B6] mr-2 flex-shrink-0" aria-hidden="true">▶</span><?php echo $rol['rol'] ?></li>
							
									<?php 
									}
								}
							?>
						</ul>
					</div>
				</div>
			</article>

		<?php
	endwhile;
	wp_reset_postdata();
else :
	?>
	<p class="text-white font-['JetBrains_Mono'] text-sm ps-12">
		<?php esc_html_e( 'No se encontraron experiencias.', 'portafolio' ); ?>
	</p>
	<?php
endif;
