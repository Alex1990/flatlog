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

                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <header>
                        <h2 class="post-title"><?php the_title(); ?></h2>
                        <time datetime="<?php the_time() ?>"><?php the_time('Y-m-d') ?></time>
                        <span class="cat">分类: <?php the_category(', ') ?></span>
                        <span class="author">作者: <?php the_author() ?></span>
                    </header>
                    <div class="entry">
                        <?php the_content('阅读全文 &raquo;'); ?>
                    </div>
                    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                    <?php the_tags('<p class="tags"><span>标签</span>: ', '', '</p>'); ?>
                    <footer>
                        <!-- <p>This entry was posted by <?php the_author() ?>
                        on <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
                        at <time><?php the_time() ?></time>
                        and is filed under <?php the_category(', ') ?>.
                        You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed. -->

                        <?php if ( comments_open() && pings_open() ) {
                            // Both Comments and Pings are open ?>
                            <!-- You can <a href="#respond">Leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.-->

                        <?php } elseif ( !comments_open() && pings_open() ) {
                            // Only Pings are open ?>
                            <!-- Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site -->

                        <?php } elseif ( comments_open() && !pings_open() ) {
                            // Comments are open, Pings are not ?>
                            <!-- You can skip to the end and leave a response. Pinging is currently not allowed. -->

                        <?php } elseif ( !comments_open() && !pings_open() ) {
                            // Neither Comments, nor Pings are open ?>
                            评论已关闭.
                        <?php } edit_post_link('编辑文章', '', '.'); ?>
                        </p>
                    </footer>
<!--                     <nav class="post-nav cf">
                        <div class="post-prev fl"><?php previous_post_link('&laquo; %link') ?></div>
                        <div class="post-next fr"><?php next_post_link('%link &raquo;') ?></div>
                    </nav> -->
                    
                    <?php comments_template(); ?>
                
                </article>

            <?php endwhile; else: ?>

                <p>Sorry, no posts matched your criteria.</p>

            <?php endif; ?>

        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
