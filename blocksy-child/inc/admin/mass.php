<?php

if (!defined('ABSPATH')) {
    exit;
}


// ✅ fallback campo nuovo / vecchio
function meta($id, $new, $old = '') {

    $val = get_post_meta($id, $new, true);

    if (!empty($val)) return $val;

    if (!empty($old)) {
        return get_post_meta($id, $old, true);
    }

    return '';
}


function tabella_modelli_completa() {

    // ✅ SALVATAGGIO CORRETTO (nuova struttura)
    if (isset($_POST['meta']) && is_array($_POST['meta'])) {

        foreach ($_POST['meta'] as $post_id => $fields) {

            foreach ($fields as $key => $value) {

                // sicurezza (array → stringa)
                if (is_array($value)) {
                    $value = implode("\n", $value);
                }

                // link
                if (in_array($key, [
                    'maps','modello3d','scheda','bim',
                    'ricostruzione','virtual_tour','ortofoto'
                ])) {

                    update_post_meta($post_id, $key, esc_url_raw($value));

                } else {
                    // testo
                    update_post_meta($post_id, $key, wp_kses_post($value));
                }
            }
        }
    }


    // ✅ QUERY
    $query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ]);


    ob_start();
    ?>

    <form method="POST">

    <div class="scroll-tabella">

    <table class="tabella-modelli">

        <tr>
            <th>Titolo</th>

            <th>maps</th>
            <th>modello3d</th>
            <th>scheda</th>
            <th>bim</th>
            <th>ricostruzione</th>
            <th>virtual_tour</th>
            <th>ortofoto</th>

            <th>info</th>
            <th>rilievo</th>
            <th>rappresentazioni</th>
            <th>modellazioni</th>
            <th>virtual</th>
            <th>documentazione</th>
            <th>bibliografia</th>
            <th>pubblicazioni</th>
            <th>gruppo</th>
            <th>schedatura</th>
        </tr>

        <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php $id = get_the_ID(); ?>

        <tr>

            <!-- ✅ titolo -->
            <td><?php the_title(); ?></td>

            <!-- ✅ LINK -->
            <td>
                <input name="meta[<?php echo $id; ?>][maps]" 
                       value="<?php echo esc_attr(meta($id,'maps')); ?>">
            </td>

            <td>
                <input name="meta[<?php echo $id; ?>][modello3d]" 
                       value="<?php echo esc_attr(meta($id,'modello3d')); ?>">
            </td>

            <td>
                <input name="meta[<?php echo $id; ?>][scheda]" 
                       value="<?php echo esc_attr(meta($id,'scheda')); ?>">
            </td>

            <td>
                <input name="meta[<?php echo $id; ?>][bim]" 
                       value="<?php echo esc_attr(meta($id,'bim')); ?>">
            </td>

            <td>
                <input name="meta[<?php echo $id; ?>][ricostruzione]" 
                       value="<?php echo esc_attr(meta($id,'ricostruzione')); ?>">
            </td>

            <td>
                <input name="meta[<?php echo $id; ?>][virtual_tour]" 
                       value="<?php echo esc_attr(meta($id,'virtual_tour')); ?>">
            </td>

            <td>
                <input name="meta[<?php echo $id; ?>][ortofoto]" 
                       value="<?php echo esc_attr(meta($id,'ortofoto')); ?>">
            </td>


            <!-- ✅ TESTI -->
            <td>
                <textarea name="meta[<?php echo $id; ?>][info]">
<?php echo esc_textarea(meta($id,'info')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][rilievo]">
<?php echo esc_textarea(meta($id,'rilievo','rilievo_integrato')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][rappresentazioni]">
<?php echo esc_textarea(meta($id,'rappresentazioni')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][modellazioni]">
<?php echo esc_textarea(meta($id,'modellazioni','modellazioni_tridimensionali')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][virtual]">
<?php echo esc_textarea(meta($id,'virtual','virtual_tour')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][documentazione]">
<?php echo esc_textarea(meta($id,'documentazione','documentazione_di_archivio')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][bibliografia]">
<?php echo esc_textarea(meta($id,'bibliografia')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][pubblicazioni]">
<?php echo esc_textarea(meta($id,'pubblicazioni','pubblicazioni_consultate')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][gruppo]">
<?php echo esc_textarea(meta($id,'gruppo','pubblicazioni_del_gruppo_di_ricerca')); ?>
                </textarea>
            </td>

            <td>
                <textarea name="meta[<?php echo $id; ?>][schedatura]">
<?php echo esc_textarea(meta($id,'schedatura')); ?>
                </textarea>
            </td>

        </tr>

        <?php endwhile; ?>

    </table>

    </div>

    <br>
    <input type="submit" name="salva_modelli" value="💾 Salva">

    </form>

    <?php

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('tabella_modelli_completa', 'tabella_modelli_completa');