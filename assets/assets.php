<?php

include get_template_directory() . '/assets/includes/fonts-functions.php';
include get_template_directory() . '/assets/includes/css-functions.php';
include get_template_directory() . '/assets/includes/js-functions.php';
include get_template_directory() . '/assets/includes/menu-functions.php';
include get_template_directory() . '/assets/includes/widgets-functions.php';

//No mostrar las entradas de Wordpress
function limpiar_menu_admin() {
    // Ocultar "Entradas" (Blog)
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'limpiar_menu_admin', 999 );

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

if ( ! is_admin() ) {
	/**
	 * Remove speculation rules (Prefetch / Prerender) from the frontend.
	 */
	add_filter( 'wp_speculation_rules_configuration', '__return_null' );

	/**
	 * Remove image auto-sizes inline CSS (wp-img-auto-sizes-contain-inline-css).
	 */
	add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );

	/**
	 * Disable WordPress global styles and block/classic inline styles on the frontend.
	 */
	add_action( 'wp_enqueue_scripts', 'portafolio_remove_inline_styles_early', 1 );
	add_action( 'wp_enqueue_scripts', 'portafolio_dequeue_inline_styles', 9999 );
	add_action( 'wp_print_styles', 'portafolio_dequeue_inline_styles', 9999 );

	/**
	 * Remove Custom Header inline styles from the head on the frontend.
	 * (Keeps customizer settings active in admin).
	 */
	add_action( 'wp_head', 'portafolio_remove_custom_header_callback', 12 );

	/**
	 * Disable WordPress Emojis and the inline emoji styles on the frontend.
	 */
	add_action( 'init', 'portafolio_disable_emojis' );

	/**
	 * Add custom SEO metadata, Open Graph, and Structured JSON-LD Data to wp_head.
	 */
	remove_action( 'wp_head', 'rel_canonical' );
	add_action( 'wp_head', 'portafolio_add_custom_seo_meta' );
}

function portafolio_remove_inline_styles_early() {
	// Remove core action hooks that print or enqueue these styles
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_img_auto_sizes_contain_css_fix' );
	remove_action( 'wp_head', 'wp_print_auto_sizes_contain_css_fix' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
}

function portafolio_dequeue_inline_styles() {
	// Dequeue handles
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'wp-img-auto-sizes-contain' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wp-emoji-styles' );

	// Deregister handles to prevent any output
	wp_deregister_style( 'global-styles' );
	wp_deregister_style( 'wp-img-auto-sizes-contain' );
	wp_deregister_style( 'classic-theme-styles' );
	wp_deregister_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library-theme' );
	wp_deregister_style( 'wp-emoji-styles' );
}

function portafolio_remove_custom_header_callback() {
	remove_action( 'wp_head', 'portafolio_header_style' );
}

function portafolio_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

function portafolio_add_custom_seo_meta() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
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
	}

	if ( ! $logo_url ) {
		$logo_url = 'https://tocontrerasm.laboratoriodiseno.cl/assets/img/Isotipo.png';
	}

	// Dynamic Canonical & OG URL
	$current_url = home_url( '/' );
	if ( is_singular() ) {
		$current_url = get_permalink();
	} else {
		global $wp;
		if ( isset( $wp->request ) ) {
			$current_url = home_url( add_query_arg( array(), $wp->request ) );
		}
	}
	$current_url = esc_url( $current_url );

	// Dynamic Title
	if ( is_front_page() || is_home() ) {
		$seo_title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
	} else {
		$seo_title = get_the_title() . ' | ' . get_bloginfo( 'name' );
	}
	$seo_title = esc_attr( $seo_title );

	// Dynamic Description
	$seo_desc = 'Portafolio profesional de Tomas Contreras. Especialista en desarrollo front-end y diseño UX/UI de alta calidad.';
	if ( is_singular() && has_excerpt() ) {
		$seo_desc = wp_strip_all_tags( get_the_excerpt() );
	} elseif ( is_singular() ) {
		$post = get_post();
		if ( $post && ! empty( $post->post_content ) ) {
			$seo_desc = wp_strip_all_tags( wp_trim_words( $post->post_content, 25 ) );
		}
	}
	$seo_desc = esc_attr( $seo_desc );
	?>
	<meta name="author" content="Tomas Contreras Moya <tcontreras.com@gmail.com>">
	<meta name="description" content="<?php echo $seo_desc; ?>">
	<link rel="canonical" href="<?php echo $current_url; ?>">
	
	<!-- Open Graph / Facebook / Instagram -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo $current_url; ?>">
	<meta property="og:site_name" content="Tomas Contreras Moya | Portafolio">
	<meta property="og:title" content="<?php echo $seo_title; ?>">
	<meta property="og:description" content="<?php echo $seo_desc; ?>">
	<meta property="og:image" content="<?php echo esc_url( $logo_url ); ?>">
	<?php if ( $logo_width && $logo_height ) : ?>
		<meta property="og:image:width" content="<?php echo esc_attr( $logo_width ); ?>">
		<meta property="og:image:height" content="<?php echo esc_attr( $logo_height ); ?>">
	<?php endif; ?>

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:title" content="<?php echo $seo_title; ?>">
	<meta property="twitter:description" content="<?php echo $seo_desc; ?>">
	<meta property="twitter:image" content="<?php echo esc_url( $logo_url ); ?>">

	<!-- Structured Data Schema.org -->
	<script type="application/ld+json">
	{
	  "@context": "https://schema.org",
	  "@type": "Person",
	  "name": "Tomas Contreras Moya",
	  "jobTitle": "Front-End Developer & UX/UI Designer",
	  "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
	  "sameAs": [
		"https://github.com/TcontrerasDev",
		"https://linkedin.com/in/tomas-contreras-6455b332b",
		"https://behance.net/tomascontrer1",
		"https://instagram.com/t0m_ct"
	  ],
	  "address": {
		"@type": "PostalAddress",
		"addressLocality": "Santiago",
		"addressCountry": "CL"
	  }
	}
	</script>
	<?php
}
