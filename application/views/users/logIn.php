<h1>Log in to your account</h1>
<?php echo form_open('log-in');
	if (isset($hasError) && $hasError)
		echo '<div>Invalid username or password.</div>'; ?>
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" required /><br />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" required /><br />
	<input type="submit" class="formButton" value="Log in" />
</form>