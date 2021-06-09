<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('news/create'); ?>
	<label for="title">Title</label>
	<input type="text" name="title" /></br>

	<label for="text">Text</label>
	<textarea id="" name="text" cols="30" rows="10"></textarea></br>

	<input type="submit" name="submit" value="Create news item" />

</form>
