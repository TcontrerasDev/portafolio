<?php 

function preconnect_google_fonts( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'preconnect_google_fonts', 10, 2 );

function fonts_functions() {

    //Register

    wp_register_style('fonts', 'https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet', array(), '', 'all');

    //Enqueue

    wp_enqueue_style('fonts');
}

add_action('wp_enqueue_scripts', 'fonts_functions');