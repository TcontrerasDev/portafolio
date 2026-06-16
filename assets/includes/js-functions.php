<?php 

function js_functions(){

    if(!is_admin()) {

        //Register scripts

        //CDN
        wp_register_script('tailwind_css', 'https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4', array(), '4.0.0', false);
        wp_register_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
        wp_register_script('scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array(), '3.12.5', true);

        //Global
        wp_register_script('global_js', get_bloginfo('template_directory') . '/assets/librerias/js/global.js', array('gsap'), '1.0', true);
        wp_register_script('menu_js', get_bloginfo('template_directory') . '/assets/librerias/js/menu.js', array('gsap'), '1.0', true);

        //Inicio
        wp_register_script('index_js', get_bloginfo('template_directory') . '/assets/librerias/js/inicio.js', array('gsap'), '1.0', true);

        //Perfil
        wp_register_script('perfil_js', get_bloginfo('template_directory') . '/assets/librerias/js/perfil.js', array('gsap'), '1.0', true);

        //Proyectos
        wp_register_script('proyectos_js', get_bloginfo('template_directory') . '/assets/librerias/js/proyectos.js', array('gsap', 'scroll-trigger'), '1.0', true);

        //Experiencia
        wp_register_script('exp_js', get_bloginfo('template_directory') . '/assets/librerias/js/experiencia.js', array('gsap', 'scroll-trigger'), '1.0', true);

        //Contacto
        wp_register_script('contacto_js', get_bloginfo('template_directory') . '/assets/librerias/js/contacto.js', array('gsap'), '1.0', true);

        //Enqueue scripts
        wp_enqueue_script('tailwind_css');
        wp_enqueue_script('gsap');
        wp_enqueue_script('global_js');
        wp_enqueue_script('menu_js');
        
        if ( is_front_page() ) {
            wp_enqueue_script('index_js');
        }
        if ( is_page('perfil') ) {
            wp_enqueue_script('perfil_js');
        }
        if ( is_page('proyectos') ) {
            wp_enqueue_script('proyectos_js');
        }
        if ( is_page('experiencia') ) {
            wp_enqueue_script('exp_js');
        }
        if ( is_page('contacto') ) {
            wp_enqueue_script('contacto_js');
        }

        //Localize Scripts

    }

}

add_action('wp_enqueue_scripts', 'js_functions', 9999);