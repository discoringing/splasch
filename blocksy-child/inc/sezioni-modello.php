<?php

// Evita ridefinizione funzione
if (!function_exists('sezioni_modello')) {

    function sezioni_modello($id = null) {

        // Usa ID corrente se non passato
        if (!$id) {
            $id = get_the_ID();
        }

        // ✅ DEFINIZIONE SEZIONI
        $sezioni = [
            'info' => 'Informazioni generali',
            'rilievo' => 'Rilievo integrato',
            'rappresentazioni' => 'Rappresentazioni',
            'modellazioni' => 'Modellazioni tridimensionali',
            'virtual' => 'Virtual Tour',
            'documentazione' => 'Documentazione',
            'bibliografia' => 'Bibliografia',
            'pubblicazioni' => 'Pubblicazioni consultate',
            'gruppo' => 'Pubblicazioni del Gruppo di ricerca',
            'schedatura' => 'Schedatura'
        ];

        $output = '';

        // ✅ CICLO SEZIONI
        foreach ($sezioni as $campo => $titolo) {

            $valore = get_post_meta($id, $campo, true);

            if (!empty($valore)) {

                $output .= '<h2 class="sezione sezione-' . esc_attr($campo) . '">';
                $output .= esc_html($titolo);
                $output .= '</h2>';

                // ✅ gestione contenuto
                if ($campo === 'bibliografia') {
                    // mantiene HTML
                    $output .= '<div class="contenuto">' . $valore . '</div>';
                } else {
                    $output .= '<div class="contenuto">' . wpautop($valore) . '</div>';
                }
            }
        }

        return $output;
    }
}