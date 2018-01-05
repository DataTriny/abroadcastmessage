<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php if (isset($title)) echo $title; ?></title>
	</head>
	<body>
		<header><p>
			<?php if (isset($_SESSION['fullName']))
				echo $_SESSION['fullName'] . anchor('log-out', 'Log out');
			else
				echo anchor('log-in', 'Log in') . anchor('sign-up', 'Sign up');
			?></p>
			<nav>
				<ul>
					<li><?php echo anchor('/', 'Home'); ?></li>
					<li><?php echo anchor('/articles', 'Articles'); ?></li>
					<li><?php echo anchor('/about-us', 'About us'); ?></li>
				</ul>
			</nav>
		</header>
		<?php if (isset($_SESSION['message'])) echo '<div id="message">' . $_SESSION['message'] . '</div>'; ?>
		<main>
			<?php if (isset($body)) echo $body; ?>
		</main>
		<footer>
			<p>&copy; 2017 - Arnold Loubriat, Clément Boussiron and Romain Desjuzeur.<br />All rights reserved.<br />Handcrafted by DataTriny / Arnold Loubriat.</p>
		</footer>
	</body>
</html>