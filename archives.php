<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */
/*
Template Name: Archives
 */
?>

<?php get_header(); ?>

<div id="main">
    <?php get_search_form(); ?>

    <section>
        <h2>月份归档:</h2>
        <ul>
            <?php wp_get_archives('type=monthly'); ?>
        </ul>
    </section>

    <section>
        <h2>分类归档:</h2>
        <ul>
            <?php wp_list_categories(); ?>
        </ul>
    </section>
    
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
