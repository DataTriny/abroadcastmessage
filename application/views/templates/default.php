<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url() . '/assets/css/default.css'; ?>" />
		<meta charset="utf-8" />
		<title><?php if (isset($title)) echo $title . ' | '; ?>Abroadcast Message</title>
	</head>
	<body>
		<header><div id="brand"><h1><?php echo anchor('/', 'Abroadcast Message'); ?></h1><p>Vilnius, there and back again!</p></div>
			<div id="logIn"><?php if (isset($_SESSION['fullName']))
				echo $_SESSION['fullName'] . anchor('users/edit', 'Edit profile') . anchor('log-out', 'Log out');
			else
				echo anchor('log-in', 'Log in') . anchor('sign-up', 'Sign up');
			?></div>
			<nav>
				<ul>
					<li><?php echo anchor('/', 'Home'); ?></li><li><?php echo anchor('articles', 'Articles'); ?></li><li><?php echo anchor('about-us', 'About us'); ?></li>
				</ul>
			</nav>
		</header>
		<main>
			<?php
			if (isset($_SESSION['message']))
				echo '<div id="message">' . $_SESSION['message'] . '</div>';
			if (isset($body))
				echo $body; ?>
		</main>
		<footer>
			<p>&copy; 2018 - Arnold Loubriat, Clément Boussiron and Romain Desjuzeur.<br />All rights reserved.<br />Handcrafted by DataTriny / Arnold Loubriat.</p>
		</footer>
	</body>
</html>