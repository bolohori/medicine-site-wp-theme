<?php
global $curauth;
?>

<header class="clearfix news-author-header article-header">
	<a href="/news" class="visit-news-hub"><div class="arrow-left"></div>Visit the News Hub</a>
	<h1><?php echo $curauth->display_name; ?></h1>
	<h2><?php echo $curauth->title; ?></h2>
	<ul class='author-contact-list'>
		<li class='phone'><?php echo $curauth->phone; ?></li>
		<li class='email'><a href='mailto:<?php echo $curauth->user_email; ?>'><?php echo $curauth->user_email; ?></a></li>
		<li class='web'><a href='//publicafairs.med.wustl.edu'>Medcial Public Affairs</a></li>
	</ul>
	<p><?php echo $curauth->description;?></p>
	
</header>