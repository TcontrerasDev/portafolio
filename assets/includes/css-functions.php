<?php 

function css_function(){

    //Register style

    //CDN
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1', 'all');

    //Global
    wp_register_style('global_css', get_template_directory_uri() . '/assets/librerias/css/global.css', array(), '1.0', 'all');
    
    //Inicio
    wp_register_style('index_css', get_template_directory_uri() . '/assets/librerias/css/index.css', array(), '1.0', 'all');
    
    //Proyectos
    wp_register_style('proyectos_css', get_template_directory_uri() . '/assets/librerias/css/proyectos.css', array(), '1.0', 'all');

    //Experiencia
    wp_register_style('exp_css', get_template_directory_uri() . '/assets/librerias/css/experiencia.css', array(), '1.0', 'all');

    //Contacto
    wp_register_style('contacto_css', get_template_directory_uri() . '/assets/librerias/css/contacto.css', array(), '1.0', 'all');


    //Enqueue style
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('global_css');

    if ( is_front_page() ) {
        wp_enqueue_style('index_css');
    }

    if ( is_page('proyectos') ){
        wp_enqueue_style('proyectos_css');
    }

    if ( is_page('experiencia') ){
        wp_enqueue_style('exp_css');
    }

    if ( is_page('contacto') ){
        wp_enqueue_style('contacto_css');
    }
}

add_action('wp_enqueue_scripts', 'css_function');