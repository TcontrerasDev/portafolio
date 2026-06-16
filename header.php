<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Portafolio
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class('bg-[#010101] text-white overflow-x-hidden m-0'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'portafolio' ); ?></a>
	<div class="bg-[#010101f0] absolute inset-0 z-[-1]"></div>
    <div class="luz-hero"></div>

	<header id="masthead" class="container mx-auto px-5 pt-[50px] fixed top-0 z-120">
		<?php// the_custom_logo(); ?>

		<?php if(is_front_page()) { ?>
		<nav id="site-navigation" class="flex items-start justify-end lg:justify-between w-full" aria-label="<?php esc_attr_e( 'Primary', 'portafolio' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'hidden flex-col gap-[15px] lg:flex',
					'walker'         => new Portafolio_Walker_Nav_Menu(),
				)
			);
			?>
			<button id="menu-toggle" class="cursor-pointer z-110" aria-label="Menú principal" aria-expanded="false">
				<svg width="62" height="55" viewBox="0 0 62 55" fill="none" xmlns="http://www.w3.org/2000/svg">
					<line class="line-1" x1="10" y1="23" x2="52.0016" y2="23" stroke="white" stroke-width="5"/>
					<line class="line-2" x1="30.0006" y1="33" x2="52.0015" y2="33" stroke="white" stroke-width="5"/>
				</svg>
			</button>
		</nav>
		<?php } else { ?>
		<nav id="site-navigation-sub" class="flex items-center justify-between w-full" aria-label="<?php esc_attr_e( 'Primary', 'portafolio' ); ?>">
			<div id="logo" class="w-[50px] md:w-[60px]">
				<?php the_custom_logo(); ?>
			</div>
			<button id="menu-toggle" class="cursor-pointer z-110" aria-label="Menú principal" aria-expanded="false">
				<svg width="62" height="55" viewBox="0 0 62 55" fill="none" xmlns="http://www.w3.org/2000/svg">
					<line class="line-1" x1="10" y1="23" x2="52.0016" y2="23" stroke="white" stroke-width="5"/>
					<line class="line-2" x1="30.0006" y1="33" x2="52.0015" y2="33" stroke="white" stroke-width="5"/>
				</svg>
			</button>
		</nav>
		<?php } ?>

	</header><!-- #masthead -->
	<!-- Full-screen Menu Overlay -->
    <div id="full-screen-menu" class="fixed inset-0 bg-[#010101] z-100 hidden flex-col justify-center px-10 md:px-20 opacity-0">
        <div class="menu-luz absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[radial-gradient(circle,rgba(155,89,182,0.15)_0%,transparent_70%)] blur-[60px] pointer-events-none"></div>
        
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center gap-4 md:gap-6 relative z-10">
            <nav id="full-screen-menu-nav" aria-label="<?php esc_attr_e( 'Navegación del menú', 'portafolio' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col gap-6 md:gap-10',
                        'walker'         => new Portafolio_Overlay_Walker_Nav_Menu(),
                    )
                );
                ?>
            </nav>
            <div class="menu-brand-section flex flex-col items-center gap-8 opacity-0 translate-x-10">
					<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo_url       = '';
						$logo_width     = '';
						$logo_height    = '';

						if ( $custom_logo_id ) {
							$logo_image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
							if ( $logo_image ) {
								$logo_url    = $logo_image[0];
								$logo_width  = $logo_image[1];
								$logo_height = $logo_image[2];
							}
					}?>
					<img src="<?php echo esc_html( $logo_url ) ?>" alt="Tom.Dev" class="w-[100px] lg:w-[200px]">
                <div class="text-right">
                    <h2 class="menu-brand-text text-[4rem] lg:text-[6rem] leading-none">Tom<span class="text-[#9B59B6]">.</span>Dev</h2>
                </div>
                <div class="flex gap-6 text-[#9B59B6] text-2xl">
                    <a href="#" class="hover:text-white transition-colors" aria-label="Visitar el perfil de GitHub de Tomás">
                        <i class="fa-brands fa-github" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="hover:text-white transition-colors" aria-label="Visitar el perfil de Behance de Tomás">
                        <i class="fa-brands fa-behance" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="hover:text-white transition-colors" aria-label="Visitar el perfil de LinkedIn de Tomás">
                        <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="hover:text-white transition-colors" aria-label="Visitar el perfil de Instagram de Tomás">
                        <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
