<?php

function galleria_modelli() {

    $categorie = [
        'napoli' => 'Parco Archeologico dei Campi Flegrei',
        'rende'  => 'Serra San Bruno e Soriano Calabro',
        'roma'   => 'Via Francigena'
    ];

    $output = '';

    foreach ($categorie as $slug => $titolo) {

        $query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => -1,
            'category_name' => $slug,
            'orderby' => 'title',
            'order' => 'ASC'
        ]);

        if ($query->have_posts()) {

            $output .= '<h2 class="titolo-sezione">'.$titolo.'</h2>';
            $output .= '<div class="griglia-modelli">';

            while ($query->have_posts()) {
                $query->the_post();

                $output .= '<div class="card-modello">';
                $output .= get_the_post_thumbnail(get_the_ID(), 'medium');
                $output .= '<h3>'.get_the_title().'</h3>';

                $output .= icone_modello(get_the_ID());

                $output .= '</div>';
            }

            $output .= '</div>';
            wp_reset_postdata();
        }
    }

    return $output;
}

add_shortcode('galleria_modelli', 'galleria_modelli');