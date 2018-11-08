<?php
global $curauth;
?>

<header class="clearfix news-author-header article-header">
	<a href="/news" class="visit-news-hub"><div class="arrow-left"></div>Visit the News Hub</a>
	<div class="author-block">
		<?php
		$image_array = get_field( 'author_headshot', 'user_' . $curauth->ID );
		if ( null !== $image_array ) {
		?>
		<img src="<?php echo $image_array['sizes']['large']; ?>" class='alignleft author-headshot' alt="">
		<?php } ?>
		<div class="author-info">
			<h1><?php echo $curauth->display_name; ?></h1>
			<h2><?php echo $curauth->title; ?></h2>
			<ul class='author-contact-list'>
				<li class='phone'><?php echo $curauth->phone; ?></li>
				<li class='email'><a href='mailto:<?php echo $curauth->user_email; ?>'><?php echo $curauth->user_email; ?></a></li>
				<li class='web'><a href='//publicaffairs.med.wustl.edu/expertise/news-media-relations/'>Medical Public Affairs</a></li>
			</ul>
			<p class='author-bio'><?php echo $curauth->description;?></p>
		</div>
	</div>
</header>
