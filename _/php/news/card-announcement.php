<div class="announcement-custom-archive-entry custom-archive-entry clearfix">
	<span class="announcement-custom-archive-date custom-archive-date"><?php the_time( get_option( 'date_format' ) ); ?></span><br>
	<span class="announcement-custom-archive-link custom-archive-link"><a href="<?php ( get_field( 'url' ) ? the_field( 'url' ) : the_permalink() ); ?>"><?php the_title( '<h3>', '</h3>' ); ?></a></span>
</div>
