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

			<article class="timeline-column flex-shrink-0 w-[460px] flex flex-col items-center opacity-0 translate-y-10" data-index="0">
                <!-- Nodo de la Línea de Tiempo -->
                <div class="timeline-node h-[40px] flex items-center justify-center relative z-20 mb-6">
                    <div class="timeline-dot w-4 h-4 rounded-full border-2 border-[#9B59B6] bg-[#010101] relative flex items-center justify-center">
                        <div class="timeline-dot-inner w-1.5 h-1.5 rounded-full bg-[#9B59B6] opacity-0 transition-all duration-300"></div>
                    </div>
                </div>
                <!-- Tarjeta -->
                <div class="timeline-card w-full p-8 rounded-lg border border-[#9B59B6]/20 bg-[#160f1c]/40 hover:bg-[#160f1c]/70 hover:border-[#9B59B6]/40 backdrop-blur-sm transition-all duration-500 flex flex-col justify-between min-h-[320px]">
                    <div>
                        <div class="flex justify-between items-start gap-4 mb-3">
                            <h2 class="text-xl sm:text-2xl font-bold font-['Space_Grotesk'] leading-tight w-[65%]"><?php echo get_the_title() ?></h2>
                            <span class="text-xs font-['JetBrains_Mono'] text-gray-400 whitespace-nowrap pt-1.5"><?php the_field('fechas') ?></span>
                        </div>
                        <h3 class="text-[#9B59B6] font-['Space_Grotesk'] font-medium mb-6"><?php the_field('establecimiento') ?></h3>
                        <ul class="space-y-3 font-['JetBrains_Mono'] text-xs text-gray-300 leading-relaxed">
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