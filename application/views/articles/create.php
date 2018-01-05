<h1>Create a new article</h1>
<?php echo validation_errors();
	echo form_open('/articles/create'); ?>
	<label for="title">Title*:</label>
	<input type="text" id="title" name="title" maxlength="255" required /><br />
	<label for="content">Content*:</label>
	<textarea id="content" name="content"></textarea>
	<p>Fields marked with * are required.</p>
	<input type="submit" value="Post" />
</form>