<?php

function tabella_modelli_modifica_link() {

    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1
    ));

    $output = '<table>';

    while ($query->have_posts()) {
        $query->the_post();

        $id = get_the_ID();

        $output .= '<tr>';
        $output .= '<td>' . get_the_title() . '</td>';
        $output .= '<td><a href="/modifica-scheda/?id=' . $id . '">✏️</a></td>';
        $output .= '</tr>';
    }

    wp_reset_postdata();
    $output .= '</table>';

    return $output;
}

add_shortcode('tabella_modelli_edit', 'tabella_modelli_modifica_link');