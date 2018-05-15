<?php
$pagetitle = get_the_title();
if( get_field( 'stories_check' ) ) {
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
    $i = 1; ?>
    <div class="generic-cards">
        <ul class="clearfix">
            <?php while ( $the_query->have_posts() ) {
            $the_query->the_post(); ?>
			<li>
				<div>
					<a href="<?php ( get_field('url') ? the_field('url') : the_permalink() ) ?>" data-category="Page - Internal" data-action="Cards - <?php echo $pagetitle ?>">
						<?php if( $i % 2 == 1 ) {
							$cardtype = "odd";
						} else {
							$cardtype = "even";
						}; ?>
						<div class="card <?php echo $cardtype; ?>">
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
						</div>
					</a>
				</div>
			</li>
			<?php $i++; } /* end while */?>
		</ul>
    </div>
<?php } /* end if */ ?>
