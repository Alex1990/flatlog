<?php
/**
 * @package WordPress
 * @package Flatlog
 */

get_header(); ?>

<div id="main" role="main">
    <div class="wrap cf">
        <div class="content fl">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="post" id="post-<?php the_ID(); ?>">
            <header>
                <h2><?php the_title(); ?></h2>
            </header>

            <?php the_content('<p class="serif">继续阅读 &raquo;</p>'); ?>

            <?php wp_link_pages(array('before' => '<p><strong>页面:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

        </article>
        <?php endwhile; endif; ?>
        <?php edit_post_link('编辑文章.', '<p>', '</p>'); ?>

        <?php comments_template(); ?>

        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>