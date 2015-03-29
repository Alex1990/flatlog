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

            <section>
                <?php $post = $posts[0]; // Hack. Set $post so that the_date works. ?>
                <?php /* If this is a category archive */ if (is_category()) { ?>
                <h2 class="pagetitle">分类：<?php single_cat_title(); ?></h2>
                <?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
                <h2 class="pagetitle">归档于 &#8216;<?php single_tag_title(); ?>&#8217; 标签</h2>
                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h2 class="pagetitle">归档于 <?php the_time('F jS, Y'); ?></h2>
                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h2 class="pagetitle">归档于 <?php the_time('F, Y'); ?></h2>
                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h2 class="pagetitle">归档于 <?php the_time('Y'); ?></h2>
                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h2 class="pagetitle">作者归档</h2>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h2 class="pagetitle">文章归档</h2>
                <?php } ?>
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
                    <span class="btn"><?php previous_posts_link('上一页') ?></span>
                    <span class="btn"><?php next_posts_link('下一页') ?></span>
                </nav>
            </section>

            <?php else :

            if ( is_category() ) { // If this is a category archive
                printf("<h2>很抱歉，%s 分类下木有文章</h2>", single_cat_title('', false));
            } else if ( is_date() ) { // If this is a date archive
                echo("<h2>很抱歉，这个时间我在偷懒</h2>");
            } else if ( is_author() ) { // If this is a category archive
                $userdata = get_userdatabylogin(get_query_var('author_name'));
                printf("<h2>好像木有与 %s 有关的文章</h2>", $userdata->display_name);
            } else {
                echo("<h2>没有文章.</h2>");
            }
            get_search_form();

            endif;
            ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
