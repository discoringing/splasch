<?php

function modifica_modello_frontend() {

    if (!isset($_GET['id'])) return "Nessun ID";

    $post_id = intval($_GET['id']);
    $post = get_post($post_id);

    if (!$post) return "Non trovato";

    // Recupero campi
    $maps = get_post_meta($post_id, 'maps', true);
    $modello = get_post_meta($post_id, 'modello3d', true);
    $scheda = get_post_meta($post_id, 'scheda', true);

    $info = get_post_meta($post_id, 'info', true);
    $rilievo = get_post_meta($post_id, 'rilievo_integrato', true);
    $rapp = get_post_meta($post_id, 'rappresentazioni', true);
    $modellazioni = get_post_meta($post_id, 'modellazioni_tridimensionali', true);
    $virtual = get_post_meta($post_id, 'virtual_tour', true);
    $doc = get_post_meta($post_id, 'documentazione_di_archivio', true);
    $bibl = get_post_meta($post_id, 'bibliografia', true);
    $pub = get_post_meta($post_id, 'pubblicazioni_consultate', true);
    $gruppo = get_post_meta($post_id, 'pubblicazioni_del_gruppo_di_ricerca', true);
    $schedatura = get_post_meta($post_id, 'schedatura', true);

    // Salvataggio
    if (isset($_POST['salva_modello'])) {

        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => sanitize_text_field($_POST['titolo'])
        ));

update_post_meta($post_id, 'maps', esc_url_raw($_POST['maps'] ?? ''));
update_post_meta($post_id, 'modello3d', esc_url_raw($_POST['modello3d'] ?? ''));
update_post_meta($post_id, 'scheda', esc_url_raw($_POST['scheda'] ?? ''));

update_post_meta($post_id, 'info', wp_kses_post($_POST['info'] ?? ''));
update_post_meta($post_id, 'rilievo_integrato', wp_kses_post($_POST['rilievo_integrato'] ?? ''));
update_post_meta($post_id, 'rappresentazioni', wp_kses_post($_POST['rappresentazioni'] ?? ''));
update_post_meta($post_id, 'modellazioni_tridimensionali', wp_kses_post($_POST['modellazioni_tridimensionali'] ?? ''));
update_post_meta($post_id, 'virtual_tour', wp_kses_post($_POST['virtual_tour'] ?? ''));
update_post_meta($post_id, 'documentazione_di_archivio', wp_kses_post($_POST['documentazione_di_archivio'] ?? ''));
update_post_meta($post_id, 'bibliografia', $_POST['bibliografia'] ?? ''); // ✅ QUI FIX
update_post_meta($post_id, 'pubblicazioni_consultate', wp_kses_post($_POST['pubblicazioni_consultate'] ?? ''));
update_post_meta($post_id, 'pubblicazioni_del_gruppo_di_ricerca', wp_kses_post($_POST['pubblicazioni_del_gruppo_di_ricerca'] ?? ''));
update_post_meta($post_id, 'schedatura', wp_kses_post($_POST['schedatura'] ?? ''));

echo "<p style='color:green;'>✅ Modifiche salvate!</p>";

    }

    ob_start();
    ?>

    <form method="POST" style="max-width:900px;">

        <h2>Modifica Scheda</h2>

        <input type="text" name="titolo" value="<?php echo esc_attr($post->post_title); ?>"><br><br>

        <input type="text" name="maps" value="<?php echo esc_attr($maps); ?>" placeholder="Maps"><br>
        <input type="text" name="modello3d" value="<?php echo esc_attr($modello); ?>" placeholder="Modello"><br>
        <input type="text" name="scheda" value="<?php echo esc_attr($scheda); ?>" placeholder="Scheda"><br><br>

        <h3>Informazioni</h3>
        <?php wp_editor($info, 'info_editor', ['textarea_name'=>'info']); ?>

        <h3>Rilievo Integrato</h3>
        <?php wp_editor($rilievo, 'rilievo_editor', ['textarea_name'=>'rilievo']); ?>

        <h3>Rappresentazioni</h3>
        <?php wp_editor($rapp, 'rapp_editor', ['textarea_name'=>'rappresentazioni']); ?>

        <h3>Modellazioni tridimensionali / digital twins</h3>
        <?php wp_editor($modellazioni, 'mod_editor', ['textarea_name'=>'modellazioni_tridimensionali']); ?>

        <h3>Virtual Tour</h3>
        <?php wp_editor($virtual, 'virt_editor', ['textarea_name'=>'virtual']); ?>

        <h3>Documentazione di archivio</h3>
        <?php wp_editor($doc, 'doc_editor', ['textarea_name'=>'documentazione']); ?>

        <h3>Bibliografia</h3>
        <?php wp_editor($bibl, 'bibl_editor', ['textarea_name'=>'bibliografia']); ?>

        <h3>Pubblicazioni consultate</h3>
        <?php wp_editor($pub, 'pub_editor', ['textarea_name'=>'pubblicazioni']); ?>

        <h3>Pubblicazioni del gruppo di ricerca</h3>
        <?php wp_editor($gruppo, 'gruppo_editor', ['textarea_name'=>'gruppo']); ?>

        <h3>Schedatura</h3>
        <?php wp_editor($schedatura, 'sched_editor', ['textarea_name'=>'schedatura']); ?>

        <br><br>
        <input type="submit" name="salva_modello" value="💾 Salva">

    </form>

    <?php
    return ob_get_clean();
}

add_shortcode('modifica_modello', 'modifica_modello_frontend');