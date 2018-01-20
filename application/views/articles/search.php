<?php
echo form_open('search', ['method' => 'GET']); ?>
	<label for="query">Search for:</label>
	<input type="search" id="query" name="query" placeholder="Keywords" />
	<label for="category">in:</label>
	<select id="category" name="category">
		<option value="all">All categories</option>
		<?php foreach ($categories as $category)
			echo '<option value="' . $category['slug'] . '">' . $category['name'] . '</option>';
	?></select>
	<input type="submit" class="formButton" value="Go" />
</form>
<?php if (isset($search) && $search)
	echo '<h1>Search results (';
else
	echo '<h1>List of all articles posted so far (';
echo count($articles) . ')</h1>';
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
		<p>Posted by ' . $authorName . ' on ' . date('d/m/Y', strtotime($article['creation_date'])) . ' in ' . anchor('search?category=' . $article['category_slug'], $article['category_name']) . '.<br />';
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