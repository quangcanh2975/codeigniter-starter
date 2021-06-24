<div class="bd-intro ps-lg-4">
	<h1 class="bd-title"><?php echo $post['title'] ?></h1>
	<p class="bd-lead"><?php echo $post['category']; ?></p>
</div>

<div class="bd-content ps-lg-4">
	<p><?php echo $post['content'] ?></p>
</div>
<?php if ($this->session->flashdata('user_loggedin')) : ?>
	<div class="bd-content ps-lg-4">
		<a class="btn btn-primary pull-left" href="/blog/edit/<?php echo $post['slug']; ?>">Edit</a>

		<?php echo form_open('/blog/delete/' . $post['id']); ?>
		<input type="submit" value="Delete" class="btn btn-danger">
		</form>
	</div>
	<?php echo form_open('comments/create') ?>
	<div class="form-group">
		<input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" />
		<div class="mb-3">
			<label class="form-label" for="email">Email</label>
			<input type="email" name="email" id="" />
		</div>
		<div class="mb-3">
			<label class="form-label" for="text">Comments</label>
			<textarea class="form-control" id="editor" name="comment_content" cols="30" rows="10"></textarea>
		</div>
		<button type="submit">Post</button>
	</div>

	<?php form_close() ?>
<?php endif; ?>

<?php if (!$this->session->flashdata('user_loggedin')) : ?>
	<?php echo form_open('comment/create') ?>
	<div class="form-group">
		<input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" />
		<input type="hidden" name="post_slug" value="<?php echo $post['slug']; ?>" />
		<div class="mb-3">
			<label class="form-label" for="email">Email</label>
			<input type="email" name="email" id="" />
		</div>
		<div class="mb-3">
			<label class="form-label" for="text">Comments</label>
			<textarea class="form-control" id="editor" name="comment_content" cols="30" rows="10"></textarea>
		</div>
		<button type="submit">Post</button>
	</div>

	<?php form_close() ?>
<?php endif ?>


<?php if ($post_comments && count($post_comments) > 0) : ?>
	<h3>Comments</h3>
	<?php foreach ($post_comments as $comment) : ?>
		<p><?php echo $comment['email']; ?></p>
		<p><?php echo $comment['content']; ?></p>
		<hr>
	<?php endforeach ?>
	<p></p>
<?php endif; ?>