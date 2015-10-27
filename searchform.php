<form name="search" method="get" id="search-form" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<p><label for="search-box">Search</label><br>
    <input type="text" id="search-box" name="s">
    <button type="submit" class="submit" id="search-btn" onclick="document.getElementById('search-form').submit();"><img alt="Search" src="<?php echo get_template_directory_uri(); ?>/_/img/search.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search.png';this.onerror=null;"></button>
</form>