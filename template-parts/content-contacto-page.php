<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portafolio
 */

?>
<h1 class="sr-only"><?php echo get_the_title() ?> - Tomas Contreras</h1>
<section class="flex flex-col items-center justify-center gap-[30px] max-w-[45rem] m-auto py-8">

    <h2 class="text-center text-[48px] overflow-hidden py-1">
        <span class="block translate-y-full contact-title"><?php the_field('titulo') ?></span>
    </h2>

    <?php the_content() ?>

    <a href="<?php echo esc_url( 'mailto:' . antispambot( get_field('correo') ) ); ?>" class="text-[#9B59B6] text-center text-[20px] font-['JetBrains_Mono'] pb-[20px] opacity-0 contact-email relative inline-block"><?php echo esc_html( antispambot( get_field('correo' ) ) ); ?></a>
    
    <div class="flex flex-row flex-wrap gap-5 w-full justify-center relative pt-[50px]">
        <div class="absolute top-0 left-0 w-full h-px bg-[#9B59B6] scale-x-0 contact-line origin-center"></div>
        <?php 
            $get_RRSS = get_field('redes');

            if($get_RRSS){
                foreach($get_RRSS as $rrss){ ?>

                <a href="<?php echo $rrss['enlace<'] ?>" class="border border-[#9B59B6] text-white font-['JetBrains_Mono'] py-[15px] px-[20px] opacity-0 translate-y-5 contact-btn hover:text-black transition-colors duration-300 relative overflow-hidden group w-fit" aria-label="Perfil de <?php echo $rrss['nombre'] ?> de Tomas Contreras">
                    <span class="relative z-10"><?php echo $rrss['nombre'] ?></span>
                </a>

                <?php 
                }
            }
        ?>
    </div>
</section>