<h2 class="form-signin-heading"><?= strip_tags($post['title']); ?></h2>
<div>
    <?= $post['body']; ?>
</div>
<a href="/index.php">Back</a>
<form method="get" action="/index.php">
<input type="hidden" name="action" value="comment">
    <input type="hidden" name="post" value="<?= $post['id'];?>">
    <textarea name="comment" cols="50" rows="3"></textarea><br/>
    <input type="submit" value="COMMENT">
</form>
<table class="table-bordered">
    <?php foreach($comments as $comment): ?>
    <tr>
        <td>
            <b><?= $comment['name'];?>: </b>
            <?= strip_tags($comment['comment']); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

