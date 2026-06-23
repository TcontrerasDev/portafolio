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
	'post_type'      => 'proyecto',
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
		<article class="project-item snap-center transition-all duration-500 cursor-pointer" data-id="<?php echo esc_attr( $counter ); ?>" tabindex="0">
			<h2 class="text-[3rem] ps-12 md:text-[5rem] lg:text-[6rem] xl:text-[7rem] font-bold uppercase font-['Space_Grotesk'] leading-none mb-6 w-[95%]">
				<?php echo get_the_title() ?>
			</h2>

			<!-- Details Container (Hidden on desktop, visible on mobile) -->
			<div class="project-details-container min-[1025px]:hidden text-left">
				<article class="border-l-4 lg:border-l border-[#9B59B6] px-5 lg:px-10 relative">
					<h3 class="hidden lg:block text-3xl lg:text-4xl font-bold font-['Space_Grotesk'] mb-2">
						<?php echo get_the_title() ?>
					</h3>
					<p class="text-sm md:text-lg text-[#F39C12] font-['Space_Grotesk'] mb-4 lg:mb-6 tracking-wide">
						<?php echo get_the_excerpt(); ?>
					</p>
					
					<div class="w-full rounded-lg h-[180px] lg:h-[350px] mb-4 lg:mb-6 flex items-center justify-center border border-[#333] overflow-hidden">
						<?php 
                            $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                            $imgUrl       = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                            $imgAlt       = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $imgAlt ) ) {
                                $imgAlt = 'Fotografía de Tomás Contreras Moya';
                            }
                        ?>
                        <?php if ( $imgUrl ) : ?>
                            <img src="<?php echo esc_url( $imgUrl ); ?>" alt="<?php echo esc_attr( $imgAlt ); ?>" class="w-full h-full object-cover">
                        <?php endif; ?>
					</div>

					<div class="font-['JetBrains_Mono'] text-xs lg:text-sm text-gray-300 leading-relaxed mb-4 lg:mb-6 space-y-2 lg:space-y-4">
						<?php the_content(); ?>
					</div>

					<div class="flex gap-6 text-[#9B59B6] text-xl lg:text-2xl">
                        <?php 
                            $get_rrss = get_field('rrss_proyecto');
                            
                            if( $get_rrss ) {
                                foreach ( $get_rrss as $rrss ) {?>

                                    <a href="<?php echo $rrss['enlace_proyecto'] ?>" target="_blank" class="hover:text-white transition-colors" aria-label="<?php echo $rrss['area_label'] ?>"><i class="<?php echo $rrss['seleccionar_icono'] ?>" aria-hidden="true"></i></a>

                                 <?php   
                                }
                            } 
                            ?>
					</div>
				</article>
			</div>
		</article>
		<?php
		$counter++;
	endwhile;
	wp_reset_postdata();
else :
	?>
	<p class="text-white font-['JetBrains_Mono'] text-sm ps-12">
		<?php esc_html_e( 'No se encontraron proyectos.', 'portafolio' ); ?>
	</p>
	<?php
endif;
