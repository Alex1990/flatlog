<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */

// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('请不要直接访问子页面!');

    if ( post_password_required() ) { ?>
        <p class="nocomments">请输入密码查看评论.</p>        
    <?php
        return;
    }
?>

<?php if ( have_comments() ) : ?>
    <h3 id="comments" class="comments"><?php comments_number('没有评论', '1个评论', '% 评论'); ?></h3>

    <nav>
        <div><?php previous_comments_link() ?></div>
        <div><?php next_comments_link() ?></div>
    </nav>

    <ol class="commentlist">
    <?php wp_list_comments('type=comment&avatar_size=48&format=html5&callback=comments_theme'); ?>
    </ol>

    <nav>
        <div><?php previous_comments_link() ?></div>
        <div><?php next_comments_link() ?></div>
    </nav>
    <?php else : // this is displayed if there are no comments so far ?>

        <?php if ( comments_open() ) : ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments">评论已关闭.</p>
        
        <?php endif; ?>
    <?php endif; ?>


    <?php if ( comments_open() ) : ?>

    <section id="respond" class="respond">
        
        <h3><?php comment_form_title( '评论:', '给%s留言' ); ?></h3>

        <div class="cancel-comment-reply">
            <small><?php cancel_comment_reply_link(); ?></small>
        </div>

        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
        <?php else : ?>

        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post"  class="comment-form" id="commentform">

        <?php if ( is_user_logged_in() ) : ?>

        <p>当前登录名: <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">退出 &raquo;</a></p>

        <?php else : ?>

        <p>
            <label for="author" class="vhide">昵称</label>
            <input type="text" name="author" id="author" placeholder="昵称" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
            <?php if ($req) echo "<span> * </span>"; ?>
        </p>

        <p>
            <label for="email" class="vhide">邮箱</label>
            <input type="email" name="email" id="email" placeholder="邮箱" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
            <?php if ($req) echo "<span> * <small>(邮箱地址不会公开)</small></span>"; ?>
        </p>

        <p>
            <label for="url" class="vhide">网址</label>
            <input type="url" name="url" id="url" placeholder="网址" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
        </p>

        <?php endif; ?>

        <!-- <p id="allowed_tags"><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></p> -->

        <p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

        <p>
            <input type="submit" name="submit" id="submit" class="comment-submit btn" tabindex="5" value="发表评论" />
            <?php comment_id_fields(); ?>
        </p>
        <?php do_action('comment_form', $post->ID); ?>

        </form>
        <?php endif; // If registration required and not logged in ?>
    </section>    

    <?php endif; // If you delete this sky will fall on your head ?>