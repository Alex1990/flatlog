<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */
?>
<div id="search" class="search-wrapper fr">
    <span class="search-trigger">搜索</span>
    <form action="<?php bloginfo('home') ?>" class="search-form" method="get">
        <fieldset>
            <label for="keywords" class="aria-label vhide">搜索</label>
            <input type="text" id="keywords" class="keywords" name="s" placeholder="" value="<?php the_search_query(); ?>" />
            <input type="submit" class="search-submit btn" value="搜索">
        </fieldset>
    </form>
</div>