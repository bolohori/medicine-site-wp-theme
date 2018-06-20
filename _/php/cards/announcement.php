<div class="announcement-custom-archive-entry custom-archive-entry clearfix">
	<span class="announcement-custom-archive-date custom-archive-date"><?php echo get_the_date( 'm/d/y' ); ?></span><br>
	<span class="announcement-custom-archive-link custom-archive-link"><a href="<?php ( get_field( 'url' ) ? the_field( 'url' ) : the_permalink() ); ?>"><?php the_title( '<h3>', '</h3>' ); ?></a></span>
</div>