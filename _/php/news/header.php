<header class="clearfix">
            
    <h1>News</h1>

    <ul class="news-subnav clearfix">
        <li><a href="<?php echo get_page_link( 7224 ) ?>">Publications</a></li>
        <li><a href="/news/for-media/">For Media</a></li>
        <li><a href="/news/announcements/">Announcements</a></li>
    </ul>

    <div class="news-filters clearfix">
        <div class="collapse">Filter</div>
        <ul>
            <li<?php if(is_page('news')) { echo ' class="active"'; } ?>><a href="/news">All</a></li>
            <li<?php if(is_category( 'editors-picks' )) { echo ' class="active"'; } ?>><a href="<?php $category_id = get_cat_ID( "Editors' Picks" ); echo esc_url(get_category_link( $category_id )); ?> ">Editors' Picks</a></li>
            <!-- <li class="parent"><a href="">Topics</a>
                <ul><?php echo wp_list_categories( 'title_li=' ); ?></ul>
            </li> -->
            <li class="parent"><a href="">News Source</a>
                <ul>
                    <li><a href="/news/type/news-release">News Releases</a></li>
                    <li><a href="/news/type/outlook">Outlook Magazine</a></li>
                    <li><a href="/news/type/profiles">Profiles</a></li>
                    <li><a href="/news/type/in-the-news">In the News</a></li>
                    <li><a href="/news/audio">Audio</a></li>
                    <li><a href="/news/type/photos">Photos &amp; Video</a></li>
                </ul>
            </li>
        </ul>
        <div class="search"><div class="search-btn"><img src="<?php echo get_template_directory_uri() . '/_/img/search-news.svg'; ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search-news.png';this.onerror=null;"></div>
            <form class="search-news" name="search" id="search-form-news" method="get" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="hidden" name="post_type" value="post" />
                <p><label for="search-box-news">Search News</label><br>
                <input type="text" id="search-box-news" name="s">
                <button type="submit" class="submit" id="search-btn-news" onclick="document.getElementById('search-form-news').submit();"><img alt="Search" src="<?php echo get_template_directory_uri(); ?>/_/img/search-news-input.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search-news-input.png';this.onerror=null;"></button>
            </form>
        </div>
    </div>

</header>