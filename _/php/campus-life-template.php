<?php

echo "<div class='$type-custom-archive-entry custom-archive-entry clearfix'>";
echo "<div style='float: right; width: 330px; padding: 20px;'>";
echo ( $title_text === "" ) ? "" : "<span class='$type-custom-archive-title custom-archive-title'>$title_text</span>";
echo "<hr>";
echo ( $date_text === "" ) ? "" : "<span class='$type-custom-archive-date custom-archive-date'>$date_text</span><br>";
echo ( $excerpt_text === "" ) ? "" : "<span class='$type-custom-archive-excerpt custom-archive-excerpt'>$excerpt_text</span>";
echo ( $link_text === "" ) ? "" : "<span class='$type-custom-archive-link custom-archive-link'><a onclick=\"javascript:_gaq.push(['_trackEvent','{$type}-archive','$ga_title']);\" href='$url'>$link_text</a></span>";
echo "</div>";
echo "<a onclick=\"javascript:_gaq.push(['_trackEvent','{$type}-archive','$ga_title']);\" href='$url'>";
if( $show_thumbnail ) {
	echo get_the_post_thumbnail($post_id, $thumbnail_size, array( 'class'	=> "$type-custom-archive-thumb custom-archive-thumb" ) );
}
echo "</a>";
echo "</div>";