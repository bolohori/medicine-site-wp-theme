<?php 
if( get_field('stories_check') == 1 ) {
	$newstype = get_field( 'news_type_selection' );
	$newscategory = get_field( 'categories_selection' );
	if( $newscategory != '' ) {
		$args = array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'tax_query' => array (
             	array (
	             	'taxonomy' => 'news',
	             	'field' => 'term_id',
	             	'terms' => $newstype
             	),
            ),
            'category__in' => $newscategory,
        );
    }
    else {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'tax_query' => array (
             	array (
	             	'taxonomy' => 'news',
	             	'field' => 'term_id',
	             	'terms' => $newstype
             	),
            ),
        );
    }
    $the_query = new WP_Query( $args );
    $j = 0; ?>
    <div class="generic-cards">
        <ul class="clearfix">
            <?php while ( $the_query->have_posts() ) {
                $the_query->the_post(); ?>
					<li>
						<?php if ( $j % 2 == 0 ) {
							echo '<div class="card odd">';
						}
						else {
							echo '<div class="card even">';
						} ?>
		                    <a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>">
		                        <?php 
			                    if( has_post_thumbnail() ) {
					                the_post_thumbnail('news');
					            } else {
					                echo '<img src="'. get_template_directory_uri() . '/_/img/default.jpg">';
					            }    
			                    ?>
		                        <div class="card-text">
									<p class="article-date"><?php the_time('M j, Y'); ?></p>
		                            <?php the_title('<h2>', '</h2>'); ?>
		                            <?php if(has_excerpt()) {
		                                echo '<p>' . get_the_excerpt() . '.</p>';
					                if(get_field('source')) {
					                    echo '<p class="news-source">Source: ' . get_field('source') . '</p>';
					                } else {
					                    $terms = get_the_term_list( $post->ID, 'news', '', ', ', '' ) ;
					                    echo '<p class="news-source">' . strip_tags($terms) . '</p>';
					                }
		                            } ?>
		                        </div>
							</a>
						</div>
					</li>
			<?php $j++; } /* end while */?>
		</ul>
    </div>
<?php } /* end if */ ?>