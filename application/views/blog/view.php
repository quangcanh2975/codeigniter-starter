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
<?php endif; ?>