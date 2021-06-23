<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('blog/edit/' . $post['slug']); ?>

<div class="form-group">

	<input type="hidden" value="<?php echo $post['id']; ?>" name="id" />
	<label for="title">Title</label>
	<input type="text" name="title" value="<?php echo $post['title']; ?>" /></br>

</div>
<div class="form-group">
	<label for="text">Content</label>
	<textarea id="editor" name="content" cols="30" rows="10"><?php echo $post['content']; ?></textarea></br>


</div>
<div class="form-group">

	<label for="category_id">Category</label>

	<select id="category_id" class="form-control" name="category_id">
		<?php foreach ($categories as $item) : ?>
			<option <?php echo $post['category_id'] == $item['id'] ? "selected" : ""; ?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
		<?php endforeach ?>

	</select>
</div>
<input type="submit" name="submit" value="Update" />
</form>