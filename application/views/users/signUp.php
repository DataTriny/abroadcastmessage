<h1>Create your account</h1>
<?php echo form_open('sign-up');
	echo validation_errors(); ?>
	<label for="username">Username*:</label>
	<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" minlength="4" maxlength="30" required /><br />
	<label for="email">E-mail*:</label>
	<input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" /><br />
	<label for="password">Password*:</label>
	<input type="password" id="password" name="password" minlength="6" maxlength="20" required /><br />
	<label for="passwordConfirmation">Confirm password*:</label>
	<input type="password" id="passwordConfirmation" name="passwordConfirmation" required /><br />
	<label for="firstName">First name:</label>
	<input type="text" id="firstName" name="firstName" value="<?php echo set_value('firstName'); ?>" maxlength="30" /><br />
	<label for="lastName">Last name:</label>
	<input type="text" id="lastName" name="lastName" value="<?php echo set_value('lastName'); ?>" maxlength="30" /><br />
	<p>Fields marked with * are required.</p>
	<input type="submit" class="formButton" value="Sign up" />
</form>