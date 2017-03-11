<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(site_url()); ?>">
    <label class="screen-reader-text" for="s">Search for</label>
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="search-input" />
    <input type="submit" id="search-submit" value="Search" />
</form>
