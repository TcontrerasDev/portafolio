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
        
<!-- Columna Izquierda: Solo escritorio -->
<section class="hidden min-[1025px]:flex w-full min-[1025px]:w-1/2 flex-col justify-center h-full relative z-10 px-10">
    <div id="project-details" class="min-h-[500px] opacity-100">
    </div>
</section>

<!-- Columna Derecha / Flujo Móvil -->
<div class="w-full min-[1025px]:w-1/2 h-auto min-[1025px]:h-[70vh] relative">
	<section class="w-full h-full min-[1025px]:overflow-y-auto min-[1025px]:snap-y min-[1025px]:snap-mandatory scroll-smooth proyectos-scroll" id="project-list" aria-label="Listado de proyectos">
		<!-- Espaciador superior (solo escritorio) -->
		<div class="hidden min-[1025px]:block h-[30vh]"></div>
		<?php
		include get_template_directory() . '/assets/modulos/proyectos/loop-proyectos.php';
		?>

		<!-- Espaciador inferior (solo escritorio) -->
		<div class="hidden min-[1025px]:block h-[30vh]"></div>
	</section>

	<!-- Indicador de Scroll / Scroll Invitation -->
	<span class="scroll-invite hidden min-[1025px]:flex absolute bottom-4 right-0 z-20 items-center gap-2 text-xs font-semibold uppercase tracking-widest text-[#9B59B6] font-['JetBrains_Mono'] pointer-events-none opacity-80 animate-bounce">
		<i class="fa-solid fa-chevron-down text-sm"></i> Deslizar para explorar
	</span>
</div>