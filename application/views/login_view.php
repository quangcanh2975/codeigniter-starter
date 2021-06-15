<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<?php echo validation_errors(); ?>

		<?php echo form_open('login/load_form'); ?>

			<label for="username">Username</label>
			<input type="text" name="username" /><br />

			<label for="password">password</label>
			<input type="password" name="password" /><br />

			<input type="submit" name="submit_login" value="Login" />

		</form>
	</body>
</html>


