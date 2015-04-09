<?php

echo "<div class='$type-custom-archive-entry custom-archive-entry clearfix'>";
echo "<a onclick=\"javascript:_gaq.push(['_trackEvent','{$type}-archive','$ga_title']);\" href='$url'>";
if( $show_thumbnail ) {
	echo get_the_post_thumbnail($post_id, $thumbnail_size, array( 'class'	=> "$type-custom-archive-thumb custom-archive-thumb" ) );
}
echo "</a>";
echo ( $link_text === "" ) ? "" : "<span class='$type-custom-archive-link custom-archive-link'><a onclick=\"javascript:_gaq.push(['_trackEvent','{$type}-archive','$ga_title']);\" href='$url'>$link_text</a></span>";
echo "<p><span style='font-weight:700;'>" . get_field('student_profile_class_of', $post_id) . "</span> &#8226; " . get_field('student_profile_program', $post_id) . "</p>";
echo ( $excerpt_text === "" ) ? "" : "<span class='$type-custom-archive-excerpt custom-archive-excerpt'>$excerpt_text</span><br>";
echo "</div>";