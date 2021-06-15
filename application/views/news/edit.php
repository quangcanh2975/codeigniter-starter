<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('news/edit/'.$news_item['slug']); ?>

<div class="form-group">

<input type="hidden" value="<?php echo $news_item['id']; ?>" name="id"/>
	<label for="title">Title</label>
		<input type="text" name="title" value="<?php echo $news_item['title']; ?>"/></br>

</div>
<div class="form-group">
	<label for="text">Text</label>
	<textarea id="editor"  name="text" cols="30" rows="10"><?php echo $news_item['text']; ?></textarea></br>

	<input type="submit" name="submit" value="Update" />

</div>
<div class="form-group">

	<label for="category_id">Category</label>

	<select id="category_id" class="form-control" name="category_id">
		<?php foreach($categories as $item):?>
		<option <?php echo $news_item['category_id'] == $item['id'] ? "selected" : ""; ?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
	<?php endforeach?>

	</select>
</div>
</form>
