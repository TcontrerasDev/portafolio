<?php
/*customizar la clase y el link del logo de wordpress*/
function add_class_to_custom_logo() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = sprintf( '<a href="%1$s" aria-label="Navegación principal" rel="home" itemprop="url">%2$s</a>',
    esc_url( home_url( '/' ) ),
    wp_get_attachment_image( $custom_logo_id, 'full', false, array(
    'class' => 'w-28',
    ) )
    );
    return $html;
    }
    add_filter( 'get_custom_logo', 'add_class_to_custom_logo' );
/*customizar la clase y el link del logo de wordpress*/


//Crear Menú
// if (!function_exists('menu_offcanvas')) {

//     // Register Navigation Menus
//     function menu_offcanvas()
//     {

//         $locations = array(
//             'menu-offcanvas' => __('menu-offcanvas', 'menu-offcanvas'), //Nombre - Ubicación - id
//         );
//         register_nav_menus($locations);
//     }
//     add_action('init', 'menu_offcanvas');
// }



/*clases para li item */
// function atg_menu_classes($classes, $item, $args)
// {
//     if ($args->theme_location == 'menu-footer') {
//         $classes[] = 'nav-item';
//     }
//     return $classes;
// }
// add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

/**
 * Custom Walker to render navigation links with 2-digit numbers and stylized classes.
 */
class Portafolio_Walker_Nav_Menu extends Walker_Nav_Menu {
	private $item_number = 0;

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$this->item_number++;
		$formatted_number = sprintf( '%02d', $this->item_number );

		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		if ( $item->current ) {
			$atts['aria-current'] = 'page';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= '<span class="menu-link-number font-[\'JetBrains_Mono\'] text-white">' . esc_html( $formatted_number ) . '</span> ';
		$item_output .= '<span class="menu-link-fill uppercase text-[#9B59B6] font-[\'JetBrains_Mono\']">' . $args->link_before . $title . $args->link_after . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom Walker to render the Overlay navigation links with 2-digit numbers and animation classes.
 */
class Portafolio_Overlay_Walker_Nav_Menu extends Walker_Nav_Menu {
	private $item_number = 0;

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$this->item_number++;
		$formatted_number = sprintf( '%02d', $this->item_number );

		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		// Add GSAP entrance animation classes
		$classes[]   = 'opacity-0';
		$classes[]   = 'translate-y-10';
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		// Add custom classes for overlay links
		$atts['class']  = 'group flex items-center gap-6 font-[\'JetBrains_Mono\'] text-[2.5rem] md:text-[3rem] ld:text-[4rem] xl:text-[5rem] font-bold uppercase';

		if ( $item->current ) {
			$atts['aria-current'] = 'page';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= '<span class="menu-link-number">' . esc_html( $formatted_number ) . '</span>';
		$item_output .= '<span class="menu-link-fill">' . $args->link_before . $title . $args->link_after . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}