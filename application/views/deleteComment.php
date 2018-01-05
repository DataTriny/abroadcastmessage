<h1>Are you sure you want to delete this comment?</h1>
<?php
$authorName = $comment['username'];
if (!is_null($comment['first_name']) && !is_null($comment['last_name']))
	$authorName = $comment['first_name'] . ' ' . $comment['last_name'];
echo '<p>' . $authorName . ', on ' . date('d/m/Y', strtotime($comment['creation_date'])) . '<br />' . $comment['content'] . '</p>';
echo anchor('/comments/delete/' . $comment['id'] . '/' . $comment['article_id'], 'Delete') . anchor('/' . $comment['slug'], 'Cancel');