<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portafolio
 */

?>

<!-- Título de la Sección -->
<div class="text-center mb-8 lg:mb-12 exp-title-container">
    <h1 class="text-center text-[40px] md:text-[48px] overflow-hidden py-1">
        <span class="block translate-y-full exp-title font-bold uppercase font-['Space_Grotesk']"><?php echo get_the_title() ?></span>
    </h1>
    <p class="text-[#9B59B6] font-['JetBrains_Mono'] text-xs uppercase tracking-wider opacity-0 exp-subtitle mt-2"><?php echo get_the_excerpt() ?></p>
</div>

 <!-- LAYOUT ESCRITORIO: Línea de tiempo horizontal slider -->
<section class="timeline-container relative w-full overflow-hidden max-w-[1200px] mx-auto px-16" aria-label="Trayectoria profesional en línea de tiempo" tabindex="0">
    <!-- Flechas de Navegación -->
    <button class="nav-arrow prev-arrow absolute left-0 top-1/2 -translate-y-1/2 z-30 cursor-pointer w-12 h-12 rounded-full border border-[#9B59B6]/40 bg-[#010101]/80 flex items-center justify-center text-[#9B59B6] hover:bg-[#9B59B6] hover:text-white transition-all duration-300" aria-label="Anterior">
        <i class="fa-solid fa-chevron-left text-lg"></i>
    </button>
    <button class="nav-arrow next-arrow absolute right-0 top-1/2 -translate-y-1/2 z-30 cursor-pointer w-12 h-12 rounded-full border border-[#9B59B6]/40 bg-[#010101]/80 flex items-center justify-center text-[#9B59B6] hover:bg-[#9B59B6] hover:text-white transition-all duration-300" aria-label="Siguiente">
        <i class="fa-solid fa-chevron-right text-lg"></i>
    </button>
    
    <!-- Contenedor del Track con Máscara de Desvanecimiento Lateral -->
    <div class="timeline-track-wrapper overflow-hidden w-full py-4">
        <div class="timeline-track flex flex-row items-stretch relative gap-[60px]" style="width: max-content;">
            
            <!-- Línea de Conexión de la Línea de Tiempo -->
            <div class="timeline-line absolute h-[2px] bg-gradient-to-r from-[#9B59B6]/10 via-[#9B59B6]/80 to-[#9B59B6]/10 top-[19px] left-0 pointer-events-none transform origin-left scale-x-0"></div>
            
            <?php include get_template_directory() . '/assets/modulos/exp/loop-exp-desktop.php'; ?>

        </div>
    </div>
</section>

<!-- LAYOUT MÓVIL: Acordeones verticales -->
<section class="accordion-container flex flex-col gap-4 max-w-[600px] mx-auto w-full" aria-label="Trayectoria profesional en formato acordeón">
    
    <?php include get_template_directory() . '/assets/modulos/exp/loop-exp-mobile.php'; ?>
    
</section>