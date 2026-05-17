<?php

if (!defined('ABSPATH')) {
    exit;
}

// CSS
require_once get_stylesheet_directory() . '/inc/core/css.php';

// Frontend
require_once get_stylesheet_directory() . '/inc/frontend/galleria.php';

// Forms
require_once get_stylesheet_directory() . '/inc/forms/inserimento.php';
require_once get_stylesheet_directory() . '/inc/forms/modifica.php';

// Admin
require_once get_stylesheet_directory() . '/inc/admin/tabella-edit.php';
require_once get_stylesheet_directory() . '/inc/admin/tabella.php';
require_once get_stylesheet_directory() . '/inc/admin/mass.php';

// Moduli
require_once get_stylesheet_directory() . '/inc/sezioni-modello.php';
require_once get_stylesheet_directory() . '/inc/icone-modello.php';
?>