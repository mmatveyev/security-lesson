<h2 class="form-signin-heading">Blog</h2>
<table class="table-bordered">
    <?php foreach($posts as $post):?>
        <tr>
            <td>
                <h5><?= $post['title'];?></h5>
                <div><?= strip_tags($post['teaser']);?></div>
                <a href="/index.php?action=view&id=<?= $post['id']; ?>">View more</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
<?php $i= 0; while($i * 3 <= $count): $i++?>
    <a href="/index.php?start=<?= ($i-1)*3; ?>"><?= $i; ?> </a>
<?php endwhile ?>
   </div>
<?php
if ($_SESSION['user']['is_admin']):
    ?>
    <form method="post" action="/index.php?action=post">
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title"><br>
        <label for="teaser">Short text</label><br>
        <textarea cols="100" rows="5" id="teaser" name="teaser"></textarea><br>
        <label for="body">Full text</label><br>
        <textarea cols="100" rows="10" id="body" name="body"></textarea><br>
        <input type="submit" value="Post">
    </form>
<?php endif; ?>
