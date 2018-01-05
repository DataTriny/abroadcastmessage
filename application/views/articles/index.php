<h1>List of all articles posted so far</h1>
<?php
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
	echo anchor('/articles/create', 'Create new article');
if (count($articles) == 0)
	echo '<p>Nothing to show yet.</p>';
else
{
	echo '<ul>';
	foreach ($articles as $article)
	{
		$authorName = $article['username'];
		if (!is_null($article['first_name']) && !is_null($article['last_name']))
			$authorName = $article['first_name'] . ' ' . $article['last_name'];
		echo '<li><h2>' . anchor('/' . $article['slug'], $article['title']) . '</h2>
		<p>Posted on ' . date('d/m/Y', strtotime($article['creation_date'])) . ' by ' . $authorName . '.<br />';
		if ($article['comments'] == 0)
			echo anchor('/' . $article['slug'] . '#comments', 'No comment.');
		else if ($article['comments'] == 1)
			echo anchor('/' . $article['slug'] . '#comments', '1 comment.');
		else
			echo anchor('/' . $article['slug'] . '#comments', $article['comments'] . ' comments.');
		echo '</p></li>';
	}
	echo '</ul>';
}