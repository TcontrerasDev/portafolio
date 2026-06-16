<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portafolio
 */

?>
<h1 class="sr-only">Proyectos Destacados - Tomas Contreras</h1>
<section class="flex flex-col lg:flex-row items-stretch gap-6 lg:gap-10 w-full profile-card opacity-0 translate-y-10 overflow-hidden">
    <div class="w-full lg:w-[35%] xl:w-[30%] h-[300px] sm:h-[450px] lg:h-auto overflow-hidden">
        <?php 
            $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
            $imgUrl       = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            $imgAlt       = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
            if ( empty( $imgAlt ) ) {
                $imgAlt = 'Fotografía de Tomás Contreras Moya';
            }
        ?>
        <?php if ( $imgUrl ) : ?>
            <img src="<?php echo esc_url( $imgUrl ); ?>" alt="<?php echo esc_attr( $imgAlt ); ?>" class="w-full h-full object-cover profile-img opacity-0 scale-105">
        <?php endif; ?>
    </div>
    <div class="flex flex-col justify-center gap-4 p-6 lg:w-[65%] xl:w-[70%]">
        <h2 class="py-2 text-[32px] sm:text-[40px] lg:text-[48px] leading-tight font-bold overflow-hidden">
            <span class="block translate-y-full profile-name">Tomas Contreras Moya</span>
        </h2>
        <?php the_content() ?>
    </div>
</section>