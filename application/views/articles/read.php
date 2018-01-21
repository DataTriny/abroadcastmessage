<article>
	<h1><?php echo $article['title']; ?></h1>
	<p>Posted by <?php echo anchor('about/' . $article['username'], $authorName); ?> on <?php echo date('d/m/Y', strtotime($article['creation_date'])); ?> in <?php echo anchor('search?category=' . $article['category_slug'], $article['category_name']); ?>.</p>
	<?php if (count($tags) > 0)
	{
		echo '<p>Tagged as:';
		for ($i = 0; $i < count($tags); $i++)
		{
			if ($i > 0)
				echo ', ';
			echo anchor('search?tags=' . $tags[$i]['name'], $tags[$i]['name']);
		}
		echo '</p>';
	}
	echo $article['content']; ?>
</article>
<h1 id="comments">Comments (<?php echo count($comments); ?>)</h1>
<?php if (isset($_SESSION['fullName']))
{
	echo '<h2>Leave a comment</h2>' . form_open('/' . $article['slug']); ?>
		<label for="comment">Your comment*:</label>
		<textarea id="comment" name="comment"></textarea>
		<input type="submit" value="Post as <?php echo $_SESSION['fullName']; ?>" />
		<p>Fields marked with * are required.</p>
	</form>
<?php }
else
	echo '<p>You must ' . anchor('/log-in', 'log in') . ' or ' . anchor('/sign-up', 'sign up') . ' to leave a comment.</p>';
if (count($comments) > 0)
{
	echo '<ul>';
	foreach ($comments as $comment)
	{
		$authorName = $comment['username'];
		if (!is_null($comment['first_name']) && !is_null($comment['last_name']))
			$authorName = $comment['first_name'] . ' ' . $comment['last_name'];
		echo '<li>' . $authorName . ', on ' . date('d/m/Y', strtotime($comment['creation_date'])) . '<br />' . $comment['content'];
		if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
			echo anchor('/comments/delete/' . $comment['article_id'] . '/' . $comment['id'], 'Delete');
		echo '</li>';
	}
	echo '</ul>';
}