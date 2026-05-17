<?php

if (!defined('ABSPATH')) {
    exit;
}

function tabella_modelli() {

    // ✅ SALVATAGGIO
    if (isset($_POST['salva_modelli'])) {

        if (!empty($_POST['post_id'])) {

            foreach ($_POST['post_id'] as $index => $post_id) {

                update_post_meta($post_id, 'maps', esc_url_raw($_POST['maps'][$index] ?? ''));
                update_post_meta($post_id, 'modello3d', esc_url_raw($_POST['modello3d'][$index] ?? ''));
                update_post_meta($post_id, 'scheda', esc_url_raw($_POST['scheda'][$index] ?? ''));
                update_post_meta($post_id, 'bim', esc_url_raw($_POST['bim'][$index] ?? ''));
                update_post_meta($post_id, 'ricostruzione', esc_url_raw($_POST['ricostruzione'][$index] ?? ''));
                update_post_meta($post_id, 'virtual_tour', esc_url_raw($_POST['virtual_tour'][$index] ?? ''));
                update_post_meta($post_id, 'ortofoto', esc_url_raw($_POST['ortofoto'][$index] ?? ''));
            }

            echo "<p style='color:green;'>✅ Modifiche salvate</p>";
        }
    }

    // ✅ QUERY
    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    ob_start();
    ?>

    <form method="POST">
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th>Titolo</th>
                <th>Maps</th>
                <th>Modello</th>
                <th>Scheda</th>
                <th>BIM</th>
                <th>Ricostruzione</th>
                <th>Virtual Tour</th>
                <th>Ortofoto 🛰️</th>
            </tr>

            <?php while ($query->have_posts()) : $query->the_post(); ?>

                <?php
                $id = get_the_ID();
                ?>

                <tr>
                    <td><?php the_title(); ?></td>

                    <td><input type="text" name="maps[]" value="<?php echo esc_attr(get_post_meta($id, 'maps', true)); ?>"></td>
                    <td><input type="text" name="modello3d[]" value="<?php echo esc_attr(get_post_meta($id, 'modello3d', true)); ?>"></td>
                    <td><input type="text" name="scheda[]" value="<?php echo esc_attr(get_post_meta($id, 'scheda', true)); ?>"></td>
                    <td><input type="text" name="bim[]" value="<?php echo esc_attr(get_post_meta($id, 'bim', true)); ?>"></td>
                    <td><input type="text" name="ricostruzione[]" value="<?php echo esc_attr(get_post_meta($id, 'ricostruzione', true)); ?>"></td>
                    <td><input type="text" name="virtual_tour[]" value="<?php echo esc_attr(get_post_meta($id, 'virtual_tour', true)); ?>"></td>
                    <td><input type="text" name="ortofoto[]" value="<?php echo esc_attr(get_post_meta($id, 'ortofoto', true)); ?>"></td>

                    <input type="hidden" name="post_id[]" value="<?php echo $id; ?>">
                </tr>

            <?php endwhile; ?>

        </table>

        <br>
        <input type="submit" name="salva_modelli" value="💾 Salva">
    </form>

    <?php

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('tabella_modelli', 'tabella_modelli');