<?php
$count_total_tasks = countTaskLists();
$pending_count = countTaskLists('Pending');
$done_count = countTaskLists('Done');

if (isset($_POST['search'])) {
    $search = $_POST['s'];
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $page_name = explode('=', explode('page', explode('?', $url)[1])[1])[1];
    $tasks = getTaskListsBySearch($search, $page_name);
}
?>

<div>
    <ul class="subsubsub">
        <li class="all"><a href="admin.php?page=tasks-all" class="current" aria-current="page">All <span class="count">(<?= $count_total_tasks ?>)</span></a> |</li>
        <li class="publish"><a href="admin.php?page=tasks">Pending <span class="count">(<?= $pending_count ?>)</span></a></li>
        <li class="publish"><a href="admin.php?page=tasks-complete">Done <span class="count">(<?= $done_count ?>)</span></a></li>
    </ul>
</div>

<form action="" method="POST">
    <p class="search-box">
        <input type="search" id="post-search-input" name="s" value="<?= isset($_POST['s']) ? $_POST['s'] : '' ?>">
        <input type="submit" id="search-submit" name="search" class="button" value="Search Tasks">
    </p>
</form>