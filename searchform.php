<form name="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="visuallyhidden" for="search-box">Search</label>
<<<<<<< HEAD
    <input type="text" id="search-box" name="s" value="Search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="Search">
    <div class="submit" name="submit" id="search-btn" onclick="document.getElementById('searchform').submit();"><img alt="Search" src="<?php echo get_template_directory_uri(); ?>/_/img/search.png"></div>
=======
    <input type="text" id="search-box" name="s" value="<?php echo ( is_search() ) ? get_search_query() : "Search" ;?>" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="Search">
    <div class="submit" name="submit" id="search-btn" onclick="document.getElementById('search-form').submit();"><img alt="Search" src="<?php echo get_template_directory_uri(); ?>/_/img/search.png"></div>
>>>>>>> FETCH_HEAD
</form>