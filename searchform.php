<form name="search" method="get" id="search-form" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="visuallyhidden" for="search-box">Search</label>
    <input type="text" id="search-box" name="s" value="<?php echo ( is_search() ) ? get_search_query() : "Search" ;?>" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="Search">
    <input type="image" class="submit" name="submit" id="search-btn" src="<?php echo get_template_directory_uri(); ?>/_/img/search.png">
</form>