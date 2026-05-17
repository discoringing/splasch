<?php

function carica_css_galleria() {
    wp_enqueue_style(
        'galleria-css',
        get_stylesheet_directory_uri() . '/galleria.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'carica_css_galleria');