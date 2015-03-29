<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */
?>
<aside id="sidebar" class="sidebar fr">
    <?php /* Widgetized sidebar, if you have the plugin installed. */
        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

        <nav class="cat-wrapper" role="navigation">
            <h3>·ÖÀàÄ¿Â¼</h3>
            <ul class="nav-cat">
            <?php 
            // Exclude cat by name
            $flag = false;
            $exclude_names = array('portfolio','uncategorized','其他');
            foreach ($exclude_names as $key => $value) {
                if (get_cat_ID($value) != 0) {
                    if ($flag) {
                        $exclude_IDs .= ', ' . get_cat_ID($value);
                    } else {
                        $exclude_IDs = get_cat_ID($value);
                        $flag = true;
                    }
                }
            }

            // Include cat by name
            // $include_names = array('CSS', 'Javascript');
            /* foreach ($include_names as $key => $value) {
                $subcategories = get_categories(array('parent' => get_cat_ID($value)));
                if (count($subcategories) > 0) {
                    $include_ID = get_cat_ID($value);
                    echo '<li><a href="">' . $value . '</a><ul>';
                    wp_list_categories('child_of=' . $include_ID . '&exclude=' . $exclude_IDs . '&style=list&title_li=&hierarchical=0&use_desc_for_title=0');
                    echo '</li>';
                }
            }*/

            wp_list_categories('exclude=' . $exclude_IDs . '&style=list&title_li=&hierachical=0&use_desc_for_title=0');
            ?>
        </nav>

    <?php endif; ?>
</aside>