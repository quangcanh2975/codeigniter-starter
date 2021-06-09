<h2><?php echo $title; ?></h2>
<?php foreach($news as $news_items):?>
<h3><?php echo $news_items['title']; ?></h3>
<div class="main">
<?php	echo $news_items['text']; ?>
</div>
	<p><a href="<?php echo base_url('news/'.$news_items['slug']); ?>">View article</a></p>
<?php endforeach?>

