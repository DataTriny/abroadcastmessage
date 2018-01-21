<h1>Create a new category</h1>
<?php echo validation_errors();
echo form_open('categories/create'); ?>
	<label for="category">Name*:</label>
	<input type="text" id="category" name="category" maxlength="50" value="<?php echo set_value('category'); ?>" required />
	<p>Fields marked with * are required.</p>
	<input type="submit" class="formButton" value="Create" />
</form>