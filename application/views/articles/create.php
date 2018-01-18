<h1>Create a new article</h1>
<?php echo validation_errors();
	echo form_open('/articles/create'); ?>
	<label for="title">Title*:</label>
	<input type="text" id="title" name="title" maxlength="255" required /><br />
	<label for="content">Content*:</label>
	<textarea id="content" name="content"></textarea><br />
	<label for="category">Category*:</label>
	<select id="category" name="category">
		<option value="0">-- Select a category --</option>
		<?php foreach ($categories as $category)
			echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
	?></select><br /><?php echo anchor('categories/create', 'Add a category'); ?><br />
	<p>Fields marked with * are required.</p><br />
	<input type="submit" class="formButton" value="Post" />
</form>