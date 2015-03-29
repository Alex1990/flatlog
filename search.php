<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */

get_header(); ?>

<div id="main" class="main" role="main">
    <div class="wrap cf">
        <div class="content fl">
        <?php if (have_posts()) : ?>

            <h2>搜索结果：</h2>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                global $more;
                $more = 0;
                ?>
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <header>
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <time datatime="<?php the_time('Y-m-d')?>"><?php the_time('Y-m-d') ?></time>
                        <span class="cat">分类: <?php the_category(', ') ?></span>
                        <span class="author">作者: <?php the_author() ?></span>
                    </header>
                    <div class="entry">
                        <div class="excerpt">
                            <?php
                                if (preg_match('/<!--more-->/', get_the_content())) {
                                    the_content();
                                } else {
                                    the_excerpt();
                                }
                            ?>
                            <span class="read-more">
                                <a href="<?php the_permalink(); ?>">阅读全文&raquo;</a>
                            </span>
                        </div>
                    </div>
                    <footer>
                        <?php echo get_the_tag_list('<span class="tags">标签: ', '', ''); ?></span>
                        <span class="comments">评论: <?php comments_popup_link('无评论', '1 评论', '% 评论'); ?></span>
                        <span class="edit"><?php edit_post_link('编辑', '', ''); ?></span>
                    </footer>
                </article>

            <?php endwhile; ?>

            <nav class="article-pagination">
                <span><?php previous_posts_link('上一页') ?></span>
                <span><?php next_posts_link('下一页') ?></span>
            </nav>

        <?php else : ?>

            <h2>没有文章</h2>
            <p>看起来这里没有你要找的东西:)</p>

        <?php endif; ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>