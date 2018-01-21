<?php
$name = $user['username'];
if (!is_null($user['first_name']) && !is_null($user['last_name']))
	$name = $user['first_name'] . ' ' . $user['last_name'];
echo '<h1>' . $name . '</h1>';
echo '<article>' . $user['biography'] . '</article>';