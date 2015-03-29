<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */

// Register area for custom menu
function register_my_menu() {
    register_nav_menu('primary-menu', __('Primary Menu'));
    register_nav_menu('secondary_menu', __('Secondary Menu'));
}
// Add support for WordPress 3.0's custom menus
add_action('init', 'register_my_menu');

// Display Admin->links in version 3.5 or later
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// Support HTML5 form elements
add_theme_support('html5', array('search-form'));

// Add custom background support
add_custom_background();

// Enable post and comments RSS feed links to head
add_theme_support('automatic-feed-links');

// Control excerpt length using filers
function custom_excerpt_length($length) {
    return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999);

function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Custom HTML5 Comment Markup
function flatlog_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comments; ?>
    <li>
        <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <header class="comment-author vcard">
                <?php echo get_avatar($comment, $size='48', $default='<path_to_url>'); ?>
                <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
                <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a></time>
                <?php edit_comment_link(__('(Edit)'), '  ', '') ?>
            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.') ?></em>
                <br />
            <?php endif; ?>

            <?php comment_text() ?>

            <nav>
                <?php comment_reply_link(array_marge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </nav>
        </article>
    </li>
<?php
}

automatic_feed_links();

// Widgetized Sidebar HTML5 Markup
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<section>',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}

// Custom Functions for CSS/Javascript Versioning
$GLOBALS["TEMPLATE_URL"] = get_bloginfo('template_url') . "/";
$GLOBALS["TEMPLATE_RELATIVE_URL"] = wp_make_link_relative($GLOBALS["TEMPLATE_URL"]);

// Add ?v=[last modified time] to style sheets
function versioned_stylesheet($relative_url, $add_attributes="") {
    echo '<link rel="stylesheet" href="' . versioned_resource($relative_url) . '" ' . $add_attributes . '>' . "\n";
}

// Add ?v=[last modified time] to javascripts
function versioned_javascript($relative_url, $add_attributes="") {
    echo '<script src="' . versioned_resource($relative_url) . '" ' . $add_attributes . '></script>' . "\n";
}

// Add ?v=[last modified time] to a file url
function versioned_resource($relative_url) {
    $file = $_SERVER["DOCUMENT_ROOT"] . $relative_url;
    $file_version = "";

    if (file_exists($file)) {
        $file_version = "?v=" . filemtime($file);
    }

    return $relative_url . $file_version;
}

// Exclude categories on home page
function exclude_category($query) {

    // Exclude cat by name
    $flag = false;
    $exclude_names = array('portfolio','uncategorized','其他');
    foreach ($exclude_names as $key => $value) {
        if (get_cat_ID($value) != 0) {
            if ($flag) {
                $exclude_IDs .= ',-' . get_cat_ID($value);
            } else {
                $exclude_IDs = '-' . get_cat_ID($value);
                $flag = true;
            }
        }
    }

    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', $exclude_IDs);
    }
}
add_action('pre_get_posts', 'exclude_category');

// Add customized comment template
function comments_theme($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?>
    id = "comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
        <div class="comment-meta commentmetadata">
            <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
            <?php printf(__('<b class="fn">%s</b> <span class="says">says:</span>'), get_comment_author_link()) ?>
            <span class="comment-date"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></span>
            <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
            <?php endif; ?>
            <?php edit_comment_link(__('(Edit)'), '  ', ''); ?>
            </div>
        </div>
        <div class="comment-text"><?php comment_text() ?></div>
        <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
    </div>
    <?php endif; ?>
<?php            
}

// Hide the admin bar
show_admin_bar(false);

?>