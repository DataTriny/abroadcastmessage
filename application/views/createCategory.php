<h1>Create a new category</h1>
<?php echo validation_errors();
echo form_open('/categories/create'); ?>
	<label for="category">Name*:</label>
	<input type="text" id="category" name="category" required />
	<p>Fields marked with * are required.</p>
	<input type="submit" value="Create" />
</form>