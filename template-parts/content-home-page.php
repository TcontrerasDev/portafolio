<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portafolio
 */

?>

<section class="hero-content w-full flex flex-col items-center absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-55%] z-10">
    <div class="overflow-hidden">
        <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_url       = '';
        if ( $custom_logo_id ) {
            $logo_image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
            if ( $logo_image ) {
                $logo_url = $logo_image[0];
            }
        }
        if ( ! $logo_url ) {
            $logo_url = 'https://tocontrerasm.laboratoriodiseno.cl/assets/img/Isotipo.png';
        }
        ?>
        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-[240px] opacity-0 scale-90 blur-md hero-logo">
    </div>
    <h1 class="text-[5rem] md:text-[8rem] 2xl:text-[10rem] overflow-hidden py-2 flex items-baseline m-0">
        <span class="inline-block translate-y-full hero-title-text"><?php the_field('span_title_1') ?></span>
        <span class="inline-block scale-0 hero-title-dot text-[#9B59B6] mx-[-0.02em]">.</span>
        <span class="inline-block translate-y-full hero-title-text"><?php the_field('span_title_2') ?></span>
    </h1>
</section>
<section class="flex flex-col gap-[12px] justify-end relative z-20 mb-10">
    <div class="overflow-hidden">
        <h2 class="uppercase text-[#9B59B6] text-[30px] translate-y-full hero-footer-title m-0"><?php the_field('span_subtitle_1') ?></h2>
    </div>
    <div class="overflow-hidden">
        <p class="uppercase text-white text-[16px] md:text-[20px] translate-y-full hero-footer-desc m-0"><?php the_field('span_subtitle_2') ?></p>
    </div>
</section>