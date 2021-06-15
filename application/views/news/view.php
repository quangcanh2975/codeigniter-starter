<h2><?php echo $news_item['title'] ?></h2>
<div class="post-body">
<h3>
	<?php echo $news_item['text'] ?>
</h3>
<p><?php echo $news_item['category']; ?></p>
</div>

<hr>

<a class="btn btn-primary pull-left" href="/news/edit/<?php echo $news_item['slug']; ?>">Edit</a>

<?php echo form_open('/news/delete/'.$news_item['id']); ?>
	<input type="submit" value="Delete" class="btn btn-danger">
</form>

