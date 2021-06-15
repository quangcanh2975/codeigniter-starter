<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('news/create'); ?>
<div class="form-group">

	<label for="title">Title</label>
	<input type="text" name="title" class="form-control" />
</div>

<div class="form-group">

	<label for="text">Text</label>
	<textarea class="form-control" id="editor" name="text" cols="30" rows="10"></textarea>

</div>

<div class="form-group">

	<label for="category_id">Category</label>

	<select id="category_id" class="form-control" name="category_id">
		<?php foreach($categories as $item):?>
		<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
	<?php endforeach?>

	</select>
</div>

	<input type="submit" name="submit" value="Create news item" />

</form>
