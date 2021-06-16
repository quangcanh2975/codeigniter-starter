<h2><?php echo $title; ?></h2>
<?php foreach ($news as $news_item) : ?>
	<div class="main">
		<h3><?php echo $news_item['title']; ?><small> on <?php echo $news_item['name']; ?></small></h3>
		<div class="row">
			<div class="col-md-3">
				<img class="thumbnail" src="<?php echo base_url(); ?>assets/images/posts/<?php echo $news_item['post_image']; ?>" alt="Post image">

			</div>
			<div class="col-md-9">
				<?php echo $news_item['text']; ?>
				<p><a class="btn btn-primary" href="<?php echo base_url('news/' . $news_item['slug']); ?>">View post</a></p>
			</div>

		</div>
	</div>
<?php endforeach ?>