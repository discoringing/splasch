<?php
/*
Template Name: Scheda
Template Post Type: post
*/

get_header();

while (have_posts()) : the_post();

if (in_category(['napoli','rende','roma'])) :
?>

    <!-- ✅ IMMAGINE HEADER -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="header-scheda">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <div class="scheda-container">

        <!-- ✅ TITOLO -->
        <h1 class="titolo-scheda"><?php the_title(); ?></h1>

        <!-- ✅ ICONE (modulari) -->
        <?php echo icone_modello(); ?>

        <!-- ✅ SEZIONI (modulari) -->
        <?php echo sezioni_modello(); ?>

    </div>

<?php else : ?>

    <!-- ✅ POST NORMALI -->
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>

<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
