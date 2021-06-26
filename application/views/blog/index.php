<h1 class="bd-title"><?php echo lang('title'); ?></h1>
<?php foreach ($posts as $post) : ?>
	<div class="container-xxl my-md-4 bd-layout">
		<h3><?php echo $post['title']; ?><small> <?php echo lang('on') . " "  . $post['name']; ?></small></h3>
		<div class="card" style="width: 18rem;">
			<img src="<?php echo $post['post_image']; ?>" class="card-img" alt="<?php echo lang('post_image'); ?>">
			<div class="card-body">
				<p class="card-text"><?php echo substr($post['content'], 0, 50) . "..."; ?></p>
				<a href="<?php echo base_url() . 'blog/' . $post['slug']; ?>" class="btn btn-primary"><?php echo lang('view'); ?></a>
			</div>
		</div>
	</div>
<?php endforeach ?>
<div class="pagination-links">
	<?php echo $this->pagination->create_links(); ?>
</div>