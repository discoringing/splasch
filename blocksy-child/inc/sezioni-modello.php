<?php

if (!defined('ABSPATH')) {
    exit;
}


// ✅ funzione fallback (nuovo + vecchio campo)
function meta_sezione($id, $new, $old = '') {

    $val = get_post_meta($id, $new, true);

    if (!empty($val)) return $val;

    if (!empty($old)) {
        return get_post_meta($id, $old, true);
    }

    return '';
}



// ✅ OUTPUT SEZIONI
function sezioni_modelli() {

    if (!is_singular('post')) return '';

    global $post;
    $id = $post->ID;

    // ✅ definizione sezioni (ordine + nomi)
    $sezioni = [

        'info' => [
            'titolo' => 'Informazioni generali e descrizione'
        ],

        'rilievo' => [
            'titolo' => 'Rilievo integrato',
            'old' => 'rilievo_integrato'
        ],

        'rappresentazioni' => [
            'titolo' => 'Rappresentazioni'
        ],

        'modellazioni' => [
            'titolo' => 'Modellazioni tridimensionali',
            'old' => 'modellazioni_tridimensionali'
        ],

        'virtual' => [
            'titolo' => 'Virtual tour',
            'old' => 'virtual_tour'
        ],

        'documentazione' => [
            'titolo' => 'Documentazione d’archivio',
            'old' => 'documentazione_di_archivio'
        ],

        'bibliografia' => [
            'titolo' => 'Bibliografia'
        ],

        'pubblicazioni' => [
            'titolo' => 'Pubblicazioni consultate',
            'old' => 'pubblicazioni_consultate'
        ],

        'gruppo' => [
            'titolo' => 'Pubblicazioni gruppo di ricerca',
            'old' => 'pubblicazioni_del_gruppo_di_ricerca'
        ],

        'schedatura' => [
            'titolo' => 'Schedatura'
        ],
    ];


    ob_start();

    foreach ($sezioni as $campo => $data) {

        $contenuto = meta_sezione($id, $campo, $data['old'] ?? '');

        // ✅ salta se vuoto
        if (empty(trim($contenuto))) continue;

        $titolo = $data['titolo'];

        ?>

        <!-- BLOCCO SEZIONE -->
        <div class="blocco-sezione">

            <!-- ✅ IMPORTANTE: QUI C’È LA CLASSE CHE FA FUNZIONARE LE ICONE -->
            <h2 class="sezione <?php echo esc_attr($campo); ?>">
                <?php echo esc_html($titolo); ?>
            </h2>

            <div class="contenuto-sezione">
                <?php echo wpautop($contenuto); ?>
            </div>

        </div>

        <?php
    }

    return ob_get_clean();
}


// ✅ shortcode (se lo usi)
add_shortcode('sezioni_modelli', 'sezioni_modelli');
``
