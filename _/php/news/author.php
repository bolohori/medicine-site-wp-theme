<?php
global $curauth;
?>

<header class="clearfix news-author-header article-header">
	<a href="/news" class="visit-news-hub"><div class="arrow-left"></div>Visit the News Hub</a>
	<div class="author-block">
		<?php
		$image_array = get_field( 'author_headshot', 'user_' . $curauth->ID );
		if ( !empty( $image_array ) ) {
			$image = $image_array['sizes']['large'];
		} else {
			$image = get_stylesheet_directory_uri() . '/_/img/author-default-image.jpg';
		}
		?>
		
		<img src="<?php echo $image; ?>" class='alignleft author-headshot' alt="">
		<div class="author-info">
			<h1><?php echo $curauth->display_name; ?></h1>
			<h2><?php echo $curauth->title; ?></h2>
			<ul class='author-contact-list'>
				<?php if ( !empty( $curauth->phone ) ) { ?>
					<li class='phone'><?php echo $curauth->phone; ?></li>
				<?php } ?>
				<?php if ( !empty( $curauth->user_email ) ) { ?>
					<li class='email'><a href='mailto:<?php echo $curauth->user_email; ?>'><?php echo $curauth->user_email; ?></a></li>
				<?php } ?>
				<li class='web'><a href='//publicaffairs.med.wustl.edu/expertise/news-media-relations/'>Medical Public Affairs</a></li>
			</ul>
			<p class='author-bio'><?php echo $curauth->description;?></p>
		</div>
	</div>
</header>
