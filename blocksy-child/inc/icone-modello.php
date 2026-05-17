<?php

// Evita ridefinizione funzione
if (!function_exists('icone_modello')) {

    function icone_modello($id = null) {

        // Se non passato, usa ID corrente
        if (!$id) {
            $id = get_the_ID();
        }

        // ✅ DEFINIZIONE CENTRALIZZATA ICONE
        $icone = [
            'maps'           => ['📍', 'Maps'],
            'modello3d'      => ['🧊', 'Modello 3D'],
            'scheda'         => ['📄', 'Scheda'],
            'bim'            => ['🏗️', 'BIM'],
            'ricostruzione'  => ['🏛️', 'Ricostruzione'],
            'virtual_tour'   => ['🌐', 'Virtual Tour'],
            'ortofoto'       => ['🛰️', 'Ortofoto']
        ];

        $output = '<div class="icone">';

        // ✅ CICLO ICONE
        foreach ($icone as $campo => $dati) {

            $url = get_post_meta($id, $campo, true);

            if (!empty($url)) {

                $output .= '<a href="' . esc_url($url) . '" target="_blank" class="icona icona-' . esc_attr($campo) . '" title="' . esc_attr($dati[1]) . '">';
                $output .= $dati[0];
                $output .= '</a>';
            }
        }

        $output .= '</div>';

        return $output;
    }
}