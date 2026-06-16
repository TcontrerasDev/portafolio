<?php 
function zona_widget()
{
    /*zona de widget 1*/

    // register_sidebar(
    //     array(
    //         'name' => 'Footer columna 1',
    //         'id' => 'footer_1', //le damos ID y nombre al footer
    //         'before_widget' => '<div id="%1$s" class="footer__brand">', //añadimos clases y contenedores
    //         'after_widget' => '</div>', //cerramos los contenedores 
    //         // 'before_title' => '<h3 class="titulo-menu-footer">', //añadimos contenedores para titulo
    //         // 'after_title' => '</h3>' //cerramos los contenedores de titulo
    //     )
    // );
    
    /*zona de widget 1*/

}
add_action('widgets_init', 'zona_widget');
/*widget assets*/