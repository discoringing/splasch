
<?php

function form_inserimento_modelli_completo() {

    if (isset($_POST['invia_modello'])) {

        $post_id = wp_insert_post(array(
            'post_title' => sanitize_text_field($_POST['titolo']),
            'post_status' => 'publish',
            'post_type' => 'post'
        ));

        if ($post_id) {

            // ✅ LINK (coerenti con la galleria)
            update_post_meta($post_id, 'maps', esc_url_raw($_POST['maps'] ?? ''));
            update_post_meta($post_id, 'modello3d', esc_url_raw($_POST['modello3d'] ?? ''));
            update_post_meta($post_id, 'scheda', esc_url_raw($_POST['scheda'] ?? ''));
            update_post_meta($post_id, 'bim', esc_url_raw($_POST['bim'] ?? ''));
            update_post_meta($post_id, 'ricostruzione', esc_url_raw($_POST['ricostruzione'] ?? ''));
            update_post_meta($post_id, 'virtual_tour', esc_url_raw($_POST['virtual_tour'] ?? ''));
            update_post_meta($post_id, 'ortofoto', esc_url_raw($_POST['ortofoto'] ?? '')); // ✅ NUOVO

            // ✅ CONTENUTI
            update_post_meta($post_id, 'info', wp_kses_post($_POST['info'] ?? ''));
            update_post_meta($post_id, 'rilievo', wp_kses_post($_POST['rilievo'] ?? ''));
            update_post_meta($post_id, 'rappresentazioni', wp_kses_post($_POST['rappresentazioni'] ?? ''));
            update_post_meta($post_id, 'modellazioni', wp_kses_post($_POST['modellazioni'] ?? ''));
            update_post_meta($post_id, 'virtual', wp_kses_post($_POST['virtual'] ?? ''));
            update_post_meta($post_id, 'documentazione', wp_kses_post($_POST['documentazione'] ?? ''));
            update_post_meta($post_id, 'bibliografia', wp_kses_post($_POST['bibliografia'] ?? ''));
            update_post_meta($post_id, 'pubblicazioni', wp_kses_post($_POST['pubblicazioni'] ?? ''));
            update_post_meta($post_id, 'gruppo', wp_kses_post($_POST['gruppo'] ?? ''));
            update_post_meta($post_id, 'schedatura', wp_kses_post($_POST['schedatura'] ?? ''));

            echo "<p style='color:green;'>✅ Scheda creata!</p>";
        }
    }

    ob_start();
    ?>

    <form method="POST" style="max-width:900px;">

        <h2>Nuova Scheda</h2>

        <input type="text" name="titolo" placeholder="Titolo" required><br><br>

        <h3>Link</h3>

        <input type="text" name="maps" placeholder="Google Maps"><br>
        <input type="text" name="modello3d" placeholder="Modello 3D"><br>
        <input type="text" name="scheda" placeholder="Scheda"><br>
        <input type="text" name="bim" placeholder="BIM"><br>
        <input type="text" name="ricostruzione" placeholder="Ricostruzione"><br>
        <input type="text" name="virtual_tour" placeholder="Virtual Tour"><br>
        <input type="text" name="ortofoto" placeholder="Ortofoto (NUOVO)"><br><br>

        <h3>Informazioni</h3>
        <?php wp_editor('', 'info_editor', array('textarea_name'=>'info')); ?>

        <h3>Rilievo integrato</h3>
        <?php wp_editor('', 'rilievo_editor', array('textarea_name'=>'rilievo')); ?>

        <h3>Rappresentazioni</h3>
        <?php wp_editor('', 'rapp_editor', array('textarea_name'=>'rappresentazioni')); ?>

        <h3>Modellazioni tridimensionali / digital twins</h3>
        <?php wp_editor('', 'mod_editor', array('textarea_name'=>'modellazioni')); ?>

        <h3>Virtual Tour</h3>
        <?php wp_editor('', 'virt_editor', array('textarea_name'=>'virtual')); ?>

        <h3>Documentazione</h3>
        <?php wp_editor('', 'doc_editor', array('textarea_name'=>'documentazione')); ?>

        <h3>Bibliografia</h3>
        <?php wp_editor('', 'bibl_editor', array('textarea_name'=>'bibliografia')); ?>

        <h3>Pubblicazioni consultate</h3>
        <?php wp_editor('', 'pub_editor', array('textarea_name'=>'pubblicazioni')); ?>

        <h3>Pubblicazioni del Gruppo di ricerca</h3>
        <?php wp_editor('', 'gruppo_editor', array('textarea_name'=>'gruppo')); ?>

        <h3>Schedatura</h3>
        <?php wp_editor('', 'sched_editor', array('textarea_name'=>'schedatura')); ?>

        <br><br>
        <input type="submit" name="invia_modello" value="➕ Crea scheda">

    </form>

    <?php
    return ob_get_clean();
}

add_shortcode('form_modelli', 'form_inserimento_modelli_completo');
